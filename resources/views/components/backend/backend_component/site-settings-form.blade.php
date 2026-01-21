{{-- resources/views/components/backend/backend_component/site-settings-form.blade.php --}}

<x-form.form
    :route="route('update.site.setting', $sitesetting->id)"
    method="PATCH"
    class="forms-sample needs-validation"
    novalidate
    enctype="multipart/form-data"
>

    {{-- Logo & Favicon --}}
    <div class="row mb-3">
        {{-- Logo --}}
        <div class="col-sm-6">
            <div class="row">
                @php
                    $logo = $sitesetting->logo ?? '';
                    $logoCol = $logo ? 10 : 12;
                @endphp
                <div class="col-sm-{{ $logoCol }}">
                    <x-form.input-label for="logo" value="Logo" />
                    <x-form.file-input name="logo" onchange="mainThamUrl(this,'logo')" />
                    <x-form.input-error :messages="$errors->get('logo')" class="pt-3" />
                    <img src="" id="mainThmblogo" class="img-responsive border border-1 mt-3">
                </div>
                @if ($logo)
                    <div class="mt-3 col-sm-2">
                        <img src="{{ asset($logo) }}" class="img-thumbnail img-fluid w-10">
                    </div>
                @endif
            </div>
        </div>

        {{-- Favicon --}}
        <div class="col-sm-6">
            <div class="row">
                @php
                    $favicon = $sitesetting->favicon ?? '';
                    $faviconCol = $favicon ? 10 : 12;
                @endphp
                <div class="col-sm-{{ $faviconCol }}">
                    <x-form.input-label for="favicon" value="Favicon" />
                    <x-form.file-input name="favicon" onchange="mainThamUrl(this,'favicon')" />
                    <x-form.input-error :messages="$errors->get('favicon')" class="pt-3" />
                    <img src="" id="mainThmbfavicon" class="img-responsive border border-1 mt-3">
                </div>
                @if ($favicon)
                    <div class="mt-3 col-sm-2">
                        <img src="{{ asset($favicon) }}" class="img-thumbnail img-fluid w-10">
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Basic Info --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <x-form.input-label for="site_title" value="Site Title" />
            <x-form.text-input name="site_title" :value="$sitesetting->site_title" placeholder="Site Title" required />
            <x-form.input-error :messages="$errors->get('site_title')" />
        </div>
        <div class="col-sm-6">
            <x-form.input-label for="app_name" value="App Name" />
            <x-form.text-input name="app_name" :value="$sitesetting->app_name" placeholder="App Name" required />
            <x-form.input-error :messages="$errors->get('app_name')" />
        </div>
    </div>

    {{-- Contact Info --}}
    <div class="row mb-3">
        <div class="col-sm-4">
            <x-form.input-label for="email" value="Email" />
            <x-form.text-input name="email" :value="$sitesetting->email" placeholder="Email" />
        </div>
        <div class="col-sm-4">
            <x-form.input-label for="support_phone" value="Support Phone" />
            <x-form.text-input name="support_phone" :value="$sitesetting->support_phone" placeholder="Support Phone" />
        </div>
        <div class="col-sm-4">
            <x-form.input-label for="tax" value="Tax (%)" />
            <x-form.text-input type="number" name="tax" :value="$sitesetting->tax" max="50" placeholder="Tax" />
        </div>
    </div>

    {{-- Address & GST --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <x-form.input-label for="gst" value="GST" />
            <x-form.textarea name="gst" rows="2" placeholder="GST">{{ $sitesetting->gst ?? '' }}</x-form.textarea>
        </div>
        <div class="col-sm-6">
            <x-form.input-label for="address" value="Address" />
            <x-form.textarea name="address" rows="2" placeholder="Address">{{ $sitesetting->address ?? '' }}</x-form.textarea>
        </div>
    </div>

    {{-- Bank Details --}}
    <div class="row mb-3">
        <div class="col-4">
            <x-form.input-label for="bank_name" value="Bank Name" />
            <x-form.text-input name="bank_name" :value="$sitesetting->bank_name" required placeholder="Bank Name" />
        </div>
        <div class="col-4">
            <x-form.input-label for="bank_holder_name" value="Bank Holder Name" />
            <x-form.text-input name="bank_holder_name" :value="$sitesetting->bank_holder_name" required placeholder="Bank Holder Name" />
        </div>
        <div class="col-4">
            <x-form.input-label for="bank_account" value="Bank Account" />
            <x-form.text-input name="bank_account" :value="$sitesetting->bank_account" required placeholder="Bank Account" />
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-4">
            <x-form.input-label for="bank_branch" value="Bank Branch" />
            <x-form.text-input name="bank_branch" :value="$sitesetting->bank_branch" required placeholder="Bank Branch" />
        </div>
        <div class="col-4">
            <x-form.input-label for="bank_ifsc" value="Bank IFSC Code" />
            <x-form.text-input name="bank_ifsc" :value="$sitesetting->bank_ifsc" required placeholder="Bank IFSC Code" />
            <x-form.input-error :messages="$errors->get('bank_ifsc')" />
        </div>
        <div class="col-4">
            <x-form.input-label for="pan_no" value="PAN No" />
            <x-form.text-input name="pan_no" :value="$sitesetting->pan_no" required placeholder="PAN No" />
            <x-form.input-error :messages="$errors->get('pan_no')" />
        </div>
    </div>

    {{-- Declaration & Message --}}
    <div class="row mb-3">
        <div class="col-12">
            <x-form.input-label for="declaration" value="Declaration" />
            <x-form.textarea name="declaration"  rows="2" placeholder="Declaration">{{ $sitesetting->declaration ?? '' }}</x-form.textarea>
            <x-form.input-error :messages="$errors->get('declaration')" />
        </div>
        <div class="col-12">
            <x-form.input-label for="message" value="Message" />
            <x-form.text-input name="message" :value="$sitesetting->message" required placeholder="Message" />
            <x-form.input-error :messages="$errors->get('message')" />
        </div>
    </div>

    {{-- Bank QR Code --}}
    <div class="row mb-4">
        <div class="col-sm-12">
            <div class="row">
                @php
                    $qrCode = $sitesetting->bank_qr_code ?? '';
                    $qrCol = $qrCode ? 10 : 12;
                @endphp
                <div class="col-sm-{{ $qrCol }}">
                    <x-form.input-label for="bank_qr_code" value="Bank QR Code" />
                    <x-form.file-input name="bank_qr_code" onchange="mainThamUrl(this,'qr')" />
                    <x-form.input-error :messages="$errors->get('bank_qr_code')" />
                    <img src="" id="mainThmbqr" class="img-responsive border border-1 mt-3">
                </div>
                @if ($qrCode)
                    <div class="mt-3 col-sm-2">
                        <img src="{{ asset($qrCode) }}" class="img-thumbnail img-fluid w-10">
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <x-form.button>Submit</x-form.button>

</x-form.form>
