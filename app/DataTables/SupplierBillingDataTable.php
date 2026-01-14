<?php

namespace App\DataTables;

use App\Models\SupplierBilling;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SupplierBillingDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowClass(fn ($row) => Str::snake(class_basename($row)).'-'.$row->id
            )

            /* =========================
               BILL IMAGE
               ========================= */
            ->addColumn('bill_image', function ($row) {

                $hasImage = ! empty($row->bill_image);
                $image = $hasImage
                    ? asset($row->bill_image)
                    : asset('upload/no_image.jpg');

                $downloadBtn = $hasImage
                    ? '<a href="'.$image.'" download class="action-btn me-2">
                        <i data-feather="download-cloud"></i>
                       </a>'
                    : '';

                return '
                    <div class="text-center">
                        <img src="'.$image.'" class="img-thumbnail"
                             style="max-width:80px;max-height:80px;">
                        '.$downloadBtn.'
                    </div>
                ';
            })

            /* =========================
               SUPPLIER NAME
               ========================= */
            ->addColumn('supplier_name', function ($row) {

                $name = $row->supplier?->shop_name ?? 'IN HOUSE';
                $badge = $row->supplier ? 'info' : 'secondary';

                return '<span class="badge badge-'.$badge.'">'.$name.'</span>';
            })

            /* =========================
               BILL + ITEM DETAILS
               ========================= */
            ->addColumn('details', function ($row) {

                // -------- Billing status --------

                $bill_amount = (float) $row->bill_amount;

                $paymentMode = MODE[$row->payment_mode] ?? 'N/A';

                // -------- Item details --------
                $itemsHtml = '';

                if ($row->items->count()) {
                    foreach ($row->items as $item) {
                        $itemsHtml .= '
                            <li>
                                <strong>'.$item->category?->name.'</strong>
                                - ['.$item->purity?->name.']
                            </li>';
                    }
                } else {
                    $itemsHtml = '<li class="text-muted">No items</li>';
                }

                return '
                    <div class="product-details">
                        <strong class="text-info">Payment Mode:</strong> '.$paymentMode.'<br>

                        <strong class="text-secondary">Bill Amount:</strong> '.MONEY.$bill_amount.'<br>

                        <hr class="my-1">
                        <strong class="text-primary">Items:</strong>
                        <ul class="mb-0 ps-3">'.$itemsHtml.'</ul>
                        <hr class="my-1">
                        <small class="text-warning">Created:</small> '.$row->created_at->format('d-M-Y').' |
                        <small class="text-danger">Updated:</small> '.$row->updated_at->format('d-M-Y').'
                    </div>
                ';
            })

              /* =========================
               SUPPLIER SEARCH (FIX)
               ========================= */
            ->filterColumn('supplier_name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('suppliers.shop_name', 'LIKE', "%{$keyword}%")
                        ->orWhereNull('supplier_billings.supplier_id'); // IN HOUSE
                });
            })

            /* =========================
               ACTIONS
               ========================= */
            ->addColumn('action', function ($row) {

                $name = Str::snake(class_basename($row));
                $edit = route('supplier_billings.edit', $row->id);

                return '
                    <a href="'.$edit.'" class="action-btn me-2">
                        <i data-feather="edit"></i>
                    </a>
                    <a href="javascript:void(0)"
                       onClick="deleteFunction('.$row->id.', \''.$name.'\')"
                       class="action-btn">
                        <i data-feather="trash-2"></i>
                    </a>
                ';
            })

            ->rawColumns([
                'bill_image',
                'supplier_name',
                'details',
                'action',
            ]);
    }

    /**
     * Query source
     */
    public function query(SupplierBilling $model): QueryBuilder
    {
        return $model->newQuery()
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_billings.supplier_id')
            ->select('supplier_billings.*')
            ->with([
                'supplier:id,shop_name',
                'items.category:id,name',
                'items.purity:id,name',
                'items.unit:id,name',
            ]);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('supplier-billing-table')
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

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('bill_image')
                ->title('Bill Image')
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-center'),

            Column::computed('supplier_name')->title('Supplier')->searchable(true),
            Column::computed('details')->title('Bill & Items Details'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'SupplierBilling_'.date('YmdHis');
    }
}
