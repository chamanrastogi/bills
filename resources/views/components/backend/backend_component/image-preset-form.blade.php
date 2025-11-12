{{-- resources/views/components/backend/backend_component/image-preset-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('image_preset.update', $imagepreset->id) : route('image_preset.store')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    enctype="multipart/form-data"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Name, Width, Height Fields --}}
    <div class="row">
        <div class="col-lg-4 mb-3">
            <x-form.input-label for="name" value="Name" />
            <x-form.text-input
                name="name"
                :value="$imagepreset->name ?? ''"
                required
                placeholder="Name"
            />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>

        <div class="col-lg-4 mb-3">
            <x-form.input-label for="width" value="Width" />
            <x-form.text-input
                name="width"
                :value="$imagepreset->width ?? ''"
                required
                placeholder="Width"
            />
            <x-form.input-error :messages="$errors->get('width')" />
        </div>

        <div class="col-lg-4 mb-3">
            <x-form.input-label for="height" value="Height" />
            <x-form.text-input
                name="height"
                :value="$imagepreset->height ?? ''"
                required
                placeholder="Height"
            />
            <x-form.input-error :messages="$errors->get('height')" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
