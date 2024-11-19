
{{-- resources/views/components/backend/backend_component/admin-user-form.blade.php --}}

{{ Form::open([
    'route' => $isEdit ? ['update.admin', $user->id] : 'store.admin',
    'class' => 'forms-sample needs-validation',
    'novalidate' => 'novalidate',
    'method' => $isEdit ? 'put' : 'post',
    'files' => true,
]) }}

<div class="row">
    <div class="col-sm-10">
        @php
         if (!empty($user->photo)) {
            $img = explode('.', $user->photo);
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
            <img src="{{ asset($small_img) }}"
            class="img-thumbnail img-fluid img-responsive w-10">


        </div>


</div>

<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">

            {!! Form::label('username', 'User Name', ['class' => 'form-label']) !!}

            {!! Form::text('username',  $user->username ?? null, [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'User Name',
            ]) !!}
            @error('username')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror



        </div>

    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('name', 'Full Name', ['class' => 'form-label']) !!}

            {!! Form::text('name',  $user->name ?? null, [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Full Name',
            ]) !!}
            @error('name')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

            {!! Form::text('email', $user->email ?? null, [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Email',
            ]) !!}
            @error('email')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('phone', 'Phone', ['class' => 'form-label']) !!}

            {!! Form::text('phone', $user->phone ?? null, ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
            @error('phone')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}

            {!! Form::text('address', $user->address ?? null, ['class' => 'form-control', 'placeholder' => 'Address']) !!}
            @error('address')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-sm-6">
        <div class="mb-3">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            @error('password')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>





{!! Form::submit($isEdit ? 'Update' : 'Submit', [
    'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
]) !!}
{{ Form::close() }}
