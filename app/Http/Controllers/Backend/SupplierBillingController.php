<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SupplierBillingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\ImagePresets;
use App\Models\SupplierBilling;
use App\Models\SupplierBillingItem;
use App\Models\Type;
use App\Models\Purity;
use App\Traits\CommonTrait;
use App\Traits\ImageGenTrait;
use Illuminate\Http\Request;

class SupplierBillingController extends Controller
{
    public $path = 'upload/supplier_billing/thumbnail/';

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
    public function index(SupplierBillingDataTable $dataTable)
    {

        return $dataTable->render('backend.supplier_billings.all_supplier_billings');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::where('status', 0)->pluck('shop_name', 'id');
        $types = Type::active(0)->pluck('name', 'id');
        $purities = Purity::active(0)->pluck('name', 'id');

        return view('backend.supplier_billings.add_supplier_billings', compact('supplier', 'types', 'purities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id'           => 'nullable|string',
            'payment_mode'          => 'required|integer',
            'paid'                  => 'required|numeric|min:0',
            'items'                 => 'required|array|min:1',
            'items.*.metal_type_id' => 'nullable|integer|exists:types,id',
            'items.*.purity_id'     => 'required|integer|exists:purities,id',
            'items.*.total_weight'  => 'required|numeric|min:0.001',
            'items.*.rate_per_gram' => 'required|numeric|min:0',
        ]);

        $image = $request->file('bill_image');
        if ($request->file('bill_image') != null) {
            $image = $request->file('bill_image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url = '';
        }
        // -----------------------------
        // 2. Calculate pricing from items
        // -----------------------------
        $billAmount = 0;
        $itemsData = [];

        foreach ($validated['items'] as $item) {
            $weight = (float) $item['total_weight'];
            $rate = (float) $item['rate_per_gram'];
            $lineTotal = round($weight * $rate, 2);
            $billAmount += $lineTotal;

            $itemsData[] = [
                'metal_type_id' => $item['metal_type_id'] ?? null,
                'purity_id'     => $item['purity_id'],
                'total_weight'  => $weight,
                'rate_per_gram' => $rate,
                'line_total'    => $lineTotal,
            ];
        }

        // Ensure paid does not exceed calculated bill amount
        $paid = min((float) $validated['paid'], $billAmount);

        // -----------------------------
        // 3. Save Record + line items
        // -----------------------------
        $supplierBilling = SupplierBilling::create([
            'supplier_id'    => $validated['supplier_id'] ?? null,
            'bill_image'     => $save_url,
            'bill_amount'    => $billAmount,
            'paid'           => $paid,
            'payment_mode'   => $validated['payment_mode'],
            'transaction_id' => $request->transaction_id,
        ]);

        foreach ($itemsData as $row) {
            $supplierBilling->items()->create($row);
        }

        // -----------------------------
        // 3. Notification
        // -----------------------------
        return redirect()->back()->with([
            'message' => 'Supplier Billing Added Successfully',
            'alert-type' => 'success',
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierBilling $supplier_billing)
    {

        $supplier = Supplier::where('status', 0)->pluck('shop_name', 'id');
        $types = Type::active(0)->pluck('name', 'id');
        $purities = Purity::active(0)->pluck('name', 'id');

        return view('backend.supplier_billings.edit_supplier_billings', compact('supplier_billing', 'supplier', 'types', 'purities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierBilling $supplier_billing)
    {
         $validated = $request->validate([
            'supplier_id'    => 'nullable|string',
            'bill_amount'    => 'required|numeric|min:0',
            'payment_mode'   => 'required|integer',
            'paid'           => 'required|numeric|min:0|lte:bill_amount',
        ]);

        if ($request->file('bill_image') != null) {
            if (file_exists($supplier_billing->bill_image)) {
                $img = explode('.', $supplier_billing->bill_image);
                $small_img = $img[0] . '_' . $this->image_preset[0]->name . '.' . $img[1];
                unlink($small_img);
                unlink($supplier_billing->bill_image);
            }
            $image = $request->file('bill_image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            if ($supplier_billing->bill_image != '') {
                $save_url = $supplier_billing->bill_image;
            } else {
                $save_url = '';
            }
        }

        $supplier_billing->update([
            'supplier_id'    => $request->supplier_id,
            'bill_image'     => $save_url,
            'bill_amount'    => $request->bill_amount,
            'paid'           => $request->paid,
            'payment_mode'   => $request->payment_mode,
            'transaction_id' => $request->transaction_id,
        ]);

        $notification = [
            'message' => 'SupplierBilling Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierBilling $supplier_billings)
    {
        $supplier_billings->delete();

        $notification = [
            'message' => 'SupplierBilling Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
