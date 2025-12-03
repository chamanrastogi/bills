{{-- resources/views/components/backend/backend_component/blog-form.blade.php --}}

<x-form.form :route="$isEdit ? route('category.update', $category->id) : route('category.store')" :isEdit="$isEdit" hasFiles>

    {{-- Blog Category --}}
   <div class="mb-3">
                <x-form.input-label for="name" value="Name" />
                <x-form.text-input name="name" :value="$category->name ?? ''" required placeholder="Name" />
                <x-form.input-error :messages="$errors->get('name')" />
            </div>


    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
