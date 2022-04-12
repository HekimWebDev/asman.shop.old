<?php

namespace App\Http\Livewire\Tables\CarAds;

use App\Models\CarModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CarAd;

class Table extends DataTableComponent
{
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    public array $perPageAccepted = [10, 25, 50, 100];
    public bool $perPageAll = true;

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make(__('User'), "user.full_name")
                ->searchable(function (Builder $query, $searchTerm) {
                    $query->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('first_name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $searchTerm . '%');
                    });
                })
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(User::select('first_name')->whereColumn('car_ads.user_id', 'users.id'), $direction);
                }),
            Column::make(__('Car brand'), "carModel.carBrand.name")
                ->searchable(function (Builder $query, $searchTerm) {
                    $query->orWhereHas('carModel.carBrand', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', '%' . $searchTerm . '%');
                    });
                }),
            Column::make(__('Car model'), "carModel.name")
                ->searchable(function (Builder $query, $searchTerm) {
                    $query->orWhereHas('carModel', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', '%' . $searchTerm . '%');
                    });
                })
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(CarModel::select('name')->whereColumn('car_ads.car_model_id', 'car_models.id'), $direction);
                }),
            Column::make(__('Status'), "status")
                ->asHtml()
                ->sortable()
                ->format(
                    fn($value) => match ($value) {
                        'waiting' => '<span class="badge badge-secondary">' . __('Waiting') . '</span>',
                        'archived' => '<span class="badge badge-warning">' . __('Archived') . '</span>',
                        'published' => '<span class="badge badge-success">' . __('Published') . '</span>',
                        'processing' => '<span class="badge badge-primary">' . __('Processing') . '</span>',
                    }),
            Column::make(__('Date of creation'), "created_at")
                ->sortable(),
            Column::make(__('Published time'), "published_at")
                ->sortable(),
            Column::make(__('Actions'))
                ->asHtml()
                ->excludeFromSelectable()
                ->format(
                    fn($value, $column, $row) => view('components.buttons.premium-request', [
                            'boolean' => $row->car_ad_type_exists,
                            'route' => route('admin.ads.types.index', $row->id)
                        ])
                        . view('components.buttons.show', [
                            'route' => route('admin.ads.show', $row->id)
                        ])
                        . view('components.buttons.delete', [
                            'route' => route('admin.ads.destroy', $row->id)
                        ])
                )
        ];
    }

    public function query(): Builder
    {
        return CarAd::query()
            ->with([
                'carAdType',
                'carModel' => fn($query) => $query->with('carBrand'),
                'user',
            ])
            ->withExists('carAdType');
    }

    public function setTableRowClass($row): ?string
    {
        if ($row->is_premium) {
            if (config('livewire-tables.theme') === 'tailwind') {
                return '!bg-yellow-200';
            } else if (config('livewire-tables.theme') === 'bootstrap-4') {
                return 'bg bg-warning';
            } else if (config('livewire-tables.theme') === 'bootstrap-5') {
                return 'bg bg-warning';
            }
        }
        return null;
    }
}
