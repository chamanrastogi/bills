<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Traits\CommonTrait;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();
        return view('backend.color.all_color', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.color.add_color');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|unique:colors|max:200',
        ]);


        Color::insert([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Color Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('backend.color.edit_color', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' =>
            'required|max:200|unique:colors,name,' . $color->id,
        ]);



        $color->update([
            'name' => $request->name

        ]);
        $notification = array(
            'message' => 'Color Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */


    public function delete(Request $request)
    {
        $cat = Color::find($request->id);
        $cat->delete($request->id);
        $notification = array(
            'message' => 'Color Deleted successfully',
            'alert-color_id' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
