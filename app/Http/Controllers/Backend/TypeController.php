<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    use CommonTrait;

    public function index()
    {
        $types = Type::get();

        return view('backend.types.all_type', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.types.add_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|unique:types|max:200',
        ]);

        Type::insert([
            'name' => $request->name,
        ]);

        $notification = [
            'message' => 'Service Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {

        return view('backend.types.edit_type', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => 'required|max:200|unique:types,name,'.$type->id,
        ]);

        $type->update([
            'name' => $request->name,

        ]);
        $notification = [
            'message' => 'Service Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function delete(Request $request)
    {
        if (is_array($request->id)) {

            $cat = Type::whereIn('id', $request->id);
        } else {
            $cat = Type::find($request->id);
        }
        $cat->delete($request->id);
        $notification = [
            'message' => 'Category Deleted successfully',
            'alert-type_id' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    protected function Name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
}
