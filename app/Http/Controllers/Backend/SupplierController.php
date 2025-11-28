<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Models\ImagePresets;
use App\Models\Supplier;
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

        $bill_image = $request->file('bill_image');
        if ($request->file('bill_image') != null) {
            $bill_image = $request->file('bill_image');
            $bill_save_url = $this->imageGenrator($bill_image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $bill_save_url = '';
        }
        Supplier::create([
            'shop_name' => $request->shop_name,
            'bill_image' => $bill_save_url,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'gst_no' => $request->gst_no,
            'account' => $request->account,
            // default if not selected
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

        if ($request->file('bill_image') != null) {
            if (file_exists($supplier->bill_image)) {
                $bill_img = explode('.', $supplier->bill_image);
                $small_img = $bill_img[0] . '_' . $this->image_preset[0]->name . '.' . $bill_img[1];
                unlink($small_img);
                unlink($supplier->bill_image);
            }
            $bill_image = $request->file('bill_image');
            $bill_save_url = $this->imageGenrator($bill_image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            if ($supplier->bill_image != '') {
                $bill_save_url = $supplier->bill_image;
            } else {
                $bill_save_url = '';
            }
        }
        $supplier->update([
            'shop_name' => $request->shop_name,
            'bill_image' => $bill_save_url,
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
}
