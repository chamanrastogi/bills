<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purity;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class PurityController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Purity::get();
        return view('backend.purity.all_purity', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.purity.add_purity');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Purity::create([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Purity Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purity $purity)
    {
        return view('backend.purity.edit_purity', compact('purity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purity $purity)
    {
        $purity->update([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Purity Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purity $purity)
    {
        $purity->delete();

        $notification = [
            'message' => 'Purity Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
