<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->setRowClass(function ($row) {
                return 'product-'.$row->id;
            })
            ->addColumn('type_name', function ($row) {
                $name = $row->type->name ?? 'N/A';

                $badge = ($row->type->category && strtolower($row->type->category->name) == 'gold')
                   ? 'warning'
                   : 'light-secondary';

                return '<span class="shadow-none badge badge-'.$badge.'">'.$name.'</span>';
            })
            ->addColumn('stock_qty', function ($row) {
               // $raw = $row->stock_qty ?? 'N/A';
                  return '<span class="badge badge-info">'.$row->stock_qty.'</span>';
            })
            ->addColumn('purity_name', function ($row) {
                $raw = $row->purity->name ?? 'N/A';

                $name = explode(' -', $raw)[0];

                $badge = ($row->purity->category && strtolower($row->purity->category->name) == 'gold')
                    ? 'warning'
                    : 'light-secondary';

                return '<span class="badge badge-'.$badge.'">'.$name.'</span>';
            })

            // Separate status column
            ->addColumn('status', function ($row) {
                $name = 'product';
                $badge = $row->status == 1 ? 'danger' : 'success';
                $status = $row->status == 0 ? 'Active' : 'Deactive';

                return '<button type="button"
                            onClick="statusFunction('.$row->id.', \''.$name.'\')"
                            class="shadow-none badge badge-light-'.$badge.' warning changestatus'.$row->id.' bs-tooltip"
                            data-toggle="tooltip" data-placement="top" title="Status"
                            data-original-title="Status">'.$status.'</button>';
            })
            ->addColumn('details', function ($row) {
                return '
        <div class="product-details">

            <strong class="text-info fw-bold">Gross:</strong> '.$row->gross_weight.' | Net: '.$row->net_weight.'<br>
            <strong class="text-success fw-bold">Price:</strong> '.MONEY.$row->price.'<br>
            <strong class="text-warning fw-bold">Created At:</strong> '.$row->created_at->format('d-M-Y').'<br>
            <strong class="text-danger fw-bold">Updated At:</strong> '.$row->updated_at->format('d-M-Y').'
        </div>
    ';
            })
            // Action column (edit + delete only)
            ->addColumn('action', function ($row) {
                $name = 'product';
                $edit = route('products.edit', $row->id);

                return
                    '<a href="'.$edit.'"
                        class="action-btn btn-edit bs-tooltip me-2"
                        data-toggle="tooltip" data-placement="top" title="Edit"
                        data-bs-original-title="Edit">
                        <i data-feather="edit"></i>
                    </a>'
                    .' <a href="javascript:void(0)"
                        onClick="deleteFunction('.$row->id.', \''.$name.'\')"
                        class="action-btn btn-edit bs-tooltip me-2 delete'.$row->id.'"
                        data-toggle="tooltip" data-placement="top" title="Delete"
                        data-bs-original-title="Delete">
                        <i data-feather="trash-2"></i>
                    </a>';
            })
            ->rawColumns(['status', 'action', 'stock_qty', 'details', 'purity_name', 'type_name']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()->with('supplier:id,name')->with('type:id,name,category_id')->with('purity:id,name,category_id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('id'),
            Column::computed('type_name')->title('Type')->searchable(true),
            Column::computed('purity_name')->title('Purity')->searchable(true),
            Column::computed('stock_qty')->title('Qty')->searchable(true),
            Column::make('name')->title('Name')->searchable(true),
            Column::computed('details')->title('Product Details')->orderable(false)->searchable(false),
            Column::computed('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_'.date('YmdHis');
    }
}
