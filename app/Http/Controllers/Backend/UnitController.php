<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Traits\CommonTrait;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('backend.unit.all_unit', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.unit.add_unit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|unique:units|max:200',
        ]);


        unit::insert([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Unit Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(unit $unit)
    {
        return view('backend.unit.edit_unit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, unit $unit)
    {
        $validated = $request->validate([
            'name' =>
            'required|max:200|unique:units,name,' . $unit->id,
        ]);



        $unit->update([
            'name' => $request->name

        ]);
        $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */


    public function delete(Request $request)
    {
        $cat = unit::find($request->id);
        $cat->delete($request->id);
        $notification = array(
            'message' => 'Unit Deleted successfully',
            'alert-unit_id' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
