<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StockDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('purchased', function ($row) {
                return number_format($row->purchased, 3);
            })
            ->addColumn('sold', function ($row) {
                return number_format($row->sold, 3);
            })
            ->addColumn('balance', function ($row) {
                $class = $row->balance >= 0 ? 'text-success' : 'text-danger';

                return '<span class="'.$class.'">'.number_format($row->balance, 3).'</span>';
            })
            ->rawColumns(['balance']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        // Purchased weight
        $purchased = DB::table('supplier_billing_items')
            ->select(
                'category_id',
                'purity_id',
                DB::raw('SUM(total_weight) as purchased_weight')
            )
            ->groupBy('category_id', 'purity_id');

        // Sold weight
        $sold = DB::table('billing_items as bi')
            ->select(
                DB::raw('p.type_id as category_id'),
                DB::raw('p.purity_id as purity_id'),
                DB::raw('SUM(bi.net_weight) as sold_weight')
            )
            ->join('products as p', 'p.id', '=', 'bi.product_id')
            ->groupBy('p.type_id', 'p.purity_id');

        // Combine
        $query = DB::query()
            ->select(
                'c.name as category_name',
                'pu.name as purity_name',
                DB::raw('COALESCE(p.purchased_weight, 0) as purchased'),
                DB::raw('COALESCE(s.sold_weight, 0) as sold'),
                DB::raw('COALESCE(p.purchased_weight, 0) - COALESCE(s.sold_weight, 0) as balance')
            )
            ->fromSub($purchased, 'p')
            ->leftJoinSub($sold, 's', function ($join) {
                $join->on('p.category_id', '=', 's.category_id')
                    ->on('p.purity_id', '=', 's.purity_id');
            })
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->join('purities as pu', 'pu.id', '=', 'p.purity_id')
            ->union(
                DB::query()
                    ->select(
                        'c2.name as category_name',
                        'pu2.name as purity_name',
                        DB::raw('0 as purchased'),
                        DB::raw('COALESCE(s2.sold_weight, 0) as sold'),
                        DB::raw('0 - COALESCE(s2.sold_weight, 0) as balance')
                    )
                    ->fromSub($sold, 's2')
                    ->join('categories as c2', 'c2.id', '=', 's2.category_id')
                    ->join('purities as pu2', 'pu2.id', '=', 's2.purity_id')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('supplier_billing_items as sbi')
                            ->whereRaw('sbi.category_id = s2.category_id AND sbi.purity_id = s2.purity_id');
                    })
            );

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stock-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                \Yajra\DataTables\Html\Button::make('excel'),
                \Yajra\DataTables\Html\Button::make('csv'),
                \Yajra\DataTables\Html\Button::make('pdf'),
                \Yajra\DataTables\Html\Button::make('print'),
                \Yajra\DataTables\Html\Button::make('reset'),
                \Yajra\DataTables\Html\Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('category_name')->title('Category'),
            Column::make('purity_name')->title('Purity'),
            Column::make('purchased')->title('Purchased')->className('text-info font-weight-bold'),
            Column::make('sold')->title('Sold')->className('text-danger font-weight-bold'),
            Column::make('balance')->title('Balance'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Stock_Summary_'.date('YmdHis');
    }
}
