{{-- resources/views/components/backend/backend_component/blog-form.blade.php --}}


{{ Form::open([
    'route' => $isEdit ? ['blog.update', $blog->id] : 'blog.store',
    'class' => 'forms-sample needs-validation',
    'method' => $isEdit ? 'put' : 'post',
    'novalidate' => 'novalidate',
    'files' => true,    
]) }}

<div class="mb-3">
    {!! Form::label('blogcat_id', 'Blog Category', ['class' => 'form-label']) !!}
    {!! Form::select('blogcat_id', $blogCategories, $blog->blogcat_id ?? null, [
        'class' => 'form-control',
        'placeholder' => 'Select Blog Category',
    ]) !!}
</div>


<div class="row">
    <div class="col-sm-10">
        @php
            if (!empty($blog->post_image)) {
                $img = explode('.', $blog->post_image);
                $small_img = $img[0] . '_thumb.' . $img[1];
            } else {
                $small_img = '/upload/no_image.jpg'; # code...
            }
        @endphp
        {!! Form::label('post_image', 'Image', ['class' => 'form-label']) !!}
        {!! Form::file('post_image', [
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


<div class="mb-3">
    {!! Form::label('post_title', 'Post Title', ['class' => 'form-label']) !!}
    {!! Form::text('post_title', $blog->post_title ?? null, [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Post Title',
    ]) !!}
    @error('post_title')
        <span class="text-danger pt-3">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    {!! Form::label('popular', 'Popular', ['class' => 'form-label']) !!}
    {!! Form::text('popular', $blog->post_title ?? null, [
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Post Title',
    ]) !!}
    @error('post_title')
        <span class="text-danger pt-3">{{ $message }}</span>
    @enderror
</div>
<div class="form-check form-check-primary form-check-inline">
    {!! Form::checkbox('popular', 1, $blog->popular == 1, ['class' => 'form-check-input', 'id' => 'form-check-default']) !!}
    {!! Form::label('form-check-default', 'Popular',($blog->popular==1 ?false: true), ['class' => 'form-check-label']) !!}
</div>
<div class="row">
    <div class="mb-3">
        {!! Form::label('short_descp', 'Short Description', ['class' => 'form-label']) !!}
        {!! Form::textarea('short_descp', $blog->short_descp ?? null, [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Short Description',
        ]) !!}
        @error('short_descp')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="mb-3">
        {!! Form::label('long_descp', 'Long Description', ['class' => 'form-label']) !!}
        {!! Form::textarea('long_descp', $blog->long_descp ?? null, [
            'class' => 'form-control',
            'rows' => 4,
            'id' => 'editor',
            'placeholder' => 'Long Description',
        ]) !!}
        @error('long_descp')
            <span class="text-danger pt-3">{{ $message }}</span>
        @enderror
    </div>
</div>



{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
