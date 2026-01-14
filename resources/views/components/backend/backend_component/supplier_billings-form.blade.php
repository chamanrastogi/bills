{{-- resources/views/components/backend/backend_component/supplier_billings-form.blade.php --}}

<x-form.form :route="$isEdit ? route('supplier_billings.update', $billing->id) : route('supplier_billings.store')" :isEdit="$isEdit" enctype="multipart/form-data" class="forms-sample needs-validation"
    novalidate>

    {{-- Supplier ID --}}
    <div class="mb-3">
        <x-form.input-label for="supplier_id" value="Supplier" />
        <x-form.select name="supplier_id" id="suppliers_name" :options="$supplier" :selected="$billing->supplier_id ?? ''"
            placeholder="Select Supplier" />
        <x-form.input-error :messages="$errors->get('supplier_id')" />
    </div>

    {{-- Bill Image Upload --}}
    @php
        $small_img = !empty($billing->bill_image ?? null)
            ? explode('.', $billing->bill_image)[0] . '_thumb.' . explode('.', $billing->bill_image)[1]
            : '/upload/no_image.jpg';
    @endphp

    <div class="row">
        <div class="col-sm-10">
            <x-form.input-label for="bill_image" value="Bill Image" />
            <x-form.file-input name="bill_image" onchange="mainThamUrl(this)" />
            <x-form.input-error :messages="$errors->get('bill_image')" class="mt-2" />
            <img src="" class="img-thumbnail img-fluid w-10 my-3" id="mainThmb" />
        </div>

        <div class="col-sm-2 mt-3">
            <img src="{{ asset($small_img) }}" class="img-thumbnail img-fluid w-10" />
        </div>
    </div>

    {{-- Jewelry Products for this Purchase Order --}}
    <div class="mt-4">
        <h6 class="fw-bold mb-3"> Add Jewelry Products </h6>

        <div class="table-responsive">
            <table class="table table-bordered" id="supplier-items-table">
                <thead class="thead-light">
                    <tr>
                        <th>Category Type</th>
                        <th>Purity</th>
                        <th>Total Weight</th>
                        <th>Unit</th>
                        <th>Line Total</th>
                        <th style="width: 80px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($isEdit && $billing->items)
                        @foreach($billing->items as $index => $item)
                            <tr>
                                <td>
                                    <select class="form-control" name="items[{{ $index }}][category_id]">
                                        <option value="">Select Category Type</option>
                                        @foreach ($categories ?? [] as $id => $name)
                                            <option value="{{ $id }}" {{ $item->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="items[{{ $index }}][purity_id]" required>
                                        <option value="">Select Purity</option>
                                        @foreach ($purities ?? [] as $id => $name)
                                            <option value="{{ $id }}" {{ $item->purity_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" step="0.001" min="0" class="form-control item-weight"
                                        name="items[{{ $index }}][total_weight]" value="{{ $item->total_weight }}">
                                </td>
                                <td>
                                    <select class="form-control" name="items[{{ $index }}][unit_id]">
                                        <option value="">Select Unit</option>
                                        @foreach ($units ?? [] as $id => $name)
                                            <option value="{{ $id }}" {{ $item->unit_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" class="item-total" name="items[{{ $index }}][line_total]" value="{{ $item->line_total }}">
                                    <span class="item-total-display">{{ number_format($item->line_total, 2) }}</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-item-row">X</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    {{-- Rows will be injected via JS --}}
                </tbody>
            </table>
        </div>

        <button type="button" class="btn btn-sm btn-outline-primary" id="add-supplier-item-row">
            + Add Product Line
        </button>

        <x-form.input-error :messages="$errors->get('items')" class="mt-2" />
        <x-form.input-error :messages="$errors->get('items.*.category_id')" class="mt-1" />
        <x-form.input-error :messages="$errors->get('items.*.purity_id')" class="mt-1" />
        <x-form.input-error :messages="$errors->get('items.*.total_weight')" class="mt-1" />
        <x-form.input-error :messages="$errors->get('items.*.unit_id')" class="mt-1" />
    </div>

    {{-- Summary / Payment --}}
    <div class="row mt-4">
        <div class="col-6">
            {{-- Bill Amount (auto-calculated) --}}
            <div class="mb-3">
                <x-form.input-label for="bill_amount" value="Total weight" />
                <x-form.text-input type="number" name="bill_amount" :value="0" readonly
                    class="bg-light" />

                <x-form.input-error :messages="$errors->get('bill_amount')" class="mt-2" />
            </div>
        </div>
        <div class="col-6">
            {{-- Paid Amount --}}
            <div class="mb-3">
                <x-form.input-label for="bill_amount_final" value="Bill Amount" />
                <x-form.text-input type="number" name="bill_amount_final" :value="$billing->bill_amount ?? 0" placeholder="Enter Bill Amount" />
                <x-form.input-error :messages="$errors->get('bill_amount_final')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            {{-- Payment Mode --}}
            <div class="mb-3">
                <x-form.input-label for="payment_mode" value="Payment Mode" />

                <x-form.select name="payment_mode" :options="MODE" :selected="$billing->payment_mode ?? 0"
                    placeholder="Select Payment Mode" />

                <x-form.input-error :messages="$errors->get('payment_mode')" class="mt-2" />
            </div>
        </div>
        <div class="col-6">
            {{-- Transaction ID --}}
            <div class="mb-3">
                <x-form.input-label for="transaction_id" value="Transaction ID" />
                <x-form.text-input name="transaction_id" :value="$billing->transaction_id ?? ''"
                    placeholder="Enter Transaction ID" />
                <x-form.input-error :messages="$errors->get('transaction_id')" class="mt-2" />
            </div>
        </div>
    </div>

    {{-- Submit Button --}}
    <x-form.button type="submit">
        {{ $isEdit ? 'Update' : 'Submit' }}
    </x-form.button>

    {{-- Template for dynamic rows --}}
    <template id="supplier-item-row-template">
        <tr>
            <td>
                <select class="form-control" data-name-template="items[__INDEX__][category_id]">
                    <option value="">Select Category Type</option>
                    @foreach ($categories ?? [] as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select class="form-control" data-name-template="items[__INDEX__][purity_id]" required>
                    <option value="">Select Purity</option>
                    @foreach ($purities ?? [] as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" step="0.001" min="0" class="form-control item-weight"
                    data-name-template="items[__INDEX__][total_weight]" placeholder="Weight">
            </td>
            <td>
               <select class="form-control" data-name-template="items[__INDEX__][unit_id]" required>
                    <option value="">Select Unit</option>
                    @foreach ($units ?? [] as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="hidden" class="item-total" data-name-template="items[__INDEX__][line_total]" value="0">
                <span class="item-total-display">0.00</span>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger remove-item-row">X</button>
            </td>
        </tr>
    </template>

</x-form.form>

