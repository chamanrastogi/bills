{{-- resources/views/components/backend/backend_component/product-form.blade.php --}}

{{ Form::open([
    'route' => $isEdit ? ['products.update', $product->id] : 'products.store',
    'class' => 'forms-sample needs-validation',
    'novalidate' => 'novalidate',
    'method' => $isEdit ? 'put' : 'post',
]) }}

<div class="row">
    <div class="col-sm-4">
        {!! Form::label('category_id', 'Caregory', ['class' => 'form-label']) !!}
        {!! Form::Select('category_id', $categories, $product->category_id ?? null, [
            'class' => 'form-control',

            'placeholder' => 'Select Category',
        ]) !!}

    </div>
    <div class="col-sm-4">
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
        {!! Form::text('name', $product->name ?? null, [
            'class' => 'form-control',
            'required' => 'required',
            'placeholder' => 'Name',
        ]) !!}
        @error('name')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-4">
        {!! Form::label('unit_id', 'Unit', ['class' => 'form-label']) !!}
        {!! Form::Select('unit_id', $units, $product->unit_id ?? null, [
            'class' => 'form-control',
            'placeholder' => 'Select Unit',
        ]) !!}

    </div>
    <div class="row pt-3">
        <div class="col-sm-10">
            @php
                if (!empty($product->image)) {
                    $img = explode('.', $product->image);
                    $small_img = $img[0] . '_thumb.' . $img[1];
                } else {
                    $small_img = '/upload/no_image.jpg'; # code...
                }
            @endphp
            {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}
            {!! Form::file('image', [
                'class' => 'form-control',
                'placeholder' => 'Main Thumbnail',
                'onchange' => 'mainThamUrl(this)',
            ]) !!}
            @error('image')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
            <img src="" class="img-thumbnail img-fluid img-responsive w-10 my-3" id="mainThmb">
        </div>
        <div class="mt-3 col-sm-2">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid img-responsive w-10">
        </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        {!! Form::label('price', 'Price', ['class' => 'form-label']) !!}
        {!! Form::text('price', $product->price ?? null, [
            'class' => 'form-control',
            'required' => 'required',
            'placeholder' => 'Price',
        ]) !!}
        @error('price')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
    </div>
    <div class="mb-3">
        {!! Form::label('text', 'Description', ['class' => 'form-label']) !!}
        {!! Form::textarea('text', $product->text ?? null, [
            'class' => 'form-control',         
            'placeholder' => 'Description',
        ]) !!}

    </div>
</div>



{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
