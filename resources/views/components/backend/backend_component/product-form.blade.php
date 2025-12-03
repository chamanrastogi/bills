{{-- resources/views/components/backend/backend_component/product-form.blade.php --}}

<x-form.form :route="$isEdit ? route('products.update', $product->id) : route('products.store')" :method="$isEdit ? 'PUT' : 'POST'" :isEdit="$isEdit" enctype="multipart/form-data"
    class="forms-sample needs-validation" novalidate>

    <div class="row">
        {{-- SKU --}}
        <div class="col-sm-4">
            <x-form.input-label for="sku" value="SKU" />
            <x-form.text-input name="sku" :value="$product->sku ?? ''" required placeholder="Unique SKU Code" />
            <x-form.input-error :messages="$errors->get('sku')" />
        </div>
        {{-- Type --}}
        <div class="col-sm-4">
            <x-form.input-label for="category_id" value="Category" />
            <x-form.select name="category_id" id="category_id" :options="$categories" :selected="$product->type->category->id ?? ''"
                placeholder="Select Category" />
            <x-form.input-error :messages="$errors->get('category_id')" />
        </div>

        {{-- Type --}}
        <div class="col-sm-4">
            <x-form.input-label for="type_id" value="Type" />
            <x-form.select name="type_id" id="types_name" :options="$types" :selected="$product->type_id ?? ''"
                placeholder="Select Type" />
            <x-form.input-error :messages="$errors->get('type_id')" />
        </div>
    </div>

    {{-- Product Name & Unit --}}
    <div class="row mt-3">
        <div class="col-sm-4">
            <x-form.input-label for="name" value="Product Name" />
            <x-form.text-input name="name" :value="$product->name ?? ''" required placeholder="Product Name" />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>
        {{-- Purity --}}
        <div class="col-sm-4">
            <x-form.input-label for="purity_id" value="Purity" />
            <x-form.select name="purity_id" id="prurities_name" :options="$purities" :selected="$product->purity_id ?? ''"
                placeholder="Select Purity (e.g. 22K, 18K)" />
            <x-form.input-error :messages="$errors->get('purity_id')" />
        </div>
        <div class="col-sm-4">
            <x-form.input-label for="unit_id" value="Unit" />
            <x-form.select name="unit_id" :options="$units" :selected="$product->unit_id ?? ''" placeholder="Select Unit" />
            <x-form.input-error :messages="$errors->get('unit_id')" />
        </div>
    </div>

    {{-- Image Upload --}}
    <div class="row pt-3">
        <div class="col-sm-10">
            @php
                $small_img = !empty($product->image)
                    ? preg_replace('/\.(?=[^.]*$)/', '_thumb.', $product->image)
                    : '/upload/no_image.jpg';
            @endphp

            <x-form.input-label for="image" value="Product Image" />
            <x-form.file-input name="image" id="image" onchange="mainThamUrl(this)"
                placeholder="Main Thumbnail" />
            <x-form.input-error :messages="$errors->get('image')" />
            <img src="" id="mainThmb" class="img-thumbnail img-fluid img-responsive w-10 my-3">
        </div>

        <div class="mt-3 col-sm-2">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid img-responsive w-10">
        </div>
    </div>

    {{-- Weight & Rate --}}
    <div class="row mt-3">
        <div class="col-sm-3">
            <x-form.input-label for="gross_weight" value="Gross Weight (g)" />
            <x-form.text-input type="number" step="0.0001" name="gross_weight" :value="$product->gross_weight ?? ''" required
                placeholder="Gross Weight" />
            <x-form.input-error :messages="$errors->get('gross_weight')" />
        </div>

        <div class="col-sm-3">
            <x-form.input-label for="net_weight" value="Net Weight (g)" />
            <x-form.text-input type="number" step="0.0001" name="net_weight" :value="$product->net_weight ?? ''" required
                placeholder="Net Weight" />
            <x-form.input-error :messages="$errors->get('net_weight')" />
        </div>

        <div class="col-sm-3">
            <x-form.input-label for="rate_per_gram" value="Rate / Gram" />
            <x-form.text-input type="number" step="0.01" name="rate_per_gram" :value="$product->rate_per_gram ?? ''"
                placeholder="Rate per Gram" />
            <x-form.input-error :messages="$errors->get('rate_per_gram')" />
        </div>

        <div class="col-sm-3">
            <x-form.input-label for="making_charge" value="Making Charge" />
            <x-form.text-input type="number" step="0.01" name="making_charge" :value="$product->making_charge ?? ''"
                placeholder="Making Charge" />
            <x-form.input-error :messages="$errors->get('making_charge')" />
        </div>
    </div>

    {{-- Stock, Price & Status --}}
    <div class="row mt-3">
        <div class="col-sm-3">
            <x-form.input-label for="gst_percent" value="Gst Percentage" />
            <x-form.text-input type="number" step="1" name="gst_percent" :value="$product->gst_percent ?? '1'"
                placeholder="Gst Percentage" />
            <x-form.input-error :messages="$errors->get('gst_percent')" />
        </div>
        <div class="col-sm-3">
            <x-form.input-label for="stock_qty" value="Stock Quantity" />
            <x-form.text-input type="number" step="1" name="stock_qty" :value="$product->stock_qty ?? '1'" required
                placeholder="Available Stock Quantity" />
            <x-form.input-error :messages="$errors->get('stock_qty')" />
        </div>

        <div class="col-sm-3">
            <x-form.input-label for="price" value="Price" />
            <x-form.text-input name="price" :value="$product->price ?? 0" placeholder="Total Price" />
            <x-form.input-error :messages="$errors->get('price')" />
        </div>

        <div class="col-sm-3">
            <x-form.input-label for="pstatus" value="Product Status" />
            <x-form.select name="pstatus" :options="['in_stock' => 'In Stock', 'sold' => 'Sold', 'returned' => 'Returned']" :selected="$product->pstatus ?? 'in_stock'" placeholder="Select Product Status" />
            <x-form.input-error :messages="$errors->get('pstatus')" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update Product' : 'Add Product' }}
    </x-form.button>

</x-form.form>
