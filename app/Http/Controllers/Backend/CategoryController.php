<?php
	
	namespace App\Http\Controllers\Backend;
	
	use App\DataTables\CategoryDataTable;
	use App\Http\Controllers\Controller;
	use App\Models\Category;
	use App\Models\Type;
	use App\Traits\CommonTrait;
	use Illuminate\Http\Request;
	
	class CategoryController extends Controller
	{
		use CommonTrait;
		
		/**
			* Display a listing of the resource.
		*/
		public function index(CategoryDataTable $dataTable)
		{
			return $dataTable->render('backend.category.all_category');
		}
		
		/**
			* Show the form for creating a new resource.
		*/
		public function create()
		{
			return view('backend.category.add_category');
		}
		
		/**
			* Store a newly created resource in storage.
		*/
		public function store(Request $request)
		{
			$validated = $request->validate([
            'name' => 'required',
			]);
			
			Category::create([
            'name' => $request->name,
			]);
			
			$notification = [
            'message' => 'Category Added Successfully',
            'alert-type' => 'success',
			];
			
			return redirect()->back()->with($notification);
		}
		
		/**
			* Show the form for editing the specified resource.
		*/
		public function edit(Category $category)
		{
			return view('backend.category.edit_category', compact('category'));
		}
		
		/**
			* Update the specified resource in storage.
		*/
		public function update(Request $request, Category $category)
		{
			$category->update([
            'name' => $request->name,
			]);
			
			$notification = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success',
			];
			
			return redirect()->back()->with($notification);
		}
		
		/**
			* Remove the specified resource from storage.
		*/
		public function destroy(Category $category)
		{
			$category->delete();
			
			$notification = [
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
			];
			
			return redirect()->back()->with($notification);
		}
		
		public function GetType(Request $request)
		{
			$types = Type::active(0)
            ->where('category_id', $request->category_id)
            ->orderBy('name', 'ASC')
            ->withSum([
			'products as stock_qty' => function ($q) {
				$q->where('stock_qty', '>', 0);
			},
            ], 'stock_qty')
            ->get();
			
			$html = '<option value="">- Select Types -</option>';
			
			foreach ($types as $type) {
				$qty = round((float) ($type->stock_qty ?? 0));
				if ($qty > 0) {
					$html .= '<option value="'.$type->id.'">'
                    .$type->name.' ('.$qty.')'
                    .'</option>';
				}
			}
			
			return response($html);
		}
		
	    public function GetTypeAll(Request $request)
		{
			$types = Type::active(0)
            ->where('category_id', $request->category_id)
            ->orderBy('name', 'ASC')
            
            ->get();
			
			$html = '<option value="">- Select Types -</option>';
			
			foreach ($types as $type) {
				
                $html .= '<option value="'.$type->id.'">'
				.$type->name.'</option>';
				
			}
			
			return response($html);
		}
	}
