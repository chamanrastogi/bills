<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BillingsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purity;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BillingController extends Controller
{
    //
    public function index()
    {
        $categories = Category::active(0)->pluck('name', 'id');
        $purities = Purity::active(0)->pluck('name', 'id');

        $customers = Customer::all()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name . ' (' . $customer->phone . ')'];
        });
        $template = SiteSetting::select('tax')->find(1);

        return view('backend.billing.billing', compact('customers', 'purities', 'template', 'categories'));
    }

    public function cart(Request $request)
    {

        $cartData = json_decode($request->cart_data, true);
        if (!is_array($cartData) || !isset($cartData['cart_items']) || !is_array($cartData['cart_items'])) {
            return redirect()->back()->with([
                'message' => 'Invalid cart data submitted',
                'alert-type' => 'error',
            ]);
        }

        $cartItems = $cartData['cart_items'];
        $processedItems = [];
        $subtotal = 0.0;
        $gst_total = 0.0;
        $payment_mode = $cartData['payment_mode'] ?? 0;
        $transaction_no = $cartData['transaction_no'] ?? null;
        $grandTotal = $cartData['grand_total'];

        $customer_id = $cartData['customer_id'];
        $oldBalance = $cartData['oldBalance'];
        $payment = $cartData['customer_balance'] -(int)$oldBalance ?? 0;
        DB::beginTransaction();
        try {
            foreach ($cartItems as $item) {
                $productId = $item['productId'] ?? null;
                $product = Product::find($productId);
                if (!$product) {
                    DB::rollBack();

                    return redirect()->back()->with([
                        'message' => "Product not found (ID: {$productId})",
                        'alert-type' => 'error',
                    ]);
                }

                $qty = isset($item['quantity']) ? floatval($item['quantity']) : (isset($item['qty']) ? floatval($item['qty']) : 1);
                $stock = $product->stock_qty ?? 0;
                if ($stock < $qty) {
                    DB::rollBack();

                    return redirect()->back()->with([
                        'message' => "Insufficient stock for product: {$product->name} (available: {$stock})",
                        'alert-type' => 'error',
                    ]);
                }

                $price = floatval($product->price ?? 0);
                $gst = floatval($product->gst ?? ($item['gst'] ?? 0));

                $lineBase = $price * $qty;
                $lineGst = round($lineBase * ($gst / 100), 2);
                $lineTotal = round($lineBase + $lineGst, 2);

                $subtotal += $lineBase;
                $gst_total += $lineGst;

                $processedItems[] = [
                    'productId' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku ?? null,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'rate' => $item['rate'],
                    'gross' => $item['gross'],
                    'net' => $item['net'],
                    'making' => $item['making'],
                    'gst' => $gst,
                    'grandTotal' => $item['grandTotalAmount']
                ];

                // Decrement stock (will be rolled back if transaction fails)
                $product->stock_qty = $stock - $qty;
                $product->save();
            }

            $discount_percent = floatval($cartData['discount'] ?? 0);
            $discount_amount = round($subtotal * $discount_percent / 100, 2);

            $tax_percent = floatval($cartData['tax'] ?? 0);
            $tax_amount = round(($subtotal - $discount_amount) * $tax_percent / 100, 2);

            //$grandTotal = round($subtotal + $gst_total - $discount_amount + $tax_amount, 2);

            $billingId = Billing::insertGetId([
                'customer_id' => $cartData['customer_id'] ?? null,
                'cart' => json_encode($processedItems),
                'discount' => $discount_percent,
                'discount_amount' => $discount_amount,
                'tax' => $tax_percent,
                'tax_amount' => $tax_amount,
                'gst' => 0,
                'grand_total' => $grandTotal,
                'payment' => $payment ?? 0,
                'payment_mode' => $payment_mode ?? 0,
                'transaction_no' => $transaction_no ?? null,
                'old_payment' => $oldBalance ?? null
            ]);
            if ($oldBalance > 0) {
                Billing::insertGetId([
                    'customer_id' => $customer_id,
                    'cart' => '',
                    'discount' => 0,
                    'discount_amount' => 0,
                    'tax' => 0,
                    'tax_amount' => 0,
                    'grand_total' => 0,
                    'gst' => 0,
                    'payment' => $oldBalance,
                    'payment_mode' => $payment_mode,
                    'transaction_no' => $transaction_no ?? null
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Failed to save cart: ' . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }

        $customer = Customer::find($cartData['customer_id'] ?? null);
        // $data=[
        //     'status' => 'success',
        //     'message' => 'Cart submitted successfully!',
        //     'cart_items' => json_encode($cartItems),
        //     'grand_total' => $grandTotal,
        //     'discount' => $discount,
        //     'customer'=> $customer,
        // ];

        // dd($bill);

        return redirect()->route('billing.show')->with([
            'message' => 'Cart submitted successfully',
            'alert-type' => 'success',
        ]);
    }

    public function getCart(int $id)
    {
        $template = SiteSetting::find(1);
        $billing = Billing::find($id);
        $notification = [
            'message' => 'Cart Saved Successfully',
            'alert-type' => 'success',
        ];
        if (!$billing) {
            $notification = [
                'message' => 'Billing Not Found',
                'alert-type' => 'error',
            ];

            return redirect()->route('billing.show')->with($notification);
        }

        return view('backend.billing.cart', compact('billing', 'id', 'template'))->with($notification);
    }

    public function showbilling()
    {
        $billings = Billing::latest()->get();

        return view('backend.billing.show', compact('billings'));
    }

    public function delete(Request $request)
    {
        if (is_array($request->id)) {

            $cat = Billing::whereIn('id', $request->id);
        } else {
            $cat = Billing::find($request->id);
        }
        $cat->delete($request->id);
        $notification = [
            'message' => 'Billing Deleted successfully',
            'alert-category_id' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function showbills(Customer $customer)
    {
        // dd($customer);
        $billings = Billing::where('grand_total','>',0)->where('customer_id', $customer->id)->get();

        return view('backend.customer.show', compact('billings'));
    }

    public function showBillingPayments(Customer $customer, Request $request)
    {

        [$startDate, $endDate] = explode('to', $request->daterange);

        // Retrieve billing data with specific fields
        $billingResults = Billing::where('customer_id', $customer->id) // Customer ID filter
            ->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])// Date filter
            ->orderBy('created_at', 'asc')
            ->select(
                'id as billing_id',
                'grand_total',
                'payment',
                'payment_mode',
                'updated_at as billing_updated_at',
                'created_at as billing_created_at'
            )
            ->get();

        // Merge billing and payment data, displaying debit (Dr) for grand_total > 0 and credit (Cr) for payment > 0
        $mergedResults = [];

        foreach ($billingResults as $billing) {
            $mergedResults[] = [
                'billing_id' => $billing->billing_id,
                'grand_total' => $billing->grand_total,
                'payment' => $billing->payment,
                'payment_mode' => $billing->payment_mode,
                'billing_updated_at' => $billing->billing_updated_at,
                'billing_created_at' => $billing->billing_created_at,
                'debit_credit' => $billing->grand_total > 0 ? 'Dr' : ($billing->payment > 0 ? 'Cr' : ''),
            ];
        }

        // Return the view with the results
        return view('backend.billing.payment_list', compact('mergedResults', 'startDate', 'endDate', 'customer'));
    }

    public function Billingledger(Customer $customer)
    {
        return view('backend.billing.billing_ledger', compact('customer'));
    }

    public function Showall()
    {

        $billings = Billing::latest()->where('cart', '!=', null)->get();

        // dd($billings);
        return view('backend.billing.showall', compact('billings'));
    }

    public function datatable(BillingsDataTable $dataTable)
    {
        return $dataTable->render('backend.billing.index');
    }

    public function GetCustomer(int $id): JsonResponse
    {

        $customer = Customer::select('id', 'opening_balance')->find($id);

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Customer not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'customer' => [
                    'id' => $customer->id,
                    'balance' => abs($customer->balance()),
                ],
        ]);
    }

    public function Ajax_Load(Request $request, Billing $billing)
    {
        // Note: `freight_charges` column may not exist in the `billing` table in all installs.
        // Select only existing/common columns to avoid SQL errors.
        $query = Billing::where('grand_total', '>', 0)
            ->get();

        return DataTables::of($query)
            ->addColumn('check', function (Billing $billing) {
                return '<span class="form-check form-check-primary"><input
                                                    class="form-check-input mixed_child " value="' . $billing->id . '"
                                                    type="checkbox"></span>';
            })
            ->setRowClass(function (Billing $billing) {
                return 'billing-' . $billing->id;
            })

            ->addColumn('customer', function (Billing $billing) {
                $cart = json_decode($billing->cart);
                $customer_details = '-';
                $customer = Customer::Select('name', 'phone')->find(
                    $billing->customer_id,
                );
                if ($customer) {
                    $customer_details = $customer->name . '<br>Ph:' . $customer->phone;
                }

                return $customer_details;
            })
            ->addColumn('cart', function (Billing $billing) {
                $cart = json_decode($billing->cart, true);
                $grand_total = $billing->grand_total;
                $payment = $billing->payment;
                $payment_mode = MODE[$billing->payment_mode];
                $html = '';
                if (is_array($cart)) {
                    foreach ($cart as $item) {
                        $product = Product::with('unit')->find($item['productId'] ?? null);
                        if (!$product) {
                            $html .= '<div class="text-muted">[Product not found]</div>';

                            continue;
                        }

                        $unitName = ($product->unit && $product->unit->name) ? '-Per ' . $product->unit->name : '';
                        $qty = isset($item['quantity']) ? floatval($item['quantity']) : (isset($item['qty']) ? floatval($item['qty']) : 1);
                        $price = isset($item['price']) ? floatval($item['price']) : floatval($product->price ?? 0);
                        $gst = isset($item['gst']) ? floatval($item['gst']) : 0;

                        $grandTotal = $grand_total;

                        // Check current stock
                        $stock = $product->stock_qty ?? 0;
                        if ($stock <= 0) {
                            $stockBadge = '<span class="badge bg-danger ms-2">Out of stock</span>';
                        } elseif ($qty > $stock) {
                            $stockBadge = '<span class="badge bg-warning ms-2">Insufficient (' . $stock . ')</span>';
                        } else {
                            $stockBadge = '<span class="badge bg-success ms-2">In Stock: ' . $stock . '</span>';
                        }

                        $itemSku = $product->sku ?? ($item['sku'] ?? '');
                        $itemSku = htmlspecialchars($itemSku);
                        $pName = htmlspecialchars($product->name);
                        $uName = htmlspecialchars($unitName);
                        $html .= '<div class="mb-2">';
                        $html .= '<strong>' . $pName . '</strong> ' . $uName . '<br>';
                        $html .= 'SKU: ' . $itemSku;
                        $html .= ' | Qty: ' . number_format($qty, 2);
                        $html .= ' | Price: ' . number_format($price, 2);
                        $html .= ' | Mode: ' . $payment_mode;
                        $html .= ' | Total Pay: ' . number_format($payment, 2);
                        $html .= ' ' . $stockBadge;
                        $html .= '</div>';
                    }
                }

                return $html;
            })
            ->addColumn('details', function (Billing $billing) {
                // Provide compact billing details including discounts, tax and freight
                $details = '<strong>Dis:</strong>' . $billing->discount . ' (%)<br>';
                $details .= '<strong>Tax:</strong>' . $billing->tax . ' (%)<br>';
                $details .= '<strong>Fri_ch:</strong>' . ($billing->freight_charges ?? 0) . '<br>';

                // Additionally include a quick stock-summary for the cart
                $cart = json_decode($billing->cart, true);
                if (is_array($cart) && count($cart) > 0) {
                    $lowStock = 0;
                    $outStock = 0;
                    foreach ($cart as $item) {
                        $product = Product::find($item['productId'] ?? null);
                        if (!$product) {
                            continue;
                        }
                        $qty = isset($item['quantity']) ? floatval($item['quantity']) : 1;
                        $stock = $product->stock_qty ?? 0;
                        if ($stock <= 0) {
                            $outStock++;
                        } elseif ($qty > $stock) {
                            $lowStock++;
                        }
                    }
                    if ($outStock > 0) {
                        $details .= '<div class="text-danger">Out of stock items: ' . $outStock . '</div>';
                    }
                    if ($lowStock > 0) {
                        $details .= '<div class="text-warning">Insufficient stock items: ' . $lowStock . '</div>';
                    }
                }

                return $details;
            })
            ->addColumn('created', function (Billing $billing) {
                return $billing->created_at->format('d-m-Y h:i A');
            })
            ->addColumn('total', function (Billing $billing) {
                return number_format($billing->grand_total, 2);
            })

            ->addColumn('action', function (Billing $billing) {

                $get = route('get.cart', $billing->id);
                $x = '<a href="' . $get . '"class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                              data-placement="top" title="View" data-bs-original-title="View">
                              <i data-feather="eye"></i></a>';
                $delete = $billing->id . ",'Billing'";
                $x .= '<a href="javascript:void(0)" onClick="deleteFunction(' . $delete . ')"
    class="action-btn btn-edit bs-tooltip me-2 delete' . $billing->id . '"
    data-toggle="tooltip" data-placement="top" title="Delete"
    data-bs-original-title="Delete">
    <i data-feather="trash-2"></i>
</a>';

                return $x;
            })

            ->rawColumns(['check', 'customer', 'cart', 'details', 'created', 'total', 'action'])
            ->make(true);
    }
}
