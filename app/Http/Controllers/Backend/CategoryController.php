<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImagePresets;
use App\Traits\CommonTrait;
use App\Models\Category;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CommonTrait;

    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.all_category', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|unique:categories|max:200',
        ]);


        Category::insert([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Service Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('backend.categories.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' =>
            'required|max:200|unique:categories,name,' . $category->id,
        ]);



        $category->update([
            'name' => $request->name

        ]);
        $notification = array(
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function delete(Request $request)
    {
        $cat = Category::whereIn('id', $request->id);
        $cat->delete($request->id);
        $notification = array(
            'message' => 'Service Deleted successfully',
            'alert-category_id' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    protected function Name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
            set: fn(string $value) => strtolower($value),
        );
    }
}
