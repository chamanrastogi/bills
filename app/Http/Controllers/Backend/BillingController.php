<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;



class BillingController extends Controller
{
    //
    public function index()
    {
        $categories = Category::pluck('name', 'id');

        $customers = Customer::all()->mapWithKeys(function ($customer) {
            return [$customer->id => $customer->name . ' (' . $customer->phone . ')'];
        });
        $template= SiteSetting::select('tax')->find(1);
        return view('backend.billing.billing', compact('categories',  'customers','template'));
    }
    public function cart(Request $request)
    {
        $items=[];
       // dd($request);
        // Decode the cart data sent from the frontend
        $cartData = json_decode($request->cart_data, true);
        // Process the cart data
        $cartItems = $cartData['cart_items'];  // Array of cart items
       // dd($cartItems);
        foreach ($cartItems as $item)
        {

        $pro= Product::select('price')->find($item['productId']);
        $item['price']=$pro->price;
        $items[]=$item;
        }
        //dd($items);
        $grandTotal = $cartData['grand_total'];  // Grand total value
        $discount = $cartData['discount'];
        $discount_amount = $cartData['discount_amount'];
        $tax = $cartData['tax'];
        $tax_amount = $cartData['tax_amount'];
        $customer_id = $cartData['customer_id'];
        // Example: Save the cart items in the database, or process the order


        //dd($cartItems);
        $bill = Billing::insertGetId([
            'customer_id' => $customer_id,
            'cart' => json_encode($items),
            'discount' => $discount,
            'discount_amount' => $discount_amount,
            'tax' => $tax,
            'tax_amount' => $tax_amount,
            'grand_total' => $grandTotal
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
        $billing= Billing::find($id);
        $notification = array(
            'message' => 'Cart Saved Successfully',
            'alert-type' => 'success',
        );
        if(!$billing)
        {
            $notification = array(
                'message' => 'Billing Not Found',
                'alert-type' => 'error',
            );
             return redirect()->route('billing.show')->with($notification);
        }
        return view('backend.billing.cart', compact('billing','id', 'template'))->with($notification);
    }
    public function showbilling()
    {
        $billings = Billing::latest()->get();
        return view('backend.billing.show', compact('billings' ));
    }
    public function delete(Request $request)
    {
        $cat = Billing::find($request->id);
        $cat->delete($request->id);
        $notification = array(
            'message' => 'Billing Deleted successfully',
            'alert-category_id' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function showbills(Customer $customer) {
        $billings = Billing::latest()->where('customer_id', $customer->id)->with(['customer:id,name'])->get();
        return view('backend.payment.all_payment', compact('billings'));
    }
}
