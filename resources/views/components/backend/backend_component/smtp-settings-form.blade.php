{{-- resources/views/components/backend/backend_component/site-settings-form.blade.php --}}

<x-form.form :route="route('update.smpt.setting', $setting->id)" method="patch" files="true">

    <div class="row">
        {{-- Mailer Input --}}
        <div class="col-sm-4 mb-3">
            <x-form.input-label for="mailer" value="Mailer" />
            <x-form.text-input name="mailer" :value="$setting->mailer" placeholder="Mailer" />
            <x-form.input-error :messages="$errors->get('mailer')" class="pt-3" />
        </div>

        {{-- Host Input --}}
        <div class="col-sm-4 mb-3">
            <x-form.input-label for="host" value="Host" />
            <x-form.text-input name="host" :value="$setting->host" placeholder="Host" />
            <x-form.input-error :messages="$errors->get('host')" class="pt-3" />
        </div>

        {{-- Port Input --}}
        <div class="col-sm-4 mb-3">
            <x-form.input-label for="port" value="Port" />
            <x-form.text-input name="port" :value="$setting->port" placeholder="Port" />
            <x-form.input-error :messages="$errors->get('port')" class="pt-3" />
        </div>
    </div>

    <div class="row">
        {{-- Username Input --}}
        <div class="col-sm-4 mb-3">
            <x-form.input-label for="username" value="Username" />
            <x-form.text-input name="username" :value="$setting->username" placeholder="Username" />
            <x-form.input-error :messages="$errors->get('username')" class="pt-3" />
        </div>

        {{-- Password Input --}}
        <div class="col-sm-4 mb-3">
            <x-form.input-label for="password" value="Password" />
            <x-form.text-input name="password" :value="$setting->password" placeholder="Password" />
            <x-form.input-error :messages="$errors->get('password')" class="pt-3" />
        </div>

        {{-- Encryption Select --}}
        <div class="col-sm-4 mb-3">
            @php
                $data = ['ssl' => 'SSL', 'tls' => 'TLS'];
            @endphp
            <x-form.input-label for="encryption" value="Encryption" />
            <x-form.select name="encryption" :options="$data" :selected="$setting->encryption" placeholder="Select Encryption" />
            <x-form.input-error :messages="$errors->get('encryption')" class="pt-3" />
        </div>
    </div>

    <div class="row">
        {{-- From Name Input --}}
        <div class="col-sm-6 mb-3">
            <x-form.input-label for="from_name" value="From Name" />
            <x-form.text-input name="from_name" :value="$setting->from_name" placeholder="From Name" />
            <x-form.input-error :messages="$errors->get('from_name')" class="pt-3" />
        </div>

        {{-- From Address Input --}}
        <div class="col-sm-6 mb-3">
            <x-form.input-label for="from_address" value="From Address" />
            <x-form.text-input name="from_address" :value="$setting->from_address" placeholder="From Address" />
            <x-form.input-error :messages="$errors->get('from_address')" class="pt-3" />
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">Submit</x-form.button>

</x-form.form>
