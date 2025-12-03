{{-- resources/views/components/backend/backend_component/blog-form.blade.php --}}

<x-form.form :route="$isEdit ? route('blog.update', $blog->id) : route('blog.store')" :isEdit="$isEdit" hasFiles>

    {{-- Blog Category --}}
    <div class="mb-3">
        <x-form.input-label for="blogcat_id" value="Blog Category" />
        <x-form.select name="blogcat_id" :options="$blogCategories" :selected="$blog->blogcat_id ?? null" placeholder="Select Blog Category" />
        <x-form.input-error :messages="$errors->get('blogcat_id')" class="mt-2" />
    </div>

    {{-- Image Upload --}}
    @php
        $small_img = !empty($blog->post_image)
            ? explode('.', $blog->post_image)[0] . '_thumb.' . explode('.', $blog->post_image)[1]
            : '/upload/no_image.jpg';
    @endphp

    <div class="row">
        <div class="col-sm-10">
            <x-form.input-label for="post_image" value="Image" />
            <x-form.file-input name="post_image" onchange="mainThamUrl(this)" />
            <x-form.input-error :messages="$errors->get('post_image')" class="mt-2" />
            <img src="" class="img-thumbnail img-fluid w-10 my-3" id="mainThmb" />
        </div>
        <div class="col-sm-2 mt-3">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid w-10" />
        </div>
    </div>

    {{-- Post Title --}}
    <div class="mb-3">
        <x-form.input-label for="post_title" value="Post Title" />
        <x-form.text-input name="post_title" :value="$blog->post_title ?? ''" required placeholder="Post Title" />
        <x-form.input-error :messages="$errors->get('post_title')" class="mt-2" />
    </div>

    {{-- Popular Text Field (fix original error where it duplicated Post Title) --}}
    <div class="mb-3">
        <x-form.input-label for="popular" value="Popular" />
        <x-form.text-input name="popular" :value="$blog->popular ?? ''" required placeholder="Popular" />
        <x-form.input-error :messages="$errors->get('popular')" class="mt-2" />
    </div>

    {{-- Popular Checkbox --}}
    <div class="form-check form-check-primary form-check-inline">
        <input type="checkbox" name="popular" id="form-check-default" value="1" class="form-check-input"
            {{ $blog->popular == 1 ? 'checked' : '' }}>
        <label for="form-check-default" class="form-check-label">Popular</label>
    </div>

    {{-- Short Description --}}
    <div class="mb-3">
        <x-form.input-label for="short_descp" value="Short Description" />
        <x-form.textarea name="short_descp" rows="2" placeholder="Short Description">
            {!! $blog->short_descp ?? '' !!}
        </x-form.textarea>
        <x-form.input-error :messages="$errors->get('short_descp')" class="mt-2" />
    </div>

    {{-- Long Description --}}
    <div class="mb-3">
        <x-form.input-label for="long_descp" value="Long Description" />
        <x-form.textarea name="long_descp" id="editor" rows="4" placeholder="Long Description">
            {!! $blog->long_descp ?? '' !!}
        </x-form.textarea>
        <x-form.input-error :messages="$errors->get('long_descp')" class="mt-2" />
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
