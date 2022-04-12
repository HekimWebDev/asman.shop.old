<?php

namespace App\Http\Livewire\Tables\CarAds;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CarAdType;

class TypesTable extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    public int $carAdId;

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable(),
            Column::make(__('Is active'), "is_active")
                ->format(
                    fn($value) => view('components.tables.cells.boolean', ['boolean' => $value])
                )
                ->searchable()
                ->sortable(),
            Column::make(__('End time'), "expire_date")
                ->format(
                    fn($value) => is_null($value) ? null : $value->diffForHumans()
                )
                ->searchable()
                ->sortable(),
            Column::make(__('Expire date'), "expire_date")
                ->format(fn($value) => is_null($value) ? null : $value->toFormattedDateString())
                ->searchable()
                ->sortable(),
            Column::make(__('Date of creation'), "created_at")
                ->searchable()
                ->sortable(),
            Column::make(__('Date of editing'), "updated_at")
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->format(
                    fn($value, $column, $row) => view('components.buttons.check', [
                        'boolean' => (is_null($row->expire_date) || now()->diffInSeconds($row->expire_date, false) > 0) ?: 0,
                        'route' => route('admin.ads.types.edit', [$row->car_ad_id, $row->id])
                    ])
                )
                ->asHtml()
                ->excludeFromSelectable()
        ];
    }

    public function query(): Builder
    {
        return CarAdType::query()
             ->when($this->carAdId, function ($q) {
                $q->where('car_ad_id', $this->carAdId);
            });
    }

    public function setTableRowClass($row): ?string
    {
        if (now()->diffInSeconds($row->expire_date, false) < 0) {
            if (config('livewire-tables.theme') === 'tailwind') {
                return '!bg-red-200';
            } else if (config('livewire-tables.theme') === 'bootstrap-4') {
                return 'bg-danger text-white';
            } else if (config('livewire-tables.theme') === 'bootstrap-5') {
                return 'bg-danger text-white';
            }
        }
        return null;
    }
}
