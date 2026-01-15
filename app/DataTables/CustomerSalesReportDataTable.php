<?php

namespace App\DataTables;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Query\Builder as DBBuilder;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\QueryDataTable;
use Yajra\DataTables\Services\DataTable;

class CustomerSalesReportDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  DBBuilder  $query  Results from query() method.
     */
    public function dataTable(DBBuilder $query): QueryDataTable
    {
        return (new QueryDataTable($query))
            ->editColumn('bill_date', function ($item) {
                return Carbon::parse($item->bill_date)->format('d-m-Y');
            })
            ->editColumn('quantity', function ($item) {
                return number_format($item->quantity, 2);
            })
            ->editColumn('total_amount', function ($item) {
                return number_format($item->total_amount, 2);
            })
            ->setRowId('id');
    }

    public function ajax(): JsonResponse
    {
        return datatables($this->query())
            ->editColumn('bill_date', function ($item) {
                return Carbon::parse($item->bill_date)->format('d-m-Y');
            })
            ->editColumn('quantity', function ($item) {
                return number_format($item->quantity, 2);
            })
            ->editColumn('total_amount', function ($item) {
                return number_format($item->total_amount, 2);
            })
            ->setRowId('id')
            ->with('customerWiseTotal', $this->customerWiseTotal())
            ->with('categoryTypeProductPurityWiseTotal', $this->categoryTypeProductPurityWiseTotal())
            ->toJson();
    }

    public function customerWiseTotal(): array
    {
        $query = DB::table('billing_items as items')
            ->join('billing as bills', 'bills.id', '=', 'items.billing_id')
            ->join('customers', 'customers.id', '=', 'bills.customer_id')
            ->leftJoin('products', 'products.id', '=', 'items.product_id')
            ->leftJoin('types', 'types.id', '=', 'products.type_id')
            ->selectRaw('customers.name as customer, SUM(items.total_amount) as total_amount')
            ->groupBy('bills.customer_id', 'customers.name');

        // Apply SAME filters
        if (request()->filled('customer_id')) {
            $query->where('bills.customer_id', request('customer_id'));
        }

        if (request()->filled('category_id')) {
            $query->where('types.category_id', request('category_id'));
        }

        if (request()->filled('type_id')) {
            $query->where('products.type_id', request('type_id'));
        }

        if (request()->filled('product_id')) {
            $query->where('items.product_id', request('product_id'));
        }

        if (request()->filled('purity_id')) {
            $query->where('products.purity_id', request('purity_id'));
        }

        if (request()->filled('from_date')) {
            $query->whereDate('bills.created_at', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('bills.created_at', '<=', request('to_date'));
        }

        return $query->get()->toArray();
    }

    public function categoryTypeProductPurityWiseTotal(): array
    {
        $query = DB::table('billing_items as items')
            ->join('billing as bills', 'bills.id', '=', 'items.billing_id')
            ->leftJoin('products', 'products.id', '=', 'items.product_id')
            ->leftJoin('types', 'types.id', '=', 'products.type_id')
            ->leftJoin('categories', 'categories.id', '=', 'types.category_id')
            ->leftJoin('purities', 'purities.id', '=', 'products.purity_id')
            ->selectRaw('categories.name as category, types.name as type, products.name as product, purities.name as purity, SUM(items.total_amount) as total_amount')
            ->groupBy('types.category_id', 'categories.name', 'products.type_id', 'types.name', 'items.product_id', 'products.name', 'products.purity_id', 'purities.name');

        // Apply SAME filters
        if (request()->filled('customer_id')) {
            $query->where('bills.customer_id', request('customer_id'));
        }

        if (request()->filled('category_id')) {
            $query->where('types.category_id', request('category_id'));
        }

        if (request()->filled('type_id')) {
            $query->where('products.type_id', request('type_id'));
        }

        if (request()->filled('product_id')) {
            $query->where('items.product_id', request('product_id'));
        }

        if (request()->filled('purity_id')) {
            $query->where('products.purity_id', request('purity_id'));
        }

        if (request()->filled('from_date')) {
            $query->whereDate('bills.created_at', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('bills.created_at', '<=', request('to_date'));
        }

        return $query->get()->toArray();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): DBBuilder
    {
        $query = DB::table('billing_items as items')
            ->join('billing as bills', 'bills.id', '=', 'items.billing_id')
            ->leftJoin('customers', 'customers.id', '=', 'bills.customer_id')
            ->leftJoin('products', 'products.id', '=', 'items.product_id')
            ->leftJoin('types', 'types.id', '=', 'products.type_id')
            ->leftJoin('categories', 'categories.id', '=', 'types.category_id')
            ->leftJoin('purities', 'purities.id', '=', 'products.purity_id')
            ->select([
                'items.id',
                'bills.created_at as bill_date',
                'customers.name as customer_name',
                'categories.name as category_name',
                'types.name as type_name',
                'products.name as product_name',
                'purities.name as purity_name',
                'items.quantity',
                'items.total_amount',
            ]);

        // Apply filters
        if (request()->filled('customer_id')) {
            $query->where('bills.customer_id', request('customer_id'));
        }

        if (request()->filled('category_id')) {
            $query->where('types.category_id', request('category_id'));
        }

        if (request()->filled('type_id')) {
            $query->where('products.type_id', request('type_id'));
        }

        if (request()->filled('product_id')) {
            $query->where('items.product_id', request('product_id'));
        }

        if (request()->filled('purity_id')) {
            $query->where('products.purity_id', request('purity_id'));
        }

        if (request()->filled('from_date')) {
            $query->whereDate('bills.created_at', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('bills.created_at', '<=', request('to_date'));
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customer-sales-report-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => url()->current(),
                'data' => 'function(d) {
                    d.customer_id = $("#customers").val();
                    d.category_id = $("#categories").val();
                    d.type_id = $("#type_id").val();
                    d.product_id = $("#product_id").val();
                    d.purity_id = $("#purity_id").val();
                    d.from_date = $("#from_date").val();
                    d.to_date = $("#to_date").val();
                }',
            ])
            ->orderBy(0)
            ->parameters([
                'processing' => true,
                'serverSide' => true,
                'pageLength' => 25,
                'lengthMenu' => [10, 25, 50, 100],
                'drawCallback' => 'function() { feather.replace(); }',

                // Custom DOM layout
                'dom' =>
                // Top section
                "<'dt--top-section'<'row' ".
                    "<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'lB>".
                    "<'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>".
                    '>>'.

                    // Table
                    "<'table-responsive' tr>".

                    // Bottom section
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center' ".
                    "<'dt--pages-count mb-sm-0 mb-3'i>".
                    "<'dt--pagination'p>".
                    '>',

                // Export Buttons
                'buttons' => [
                    [
                        'extend' => 'copy',
                        'className' => 'btn btn-sm btn-light',
                    ],
                    [
                        'extend' => 'csv',
                        'className' => 'btn btn-sm btn-light',
                    ],
                    [
                        'extend' => 'excel',
                        'className' => 'btn btn-sm btn-light',
                    ],
                    [
                        'extend' => 'print',
                        'className' => 'btn btn-sm btn-light',
                    ],
                ],

                // Custom language options
                'oLanguage' => [
                    'oPaginate' => [
                        'sPrevious' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-arrow-left">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>',
                        'sNext' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>',
                    ],
                    'sInfo' => 'Showing page _PAGE_ of _PAGES_',
                    'sSearch' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>',
                    'sSearchPlaceholder' => 'Search...',
                    'sLengthMenu' => 'Results : _MENU_',
                ],
                'pageLength' => 10,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('bill_date')->title('Bill Date')->searchable(true)->orderable(true),
            Column::make('customer_name')->title('Customer')->searchable(true)->orderable(true),
            Column::make('category_name')->title('Category')->searchable(true)->orderable(true),
            Column::make('type_name')->title('Type')->searchable(true)->orderable(true),
            Column::make('product_name')->title('Product')->searchable(true)->orderable(true),
            Column::make('purity_name')->title('Purity')->searchable(true)->orderable(true),
            Column::make('quantity')->title('Quantity')->searchable(false)->orderable(true),
            Column::make('total_amount')->title('Total Amount')->searchable(false)->orderable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Customer_Sales_Report_'.date('YmdHis');
    }
}
