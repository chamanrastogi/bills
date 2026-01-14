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
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowClass(fn ($row) => 'product-'.$row->id)

            /* =========================
               TYPE COLUMN
               ========================= */
            ->addColumn('type_name', function ($row) {

                $typeName = $row->type->name ?? 'N/A';
                $typeCategory = strtolower($row->type?->category?->name ?? '');
                $purityCategory = strtolower($row->purity?->category?->name ?? '');

                $isValid = $typeCategory && $purityCategory && $typeCategory === $purityCategory;

                if (! $typeCategory) {
                    $badge = 'secondary';
                    $title = 'Type category not defined';
                } elseif (! $isValid) {
                    $badge = 'danger';
                    $title = 'Type & purity category mismatch';
                } elseif ($typeCategory === 'gold') {
                    $badge = 'warning';
                    $title = 'Gold type';
                } else {
                    $badge = 'success';
                    $title = 'Valid type';
                }

                return '<span class="badge badge-'.$badge.'" title="'.$title.'">'.$typeName.'</span>';
            })

            /* =========================
               STOCK QTY
               ========================= */
            ->addColumn('stock_qty', fn ($row) => '<span class="badge badge-info">'.$row->stock_qty.'</span>'
            )

            /* =========================
               PURITY COLUMN (VALIDATED)
               ========================= */
            ->addColumn('purity_name', function ($row) {

                $purityRaw = $row->purity->name ?? 'N/A';
                $purityName = explode(' -', $purityRaw)[0];

                $purityCategory = strtolower($row->purity?->category?->name ?? '');
                $typeCategory = strtolower($row->type?->category?->name ?? '');

                $isValid = $purityCategory && $typeCategory && $purityCategory === $typeCategory;

                if (! $purityCategory || ! $typeCategory) {
                    $badge = 'secondary';
                    $title = 'Category not defined';
                } elseif (! $isValid) {
                    $badge = 'danger';
                    $title = 'Purity category mismatch with type';
                } elseif ($purityCategory === 'gold') {
                    $badge = 'warning';
                    $title = 'Valid gold purity';
                } else {
                    $badge = 'success';
                    $title = 'Valid purity';
                }

                return '<span class="badge badge-'.$badge.'" title="'.$title.'">'.$purityName.'</span>';
            })

            /* =========================
               STATUS
               ========================= */
            ->addColumn('status', function ($row) {

                $badge = $row->status == 1 ? 'danger' : 'success';
                $status = $row->status == 0 ? 'Active' : 'Deactive';

                return '<button type="button"
                            onClick="statusFunction('.$row->id.', \'product\')"
                            class="badge badge-light-'.$badge.'">
                            '.$status.'
                        </button>';
            })

            /* =========================
               DETAILS
               ========================= */
            ->addColumn('details', function ($row) {
                return '
                    <div class="product-details">
                        <strong class="text-info">Gross:</strong> '.$row->gross_weight.' |
                        <strong>Net:</strong> '.$row->net_weight.'<br>
                        <strong class="text-success">Price:</strong> '.MONEY.$row->price.'<br>
                        <strong class="text-warning">Created:</strong> '.$row->created_at->format('d-M-Y').'<br>
                        <strong class="text-danger">Updated:</strong> '.$row->updated_at->format('d-M-Y').'
                    </div>
                ';
            })

            /* =========================
               ACTION
               ========================= */
            ->addColumn('action', function ($row) {

                $edit = route('products.edit', $row->id);

                return '
                    <a href="'.$edit.'" class="action-btn me-2">
                        <i data-feather="edit"></i>
                    </a>
                    <a href="javascript:void(0)"
                       onClick="deleteFunction('.$row->id.', \'product\')"
                       class="action-btn">
                        <i data-feather="trash-2"></i>
                    </a>
                ';
            })

            ->rawColumns([
                'type_name',
                'purity_name',
                'stock_qty',
                'status',
                'details',
                'action',
            ]);
    }

    /**
     * Query source
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()
            ->with([
                'supplier:id,name',
                'type:id,name,category_id',
                'type.category:id,name',
                'purity:id,name,category_id',
                'purity.category:id,name',
            ]);
    }

    /**
     * HTML builder
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
                'pageLength' => 10,
                'drawCallback' => 'function() { feather.replace(); }',
            ]);
    }

    /**
     * Columns
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('type_name')->title('Type'),
            Column::computed('purity_name')->title('Purity'),
            Column::computed('stock_qty')->title('Qty'),
            Column::make('name')->title('Name'),
            Column::computed('details')->orderable(false)->searchable(false),
            Column::computed('status'),
            Column::computed('action')->exportable(false)->printable(false),
        ];
    }

    /**
     * Export filename
     */
    protected function filename(): string
    {
        return 'Product_'.date('YmdHis');
    }
}
