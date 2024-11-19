{{-- resources/views/components/backend/backend_component/site-settings-form.blade.php --}}


{!! Form::open([
    'method' => 'patch',
    'route' => ['update.site.setting', $sitesetting->id],
    'class' => 'forms-sample needs-validation',
    'novalidate' => 'novalidate',
    'files' => true,
]) !!}
<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <?php

            if ($sitesetting->logo != null) {
                $wsize = 10;
                $small_img = $sitesetting->logo;
            } else {
                $small_img = '';
                $wsize = 12;
            }
            ?>
            <div class="col-sm-{{ $wsize }}">
                <div class="mb-3">

                    {!! Form::label('logo', 'Logo', ['class' => 'form-label']) !!}

                    {!! Form::file('logo', [
                        'class' => 'form-control',
                        'placeholder' => 'Main Thumbnail',
                        'onchange' => 'mainThamUrl(this)',
                    ]) !!}
                    @error('logo')
                        <span class="text-danger pt-3">{{ $message }}</span>
                    @enderror
                    <div class="mt-3">
                        <img src="" id="mainThmb" class="img-responsive border border-1">
                    </div>
                </div>
            </div>
            @if ($sitesetting->logo != null)
                <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                        class="img-thumbnail img-fluid img-responsive w-10">
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <?php

            if ($sitesetting->favicon != null) {
                $wsize = 10;
                $small_img = $sitesetting->favicon;
            } else {
                $small_img = '';
                $wsize = 12;
            }
            ?>
            <div class="col-sm-{{ $wsize }}">
                <div class="mb-3">

                    {!! Form::label('favicon', 'Favicon', ['class' => 'form-label']) !!}

                    {!! Form::file('favicon', [
                        'class' => 'form-control',
                        'placeholder' => 'Main Thumbnail',
                        'onchange' => 'mainThamUrl(this)',
                    ]) !!}
                    @error('favicon')
                        <span class="text-danger pt-3">{{ $message }}</span>
                    @enderror
                    <div class="mt-3">
                        <img src="" id="mainThmb" class="img-responsive border border-1">
                    </div>
                </div>
            </div>
            @if ($sitesetting->favicon != null)
                <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                        class="img-thumbnail img-fluid img-responsive w-10">
                </div>
            @endif
        </div>
    </div>
</div>


<div class="row">

    <div class="col-sm-6">
        <div class="mb-3">

            {!! Form::label('site_title', 'Site Title', ['class' => 'form-label']) !!}

            {!! Form::text('site_title', $value = $sitesetting->site_title, [
                'class' => 'form-control',
                'placeholder' => 'site_title',
                'required' => 'required',
            ]) !!}
            @error('site_title')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">

            {!! Form::label('app_name', 'App Name', ['class' => 'form-label']) !!}

            {!! Form::text('app_name', $value = $sitesetting->app_name, [
                'class' => 'form-control',
                'placeholder' => 'App Name',
                'required' => 'required',
            ]) !!}
            @error('site_title')
                <span class="text-danger pt-3">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


<div class="col-sm-12">
    <div class="mb-3 ">


        {!! Form::label('tax', 'Tax', ['class' => 'form-label']) !!}

        {!! Form::number('tax', $value = $sitesetting->tax, [
            'class' => 'form-control',
            'max' => 50,
            'placeholder' => 'Tax',
        ]) !!}

    </div>
</div>

<div class="row">

    <div class="col-sm-6">
        <div class="mb-3">

            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

            {!! Form::text('email', $value = $sitesetting->email, [
                'id' => 'emails',
                'class' => 'form-control',
                'placeholder' => 'Email',
            ]) !!}

        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">

            {!! Form::label('support_phone', 'Phone', ['class' => 'form-label']) !!}

            {!! Form::text('support_phone', $value = $sitesetting->support_phone, [
                'id' => 'static-masks',
                'class' => 'form-control',
                'placeholder' => 'Phone',
            ]) !!}

        </div>

    </div>
</div>
<div class="row">
    <div class="mb-3">
        {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
        {!! Form::textarea('address', $sitesetting->address ?? null, [
            'class' => 'form-control',
            'rows' => 2,
            'placeholder' => 'Address',
        ]) !!}

    </div>
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-primary _effect--ripple waves-effect waves-light']) !!}
{{ Form::close() }}
