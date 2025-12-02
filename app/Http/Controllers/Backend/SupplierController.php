<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Models\ImagePresets;
use App\Models\Supplier;
use App\Models\SupplierBilling;
use App\Traits\CommonTrait;
use App\Traits\ImageGenTrait;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public $path = 'upload/supplier/thumbnail/';

    public $image_preset;
    public $image_preset_main;

    use CommonTrait;
    use ImageGenTrait;

    public function __construct()
    {
        $this->image_preset = ImagePresets::whereIn('id', [4, 12])->get();
        $this->image_preset_main = ImagePresets::find(11);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('backend.supplier.all_supplier');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);


        Supplier::create([
            'shop_name' => $request->shop_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'gst_no' => $request->gst_no,
            'account' => $request->account,
        ]);

        $notification = [
            'message' => 'Supplier Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('backend.supplier.edit_supplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {


        $supplier->update([
            'shop_name' => $request->shop_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'gst_no' => $request->gst_no,
            'account' => $request->account,
        ]);

        $notification = [
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function getFullPay(Supplier $supplier)
    {
        return view('backend.supplier.full_pay', compact('supplier'));
    }

    public function fullPay(Request $request, Supplier $supplier)
    {
         $validated = $request->validate([
            'payment_mode' => 'required',
        ]);

        // Current balance
        $balance = $supplier->balance; // accessor

        if ($balance <= 0) {
            return back()->with([
                'message' => 'No pending balance to pay!',
                'alert-type' => 'info'
            ]);
        }

        SupplierBilling::create([
            'supplier_id' => $supplier->id,
            'bill_amount' => 0,       // no new bill
            'paid'        => $balance, // full settlement
            'payment_mode' => 1,       // default mode (or take from request)
            'transaction_id' => 'FULLPAY-' . time(),
        ]);

        return back()->with([
            'message' => 'Supplier fully paid successfully!',
            'alert-type' => 'success'
        ]);
    }
}
