{{-- resources/views/components/backend/backend_component/type-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('type.update', $type->id) : route('type.store')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Category Type Name --}}
    <div class="row mb-3">
        <div class="col-6">

            <x-form.input-label for="category_id" value="Category" />
            <x-form.select name="category_id" :options="$categories" :selected="$type->category_id ?? ''" placeholder="Select Category" />
            <x-form.input-error :messages="$errors->get('category_id')" />

        </div>
        <div class="col-6">
            <x-form.input-label for="name" value="Name" />
            <x-form.text-input
                name="name"
                :value="$type->name ?? ''"
                required
                placeholder="Enter Name"
            />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
