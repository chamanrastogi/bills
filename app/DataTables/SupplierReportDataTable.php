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

class SupplierReportDataTable extends DataTable
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
            ->editColumn('total_weight', function ($item) {
                return number_format($item->total_weight, 3);
            })
            // ->editColumn('line_total', function ($item) {
            //     return number_format($item->line_total, 2);
            // })
            ->setRowId('id');
    }

    public function ajax(): JsonResponse
    {
        return datatables($this->query())
            ->editColumn('bill_date', function ($item) {
                return Carbon::parse($item->bill_date)->format('d-m-Y');
            })
            ->editColumn('total_weight', function ($item) {
                return number_format($item->total_weight, 3);
            })
            ->setRowId('id')
            ->with('unitWiseTotal', $this->unitWiseTotal())
            ->with('categoryPurityWiseTotal', $this->categoryPurityWiseTotal())
            ->toJson();
    }

    public function unitWiseTotal(): array
    {
        $query = DB::table('supplier_billing_items as items')
            ->join('supplier_billings as bills', 'bills.id', '=', 'items.supplier_billing_id')
            ->leftJoin('units', 'units.id', '=', 'items.unit_id')
            ->selectRaw('units.name as unit, SUM(items.total_weight) as total_weight')
            ->groupBy('items.unit_id', 'units.name');

        // Apply SAME filters
        if (request()->filled('supplier_id')) {
            $query->where('bills.supplier_id', request('supplier_id'));
        }

        if (request()->filled('category_id')) {
            $query->where('items.category_id', request('category_id'));
        }

        if (request()->filled('purity_id')) {
            $query->where('items.purity_id', request('purity_id'));
        }

        if (request()->filled('unit_id')) {
            $query->where('items.unit_id', request('unit_id'));
        }

        if (request()->filled('from_date')) {
            $query->whereDate('bills.created_at', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('bills.created_at', '<=', request('to_date'));
        }

        return $query->get()->toArray();
    }

    public function categoryPurityWiseTotal(): array
    {
        $query = DB::table('supplier_billing_items as items')
            ->join('supplier_billings as bills', 'bills.id', '=', 'items.supplier_billing_id')
            ->leftJoin('categories', 'categories.id', '=', 'items.category_id')
            ->leftJoin('purities', 'purities.id', '=', 'items.purity_id')
            ->selectRaw('categories.name as category, purities.name as purity, SUM(items.total_weight) as total_weight')
            ->groupBy('items.category_id', 'categories.name', 'items.purity_id', 'purities.name');

        // Apply SAME filters
        if (request()->filled('supplier_id')) {
            $query->where('bills.supplier_id', request('supplier_id'));
        }

        if (request()->filled('category_id')) {
            $query->where('items.category_id', request('category_id'));
        }

        if (request()->filled('purity_id')) {
            $query->where('items.purity_id', request('purity_id'));
        }

        if (request()->filled('unit_id')) {
            $query->where('items.unit_id', request('unit_id'));
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
        $query = DB::table('supplier_billing_items as items')
            ->join('supplier_billings as bills', 'bills.id', '=', 'items.supplier_billing_id')
            ->leftJoin('suppliers', 'suppliers.id', '=', 'bills.supplier_id')
            ->leftJoin('categories', 'categories.id', '=', 'items.category_id')
            ->leftJoin('purities', 'purities.id', '=', 'items.purity_id')
            ->leftJoin('units', 'units.id', '=', 'items.unit_id')
            ->select([
                'items.id',
                'bills.created_at as bill_date',
                'suppliers.shop_name as supplier_name',
                'categories.name as category_name',
                'purities.name as purity',
                'units.name as unit',
                'items.total_weight',
                //  'items.line_total',
            ]);

        // Apply filters
        if (request()->filled('supplier_id')) {
            $query->where('bills.supplier_id', request('supplier_id'));
        }

        if (request()->filled('category_id')) {
            $query->where('items.category_id', request('category_id'));
        }

        if (request()->filled('purity_id')) {
            $query->where('items.purity_id', request('purity_id'));
        }

        if (request()->filled('unit_id')) {
            $query->where('items.unit_id', request('unit_id'));
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
            ->setTableId('supplier-report-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => url()->current(),
                'data' => 'function(d) {
                    d.supplier_id = $("#suppliers").val();
                    d.category_id = $("#categories").val();
                    d.purity_id = $("#purity_id").val();
                    d.unit_id = $("#unit_id").val();
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
            Column::make('supplier_name')->title('Supplier')->searchable(true)->orderable(true),
            Column::make('category_name')->title('Category')->searchable(true)->orderable(true),
            Column::make('purity')->title('Purity')->searchable(true)->orderable(true),

            Column::make('total_weight')->title('Total Weight')->searchable(false)->orderable(true),
            Column::make('unit')->title('Unit')->searchable(true)->orderable(true),
            //  Column::make('line_total')->title('Line Total')->searchable(false)->orderable(true),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Supplier_Report_'.date('YmdHis');
    }
}
