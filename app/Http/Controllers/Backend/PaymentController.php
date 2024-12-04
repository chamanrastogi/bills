<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function Addpayment(Customer $customer)
    {

        $payment_modes =explode(",", MODE);
        $customer_id=$customer;
       // dd($customer->balance());
        $balance=$customer->balance();
        $customer_name=$customer->name;
        return view('backend.payment.add_payment', compact('payment_modes','customer_id','balance','customer_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Customer $customer)
    {
        $validated = $request->validate([
            'payment' => 'required|numeric|min:1'

        ]);

        //dd($customer);
       
         Billing::insertGetId([
            'customer_id' => $customer->id,
            'cart' => '',
            'discount' => 0,
            'discount_amount' => 0,
            'tax' => 0,
            'tax_amount' => 0,
            'grand_total' => 0,
            'freight_charges'=>0,
            'payment'=> $request->payment,
            'payment_mode'=>$request->payment_mode
        ]);
        $notification = array(
            'message' => 'Payment Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $payments = Billing::latest()->where('payment','!=',0)->where('customer_id', $customer->id)->with(['customer:id,name'])->get();
        $customer=Customer::select('name','id')->find($customer->id);
        $customer_name=$customer->name;
        $totalpayment= $customer->bills()->sum('payment');
        //dd($totalpayment);
        return view('backend.payment.all_payment', compact('payments','customer_name','totalpayment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billing $billing, Request $request)
    {
       // dd($billing);
        $payment_modes = explode(",", MODE);
        $customer_id= $request->id;
        return view('backend.payment.edit_payment', compact('billing', 'payment_modes', 'customer_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billing $billing)
    {
        //dd($request);
        $validated = $request->validate([
            'payment' => 'required|numeric|min:1'
        ]);

       // dd($billing);
        
        $billing->update([           
            'payment'=> $request->payment,
            'payment_mode'=>$request->payment_mode
        ]);

        $notification = array(
            'message' => 'Payment Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
     public function delete(Request $request)
    {
        // dd($request);
        if (is_array($request->id)) {

            $pay = Billing::whereIn('id', $request->id);
        } else {
            $pay = Billing::find($request->id);
        }

        $pay->delete($request->id);
        $notification = array(
            'message' => 'Payment Deleted successfully',
            'alert-unit_id' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
