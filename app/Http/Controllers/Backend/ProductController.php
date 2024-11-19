<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ImagePresets;
use App\Traits\ImageGenTrait;
use App\Traits\CommonTrait;

class ProductController extends Controller
{
    public $path = "upload/product/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    use CommonTrait;
    public function __construct()
    {
        $this->image_preset = ImagePresets::whereIn('id', [4, 12])->get();
        $this->image_preset_main = ImagePresets::find(11);
    }

    public function index()
    {
        $products = product::latest()->get();
        return view('backend.product.all_product', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('backend.product.add_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:200',
            'price' => 'required'
        ]);
        $image = $request->file('image');
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        } else {
            $save_url = '';
        }

        product::insert([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $save_url,
            'price' => $request->price,
            'text' => $request->text,
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success',
        );
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
        $categories = Category::pluck('name', 'id');
        return view('backend.product.edit_product', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:200|unique:products,name,' . $product->id,
            'price' => 'required'
        ]);
        if ($request->file('image') != null) {
            if (file_exists($product->image)) {
                $img = explode('.', $product->image);
                $small_img = $img[0] . "_" . $this->image_preset[0]->name . "." . $img[1];
                unlink($small_img);
                unlink($product->post_image);
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

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $save_url,
            'price' => $request->price,
            'text' => $request->text,
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success',
        );
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
            $blogs = Product::whereIn('id', $request->id);
            foreach ($blogs as $blog) {
                if (file_exists($blog->image)) {
                    $img = explode('.', $blog->image);
                    $small_img = $img[0] . "_" . $this->image_preset[0]->name . "." . $img[1];
                    unlink($small_img);
                    unlink($blog->image);
                }
            }
        } else {
            $blogs = Product::find($request->id);
            if (file_exists($blogs->image)) {
                $img = explode('.', $blogs->image);
                $small_img = $img[0] . "_" . $this->image_preset[0]->name . "." . $img[1];
                unlink($small_img);
                unlink($blogs->image);
            }
        }

        $blogs->delete();
        $notification = array(
            'message' => 'Product Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function GetProducts(string $category)
    {
        $products = Product::where('category_id', $category)->get();
        return $products;
    }
}
