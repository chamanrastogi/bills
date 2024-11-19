<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class BillingController extends Controller
{
    //
    public function index()
    {
        $categories = Category::pluck('name', 'id');
        $colors = Color::pluck('name', 'id');
        $customers  = Customer::pluck('name', 'id');
        return view('backend.billing.billing', compact('categories', 'colors', 'customers'));
    }
    public function cart(Request $request)
    {
        //dd($request);
        // Decode the cart data sent from the frontend
        $cartData = json_decode($request->cart_data, true);
        $template = SiteSetting::find(1);
        // Process the cart data
        $cartItems = $cartData['cart_items'];  // Array of cart items
        $grandTotal = $cartData['grand_total'];  // Grand total value
        $discount = $cartData['discount'];
        $customer_id = $cartData['customer_id'];
        // Example: Save the cart items in the database, or process the order


        //dd($cartItems);
        $bill = Billing::insertGetId([
            'customer_id' => $customer_id,
            'cart' => json_encode($cartItems),
            'discount' => $discount,
            'tax' => $template->tax,
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
}
