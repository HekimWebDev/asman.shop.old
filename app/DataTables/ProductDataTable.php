<?php

namespace App\DataTables;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            // ->only([
            //     'id',
            //     'image',
            //     'translation.name',
            //     'price',
            //     'quantity',
            //     'status',
            //     'category.translation.name',
            //     'actions'
            // ])
            ->editColumn(
                'image',
                fn ($query) => view('components.image', [
                    'image' => $query->image,
                    'width' => '100px'
                ])
            )
            ->editColumn(
                'price',
                fn ($query) => number_format($query->price, 2) . ' TMT'
            )
            ->addColumn(
                'status',
                fn ($query) => view('components.status', [
                    'id' => $query->id,
                    'status' => $query->status,
                    'model' => 'Product'
                ])
            )
            ->editColumn(
                'created_at',
                fn ($query) => $query->created_at->format('d.m.Y H:i:s')
            )
            ->editColumn(
                'updated_at',
                fn ($query) => $query->updated_at->format('d.m.Y H:i:s')
            )
            ->addColumn(
                'actions',
                fn ($query) => view('admin.components.edit-button', [
                    'route' => route('admin.products.edit', $query->id)
                ])
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->query()
            ->with([
                'translation',
                'category.translation'
            ])
            ->join(
                'product_translations',
                fn ($join) => $join->on('product_translations.product_id', '=', 'products.id')
                    ->whereLocale(app()->getLocale())
            )
            ->select([
                'products.*',
                'product_translations.name as translation.name',
            ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->language(asset('vendor/datatables/lang/' . app()->getLocale() . '.json'))
            ->orderBy(0, 'asc')
            ->lengthMenu()
            ->stateSave()
            ->stateDuration(1800)
            ->buttons(
                Button::make('pageLength'),
                // Button::make('export'),
                // Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title(__('#')),
            Column::make('translation.name')
                ->title(__('Name')),
            Column::make('image')
                ->title(__('Image'))
                ->exportable(false)
                ->orderable(false)
                ->printable(false)
                ->searchable(false),
            Column::make('category.translation.name')
                ->title(__('Category'))
                ->sortable(false),
            Column::make('price')
                ->title(__('Price')),
            Column::make('quantity')
                ->title(__('Quantity')),
            Column::make('status')
                ->title(__('Status'))
                ->exportable(false)
                ->orderable(false)
                ->printable(false)
                ->searchable(false),
            Column::make('created_at')
                ->title(__('Date of creation')),
            Column::make('updated_at')
                ->title(__('Date of editing')),
            Column::make('actions')
                ->title(__('Actions'))
                ->exportable(false)
                ->orderable(false)
                ->printable(false)
                ->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
