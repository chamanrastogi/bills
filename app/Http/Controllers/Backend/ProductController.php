<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\ImagePresets;
use App\Models\Product;
use App\Models\Purity;
use App\Models\Supplier;
use App\Models\Type;
use App\Models\Unit;
use App\Traits\CommonTrait;
use App\Traits\ImageGenTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $path = 'upload/product/thumbnail/';

    public $image_preset;

    public $image_preset_main;

    use CommonTrait;
    use ImageGenTrait;

    public function __construct()
    {
        $this->image_preset = ImagePresets::whereIn('id', [4, 12])->get();
        $this->image_preset_main = ImagePresets::find(11);
    }

    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('backend.product.all_product');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purities = [];
        $types = Type::where('status', 0)->pluck('name', 'id');
        $units = Unit::where('status', 0)->pluck('fname', 'id');
        $suppliers = Supplier::where('status', 0)->pluck('name', 'id');

        return view('backend.product.add_product', compact('purities', 'types', 'units', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:200',
            'gross_weight' => 'required|numeric|min:0',
            'net_weight' => 'required|numeric|min:0',
            'making_charge' => 'nullable|numeric|min:0',
        ]);
        $image = $request->file('image');
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url = '';
        }
        $bill_image = $request->file('bill_image');
        if ($request->file('bill_image') != null) {
            $bill_image = $request->file('bill_image');
            $bill_save_url = $this->imageGenrator($bill_image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $bill_save_url = '';
        }
$price = str_replace(',', '', $request->price);
        product::insert([
            'supplier_id' => $request->supplier_id,
            'sku' => $request->sku,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'image' => $save_url,
            'bill_image' => $bill_save_url,
            'purity_id' => $request->purity_id,
            'unit_id' => $request->unit_id,
            'gross_weight' => $request->gross_weight,
            'net_weight' => $request->net_weight,
            'making_charge' => $request->making_charge ?? 0,
            'rate_per_gram' => $request->rate_per_gram ?? 0,
            'gst_percent' => $request->gst_percent ?? 0,
            'stock_qty' => $request->stock_qty ?? 1,
            'price' => $price,
            'pstatus' => $request->pstatus ?? 'in_stock',

        ]);

        $notification = [
            'message' => 'Product Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
            $products = Product::all();
            $purities = Purity::where('status', 0)->where('type_id', $product->type_id)->pluck('name', 'id');
            $types = Type::where('status', 0)->pluck('name', 'id');
            $units = Unit::where('status', 0)->pluck('fname', 'id');
            $suppliers = Supplier::where('status', 0)->pluck('name', 'id');

            return view('backend.product.edit_product', compact('product', 'purities', 'types', 'units', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'name' => 'required',
            'gross_weight' => 'required|numeric|min:0',
            'net_weight' => 'required|numeric|min:0',
            'making_charge' => 'nullable|numeric|min:0',
        ]);
        if ($request->file('image') != null) {
            if (file_exists($product->image)) {
                $img = explode('.', $product->image);
                $small_img = $img[0].'_'.$this->image_preset[0]->name.'.'.$img[1];
                unlink($small_img);
                unlink($product->image);
            }
            $image = $request->file('image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            if ($product->image != '') {
                $save_url = $product->image;
            } else {
                $save_url = '';
            }
        }

        if ($request->file('bill_image') != null) {
            if (file_exists($product->bill_image)) {
                $bill_img = explode('.', $product->bill_image);
                $small_img = $bill_img[0].'_'.$this->image_preset[0]->name.'.'.$bill_img[1];
                unlink($small_img);
                unlink($product->bill_image);
            }
            $bill_image = $request->file('bill_image');
            $bill_save_url = $this->imageGenrator($bill_image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            if ($product->bill_image != '') {
                $bill_save_url = $product->bill_image;
            } else {
                $bill_save_url = '';
            }
        }
$price = str_replace(',', '', $request->price);
        $product->update([
            'supplier_id' => $request->supplier_id,
            'sku' => $request->sku,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'price' => $price,
            'image' => $save_url,
            'bill_image' => $bill_save_url,
            'purity_id' => $request->purity_id,
            'unit_id' => $request->unit_id,
            'gross_weight' => $request->gross_weight,
            'net_weight' => $request->net_weight,
            'making_charge' => $request->making_charge ?? 0,
            'rate_per_gram' => $request->rate_per_gram ?? 0,
            'gst_percent' => $request->gst_percent ?? 0,
            'stock_qty' => $request->stock_qty ?? 1,
            'pstatus' => $request->pstatus ?? 'in_stock',
        ]);

        $notification = [
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function delete(Request $request)
    {
        if (is_array($request->id)) {
            $products = Product::whereIn('id', $request->id);
            foreach ($products as $product) {
                if (file_exists($product->image)) {
                    $img = explode('.', $product->image);
                    $small_img = $img[0].'_'.$this->image_preset[0]->name.'.'.$img[1];
                    unlink($small_img);
                    unlink($product->image);
                }

                if (file_exists($product->bill_image)) {
                    $bill_img = explode('.', $product->bill_image);
                    $small_img = $bill_img[0].'_'.$this->image_preset[0]->name.'.'.$bill_img[1];
                    unlink($small_img);
                    unlink($product->bill_image);
                }
            }
        } else {
            $products = Product::find($request->id);
            if (file_exists($products->image)) {
                $img = explode('.', $products->image);
                $small_img = $img[0].'_'.$this->image_preset[0]->name.'.'.$img[1];
                unlink($small_img);
                unlink($products->image);
            }
            if (file_exists($products->bill_image)) {
                $bill_img = explode('.', $products->bill_image);
                $small_img = $bill_img[0].'_'.$this->image_preset[0]->name.'.'.$bill_img[1];
                unlink($small_img);
                unlink($products->bill_image);
            }
        }

        $products->delete();
        $notification = [
            'message' => 'Product Deleted successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function GetPurity(Request $request)
    {
        $purities = Purity::where('type_id', $request->type_id)
            ->orderBy('name', 'ASC')
            ->get();

        $html = '<option value="">Select Purity</option>';

        foreach ($purities as $purity) {
            $html .= '<option value="'.$purity->id.'">'.$purity->name.'</option>';
        }

        return $html;
    }

    public function GetProducts(string $type)
    {
        $products = Product::where('type_id', $type)->with('unit')->get();

        return $products;
    }
}
