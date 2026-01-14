<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImagePresets;
use App\Models\Product;
use App\Models\Purity;
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
        $categories = Category::active(0)->pluck('name', 'id');
        $types = Type::where('status', 0)->pluck('name', 'id');
        $units = Unit::where('status', 0)->pluck('fname', 'id');

        return view('backend.product.add_product', compact('purities', 'categories', 'types', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:200',
            'type_id' => 'required',
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
        if (isset($request->price)) {
            if ($request->price > 0) {
                $price_value = $request->price;
            } else {
                $price_value = number_format(
                    ($request->rate_per_gram * $request->net_weight + $request->making_charge) *
                        (1 + $request->gst_percent / 100) *
                        $request->stock_qty,
                    2,
                );
            }
        }
        $price_value = str_replace(',', '', $price_value);
        product::insert([
            'sku' => $request->sku,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'image' => $save_url,
            'purity_id' => $request->purity_id,
            'unit_id' => $request->unit_id,
            'gross_weight' => $request->gross_weight,
            'net_weight' => $request->net_weight,
            'making_charge' => $request->making_charge ?? 0,
            'rate_per_gram' => $request->rate_per_gram ?? 0,
            'gst_percent' => $request->gst_percent ?? 0,
            'stock_qty' => $request->stock_qty ?? 1,
            'price' => $price_value,
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
        $categories = Category::active(0)->pluck('name', 'id');
        $products = Product::all();
        $purities = Purity::where('status', 0)->where('id', $product->purity_id)->pluck('name', 'id');
        $categories = Category::active(0)->pluck('name', 'id');
        $types = Type::where('status', 0)->where('id', $product->type_id)->pluck('name', 'id');
        $units = Unit::where('status', 0)->pluck('fname', 'id');

        return view('backend.product.edit_product', compact('product', 'purities', 'types', 'units', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
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

        if (isset($request->price)) {
            if ($request->price > 0) {
                $price_value = $request->price;
            } else {
                $price_value = number_format(
                    ($request->rate_per_gram * $request->net_weight + $request->making_charge) *
                        (1 + $request->gst_percent / 100) *
                        $request->stock_qty,
                    2,
                );
            }
        }
        $price_value = str_replace(',', '', $price_value);
        $product->update([
            'sku' => $request->sku,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'price' => $price_value,
            'image' => $save_url,
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
        $purities = Purity::where('category_id', $request->category_id)
            ->orderBy('name', 'ASC')
            ->get();

        $html = '<option value="">-Select Purity-</option>';
        foreach ($purities as $purity) {
            $html .= '<option value="'.$purity->id.'">'.$purity->name.'</option>';
        }

        return $html;
    }

    public function GetProducts(string $type)
    {
        // Return only active products (status = 0) that are in stock (pstatus = 'in_stock')
        $products = Product::where('type_id', $type)
            ->where('status', 0)
            ->where('pstatus', 'in_stock')
            ->where('stock_qty', '>', 0)
            ->with('unit')
            ->with('purity')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->bill_image ?: $product->image,
                    'unit' => [
                        'id' => $product->unit?->id,
                        'name' => $product->unit?->name ?? '',
                    ],
                    'purity' => [
                        'id' => $product->purity?->id,
                        'name' => $product->purity?->name ?? '',
                    ],
                    'category' => $product->type->category->name,
                    'gross_weight' => $product->gross_weight,
                    'net_weight' => $product->net_weight,
                    'making_charge' => $product->making_charge,
                    'rate_per_gram' => $product->rate_per_gram,
                    'gst_percent' => $product->gst_percent,
                    'stock_qty' => $product->stock_qty,
                ];
            });

        return response()->json($products);
    }
}
