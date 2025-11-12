{{-- resources/views/components/backend/backend_component/admin-user-form.blade.php --}}

<x-form.form
    :route="$isEdit ? route('update.admin', $user->id) : route('store.admin')"
    :method="$isEdit ? 'PUT' : 'POST'"
    :isEdit="$isEdit"
    enctype="multipart/form-data"
    class="forms-sample needs-validation"
    novalidate
>

    {{-- Image Upload --}}
    <div class="row mb-3">
        <div class="col-sm-10">
            <x-form.input-label for="image" value="Image" />
            <x-form.file-input
                name="image"
                onchange="mainThamUrl(this)"
                placeholder="Main Thumbnail"
            />
            <x-form.input-error :messages="$errors->get('image')" />
            <img src="" id="mainThmb" class="img-thumbnail img-fluid img-responsive w-10 my-3">

        </div>

        @php
            if (!empty($user->photo)) {
                $img = explode('.', $user->photo);
                $small_img = $img[0] . '_thumb.' . $img[1];
            } else {
                $small_img = '/upload/no_image.jpg';
            }
        @endphp

        <div class="mt-3 col-sm-2">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid img-responsive w-10">
        </div>
    </div>

    {{-- User Info --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <x-form.input-label for="username" value="User Name" />
            <x-form.text-input
                name="username"
                :value="$user->username ?? ''"
                required
                placeholder="User Name"
            />
            <x-form.input-error :messages="$errors->get('username')" />
        </div>

        <div class="col-sm-6">
            <x-form.input-label for="name" value="Full Name" />
            <x-form.text-input
                name="name"
                :value="$user->name ?? ''"
                required
                placeholder="Full Name"
            />
            <x-form.input-error :messages="$errors->get('name')" />
        </div>
    </div>

    {{-- Contact Info --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <x-form.input-label for="email" value="Email" />
            <x-form.text-input
                name="email"
                :value="$user->email ?? ''"
                required
                placeholder="Email"
            />
            <x-form.input-error :messages="$errors->get('email')" />
        </div>

        <div class="col-sm-6">
            <x-form.input-label for="phone" value="Phone" />
            <x-form.text-input
                name="phone"
                :value="$user->phone ?? ''"
                placeholder="Phone"
            />
            <x-form.input-error :messages="$errors->get('phone')" />
        </div>
    </div>

    {{-- Address & Password --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <x-form.input-label for="address" value="Address" />
            <x-form.text-input
                name="address"
                :value="$user->address ?? ''"
                placeholder="Address"
            />
            <x-form.input-error :messages="$errors->get('address')" />
        </div>

        <div class="col-sm-6">
            <x-form.input-label for="password" value="Password" />
            <x-form.text-input
                type="password"
                name="password"
                placeholder="Password"
            />
            <x-form.input-error :messages="$errors->get('password')" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

</x-form.form>
