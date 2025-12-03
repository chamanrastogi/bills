{{-- resources/views/components/backend/backend_component/purity-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('purity.update', $purity->id) : route('purity.store')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Product Type Name --}}
    <div class="row mb-3">
        {{-- Type --}}
        <div class="col-sm-6">
            <x-form.input-label for="category_id" value="Category" />
            <x-form.select
                name="category_id"
                :options="$categories"
                :selected="$purity->category_id ?? ''"
                placeholder="Select Category"
            />
            <x-form.input-error :messages="$errors->get('category_id')" />
        </div>
        <div class="col-sm-6">
            <x-form.input-label for="name" value="Name" />
            <x-form.text-input
                name="name"
                :value="$purity->name ?? ''"
                required
                placeholder="Enter Name"
            />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button purity="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
