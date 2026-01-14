<x-form.form
    id="supplier-report-form"
    :route="route('reports.supplier-billing-items')"
    method="GET"
    class="forms-sample needs-validation"
>
    <div class="row">
        {{-- Supplier --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="supplier_id" value="Supplier" />
            <x-form.select
                name="supplier_id"
                id="suppliers"
                :options="$suppliers"
                :selected="request('supplier_id')"
                placeholder="All Suppliers"
            />
            <x-form.input-error :messages="$errors->get('supplier_id')" />
        </div>

         {{-- Category Type --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="category" value="Category" />
            <x-form.select
                name="category_id"
                id="categories"
                :options="$categories"
                :selected="request('category_id')"
                placeholder="All Category"
            />
            <x-form.input-error :messages="$errors->get('category_id')" />
        </div>


        {{-- Purity --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="purity_id" value="Purity" />
            <x-form.select
                name="purity_id"
                id="purity_id"
                :options="$purities"
                :selected="request('purity_id')"
                placeholder="All Purities"
            />
            <x-form.input-error :messages="$errors->get('purity_id')" />
        </div>

        {{-- Unit --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="unit_id" value="Unit" />
            <x-form.select
                name="unit_id"
                id="unit_id"
                :options="$units"
                :selected="request('unit_id')"
                placeholder="All Units"
            />
            <x-form.input-error :messages="$errors->get('unit_id')" />
        </div>



        <div class="col-md-3 mb-3">
            <x-form.input-label for="from_date" value="From Date" />
            <x-form.text-input
                type="date"
                name="from_date"
                id="from_date"
                :value="request('from_date')"
            />
        </div>

        <div class="col-md-3 mb-3">
            <x-form.input-label for="to_date" value="To Date" />
            <x-form.text-input
                type="date"
                name="to_date"
                id="to_date"
                :value="request('to_date')"
            />
        </div>

    </div>

    {{-- Submit --}}
    <x-form.button type="submit">
        Generate Report
    </x-form.button>

</x-form.form>


