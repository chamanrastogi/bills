{{-- resources/views/components/backend/backend_component/units-form.blade.php --}}
<x-form.form :route="$isEdit ? route('units.update', $unit->id) : route('units.store')" :method="$isEdit ? 'PUT' : 'POST'" :isEdit="$isEdit" enctype="multipart/form-data"
    class="forms-sample needs-validation" novalidate>

    <div class="row">
        <div class="col-6">
            {{-- Unit Name --}}
            <div class="mb-3">
                <x-form.input-label for="name" value="Short Name" />
                <x-form.text-input name="name" :value="$unit->name ?? ''" required placeholder="Name" />
                <x-form.input-error :messages="$errors->get('name')" />
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <x-form.input-label for="fname" value="Full Name" />
                <x-form.text-input name="fname" :value="$unit->fname ?? ''" required placeholder="Full Name" />
                <x-form.input-error :messages="$errors->get('fname')" />
            </div>
        </div>
    </div>



    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
