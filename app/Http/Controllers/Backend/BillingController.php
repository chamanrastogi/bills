<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BillingsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;


class BillingController extends Controller
{
    //
    public function index()
    {
        $categories = Category::pluck('name', 'id');

        $customers = Customer::all()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name . ' (' . $customer->phone . ')'];
        });
        $template = SiteSetting::select('tax')->find(1);
        return view('backend.billing.billing', compact('categories',  'customers', 'template'));
    }
    public function cart(Request $request)
    {
        $items = [];
        // dd($request);
        // Decode the cart data sent from the frontend
        $cartData = json_decode($request->cart_data, true);
        // Process the cart data
        $cartItems = $cartData['cart_items'];  // Array of cart items
        // dd($cartItems);
        foreach ($cartItems as $item) {

            $pro = Product::select('price')->find($item['productId']);
            $item['price'] = $pro->price;
            $items[] = $item;
        }
        //dd($items);
        $grandTotal = round($cartData['grand_total'], 2);  // Grand total value
        $discount = $cartData['discount'];
        $discount_amount = round($cartData['discount_amount'], 2);
        $tax = $cartData['tax'];
        $tax_amount = round($cartData['tax_amount'], 2);
        $customer_id = $cartData['customer_id'];
        $freight_charges = $cartData['freight_charges'];
        // Example: Save the cart items in the database, or process the order

        //dd($cartItems);
        $bill = Billing::insertGetId([
            'customer_id' => $customer_id,
            'cart' => json_encode($items),
            'discount' => $discount,
            'discount_amount' => $discount_amount,
            'tax' => $tax,
            'tax_amount' => $tax_amount,
            'grand_total' => $grandTotal,
            'freight_charges' => $freight_charges,
            'payment' => 0,
            'payment_mode' => 0
        ]);
        $customer = Customer::find($customer_id);
        // $data=[
        //     'status' => 'success',
        //     'message' => 'Cart submitted successfully!',
        //     'cart_items' => json_encode($cartItems),
        //     'grand_total' => $grandTotal,
        //     'discount' => $discount,
        //     'customer'=> $customer,
        // ];

        // dd($bill);

        return redirect()->route('billing.show');
    }
    public function getCart(int $id)
    {
        $template = SiteSetting::find(1);
        $billing = Billing::find($id);
        $notification = array(
            'message' => 'Cart Saved Successfully',
            'alert-type' => 'success',
        );
        if (!$billing) {
            $notification = array(
                'message' => 'Billing Not Found',
                'alert-type' => 'error',
            );
            return redirect()->route('billing.show')->with($notification);
        }
        return view('backend.billing.cart', compact('billing', 'id', 'template'))->with($notification);
    }
    public function showbilling()
    {
        $billings = Billing::latest()->where('payment', 0)->get();
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
        $notification = array(
            'message' => 'Billing Deleted successfully',
            'alert-category_id' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function showbills(Customer $customer)
    {
        //dd($customer);
        $billings = Billing::where('customer_id', $customer->id)->where('payment', 0)->get();
        return view('backend.customer.show', compact('billings'));
    }
    public function showBillingPayments(Customer $customer, Request $request)
    {

        list($startDate, $endDate) = explode("to", $request->daterange);

        // Retrieve billing data with specific fields
        $billingResults = Billing::where('customer_id', 1) // Customer ID filter
            ->whereBetween('created_at', [trim($startDate), trim($endDate)]) // Date filter
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
                'debit_credit' => $billing->grand_total > 0 ? 'Dr' : ($billing->payment > 0 ? 'Cr' : '')
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

        $billings = Billing::latest()->where('cart', '!=', NULL)->get();
        //dd($billings);     
        return view('backend.billing.showall', compact('billings'));
    }
    public function datatable(BillingsDataTable $dataTable)
    {
        return $dataTable->render('backend.billing.index');
    }
    public function Ajax_Load(Request $request, Billing $billing)
    {
        $query = Billing::select('id', 'customer_id', 'cart', 'discount', 'tax', 'freight_charges', 'created_at', 'grand_total')->where('grand_total', '>', 0)->get();

        return DataTables::of($query)
            ->addColumn('check', function (Billing $billing) {

                return    '<span class="form-check form-check-primary"><input
                                                    class="form-check-input mixed_child " value="' . $billing->id . '"
                                                    type="checkbox"></span>';
            })
            ->setRowClass(function (Billing $billing) {
                return 'billing-' . $billing->id;
            })

            ->addColumn('customer', function (Billing $billing) {
                $cart = json_decode($billing->cart);
                $customer_details='-';
                $customer = Customer::Select('name','phone')->find(
                    $billing->customer_id,
                );
                if($customer)
                {
                    $customer_details= $customer->name .'<br>Ph:'.$customer->phone;
                }
                return   $customer_details;
            })
            ->addColumn('cart', function (Billing $billing) {
                $cart = json_decode($billing->cart);
                $carts = '';
                $units='';
                foreach ($cart as $item) {

                    $product = Product::with('unit')->find(
                        $item->productId,
                    );
                    $units=($product->unit->name) ? "-Per " . $product->unit->name : '';    
                    $carts .= $product->name . $units  . "<br>";
                }
                return   $carts;
            })
            ->addColumn('details', function (Billing $billing) {
                return   '<strong>Dis:</strong>' . $billing->discount . ' (%)<br>
                                            <strong>Tax:</strong>' . $billing->tax . ' (%)<br>
                                        <strong>Fri_ch:</strong>' . $billing->freight_charges . '';
            })
            ->addColumn('created', function (Billing $billing) {
                return   $billing->created_at->format('d-m-Y h:i A');
            })
            ->addColumn('total', function (Billing $billing) {
                return   number_format($billing->grand_total, 2);
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

            ->rawColumns(['check', 'customer', 'cart', 'details', 'created', 'total',  'action'])
            ->make(true);
    }
}
