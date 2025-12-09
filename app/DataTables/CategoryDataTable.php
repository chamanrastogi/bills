<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
         ->setRowClass(function ($row) {
                return 'category-' . $row->id;
            })
            ->addColumn('action', 'category.action')
            ->addColumn('created_at', function ($row) {
                return date('d-m-Y H:i:s A', strtotime($row->created_at));
            })
            ->addColumn('updated_at', function ($row) {
                return date('d-m-Y H:i:s A', strtotime($row->updated_at));
            })
            ->addColumn('status', function ($row) {
                $name = 'category';
                $badge = $row->status == 1 ? 'danger' : 'success';
                $status = $row->status == 0 ? 'Active' : 'Deactive';

                return '<button type="button"
                            onClick="statusFunction(' . $row->id . ', \'' . $name . '\')"
                            class="shadow-none badge badge-light-' . $badge . ' warning changestatus' . $row->id . ' bs-tooltip"
                            data-toggle="tooltip" data-placement="top" title="Status"
                            data-original-title="Status">' . $status . '</button>';
            })
            // Action column (edit + delete only)
            ->addColumn('action', function ($row) {
                $name = 'category';
                $edit = route('category.edit', $row->id);

                return
                    '<a href="' . $edit . '"
                        class="action-btn btn-edit bs-tooltip me-2"
                        data-toggle="tooltip" data-placement="top" title="Edit"
                        data-bs-original-title="Edit">
                        <i data-feather="edit"></i>
                    </a>'
                    . ' <a href="javascript:void(0)"
                        onClick="deleteFunction(' . $row->id . ', \'' . $name . '\')"
                        class="action-btn btn-edit bs-tooltip me-2 delete' . $row->id . '"
                        data-toggle="tooltip" data-placement="top" title="Delete"
                        data-bs-original-title="Delete">
                        <i data-feather="trash-2"></i>
                    </a>';
            })
            ->rawColumns(['action', 'created_at', 'updated_at', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('supplier-table')
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
                "<'dt--top-section'<'row' " .
                    "<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'lB>" .
                    "<'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>" .
                    '>>' .

                    // Table
                    "<'table-responsive' tr>" .

                    // Bottom section
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center' " .
                    "<'dt--pages-count mb-sm-0 mb-3'i>" .
                    "<'dt--pagination'p>" .
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
            Column::make('name')->title('Category Name'),
            Column::computed('status'),
            Column::computed('created_at'),
            Column::computed('updated_at'),
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
        return 'Category_' . date('YmdHis');
    }
}
