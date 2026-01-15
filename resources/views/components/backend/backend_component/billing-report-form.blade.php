<x-form.form
    id="billing-report-form"
    :route="route('reports.customer-sales')"
    method="GET"
    class="forms-sample needs-validation"
>
    <div class="row">
        {{-- Customer --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="customer_id" value="Customer" />
            <x-form.select
                name="customer_id"
                id="customers"
                :options="$customers"
                :selected="request('customer_id')"
                placeholder="All Customers"
            />
            <x-form.input-error :messages="$errors->get('customer_id')" />
        </div>

         {{-- Category --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="category_id" value="Category" />
            <x-form.select
                name="category_id"
                id="categories"
                :options="$categories"
                :selected="request('category_id')"
                placeholder="All Categories"
            />
            <x-form.input-error :messages="$errors->get('category_id')" />
        </div>

        {{-- Type --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="type_id" value="Type" />
            <x-form.select
                name="type_id"
                id="type_id"
                :options="$types"
                :selected="request('type_id')"
                placeholder="All Types"
            />
            <x-form.input-error :messages="$errors->get('type_id')" />
        </div>

        {{-- Product --}}
        <div class="col-md-3 mb-3">
            <x-form.input-label for="product_id" value="Product" />
            <x-form.select
                name="product_id"
                id="product_id"
                :options="$products"
                :selected="request('product_id')"
                placeholder="All Products"
            />
            <x-form.input-error :messages="$errors->get('product_id')" />
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

