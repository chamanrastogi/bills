{{-- resources/views/components/backend/backend_component/product-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('products.update', $product->id) : route('products.store')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    enctype="multipart/form-data"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Category, Name & Unit --}}
    <div class="row">
        {{-- Category --}}
        <div class="col-sm-4">
            <x-form.input-label for="category_id" value="Category" />
            <x-form.select
                name="category_id"
                :options="$categories"
                :selected="$product->category_id ?? ''"
                placeholder="Select Category"
            />
            <x-form.input-error :messages="$errors->get('category_id')" />
        </div>

        {{-- Product Name --}}
        <div class="col-sm-4">
            <x-form.input-label for="name" value="Name" />
            <x-form.text-input
                name="name"
                :value="$product->name ?? ''"
                required
                placeholder="Product Name"
            />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>

        {{-- Unit --}}
        <div class="col-sm-4">
            <x-form.input-label for="unit_id" value="Unit" />
            <x-form.select
                name="unit_id"
                :options="$units"
                :selected="$product->unit_id ?? ''"
                placeholder="Select Unit"
            />
            <x-form.input-error :messages="$errors->get('unit_id')" />
        </div>
    </div>

    {{-- Image Upload --}}
    <div class="row pt-3">
        <div class="col-sm-10">
            @php
                if (!empty($product->image)) {
                    $img = explode('.', $product->image);
                    $small_img = $img[0] . '_thumb.' . $img[1];
                } else {
                    $small_img = '/upload/no_image.jpg';
                }
            @endphp
            <x-form.input-label for="image" value="Image" />
            <x-form.file-input
                name="image"
                id="image"
                onchange="mainThamUrl(this)"
                placeholder="Main Thumbnail"
            />
            <x-form.input-error :messages="$errors->get('image')" />
            <img src="" id="mainThmb" class="img-thumbnail img-fluid img-responsive w-10 my-3">
        </div>
        <div class="mt-3 col-sm-2">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid img-responsive w-10">
        </div>
    </div>

    {{-- Price --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <x-form.input-label for="price" value="Price" />
                <x-form.text-input
                    type="number"
                    name="price"
                    :value="$product->price ?? ''"
                    required
                    placeholder="Price"
                />
                <x-form.input-error :messages="$errors->get('price')" />
            </div>
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
