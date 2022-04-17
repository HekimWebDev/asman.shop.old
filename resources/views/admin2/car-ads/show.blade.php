<x-admin.app-layout>
    @push('styles')
        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <x-slot name="header">
        {{ $carAd->id . ' - ' . __('ad') }}
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <span class="m-1 font-weight-bold text-primary">
                        <i class="fas fa-info fa-fw"></i>
                        <span>{{ __('Car ad information') }}</span>
                         @if($carAd->is_premium)
                            <span class="bg bg-warning text-dark">
                                <i class="fa fa-star fa-fw"></i>
                            </span>
                        @endif
                    </span>
                    <span class="float-right">
                        <a href="{{ route('admin.ads.types.index', $carAd->id) }}"
                           class="btn btn-dark btn-sm" data-toggle="tooltip"
                           data-placement="top" title="" data-original-title="{{ __('Premium requests') }}">
                            <i class="fa fa-clipboard-check fa-fw"></i>
                        </a>
                        <form class="d-inline delete-form" action="{{ route('admin.ads.destroy', $carAd->id) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="{{ __('Delete') }}">
                                <i class="fa fa-trash fa-fw"></i>
                            </button>
                        </form>
                    </span>
                </div>
                <div class="card-body text-gray-900">
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Date of creation') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->created_at->format('d.m.Y H:i:s') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('User') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->user->full_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Phone number') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ '+993 ' . $carAd->carAdPhones->first()->phone }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Car brand') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->carModel->carBrand->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Car model') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->carModel->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Year') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->year }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Car body') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->carBody->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Mileage') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->mileage }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Motor') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->motor }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Transmission') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->carTransmission->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('TypesTable of drive') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->carTypeOfDrive->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Color') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $carAd->carColour->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Price') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ number_format($carAd->price, 2) . ' TMT' }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Location') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            @if ($carAd->carPlace->hasParent)
                                {{ $carAd->carPlace->parent->name . ' / ' }}
                            @endif
                            {{ $carAd->carPlace->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Can credit') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            @if ($carAd->can_credit)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Can exchange') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            @if ($carAd->can_exchange)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Status') }}</div>
                        <div class="col-sm-2 font-italic float-right">
                            <livewire:car-ad.status-select
                                :car-ad="$carAd"
                                wire:change="changeEvent($event.target.value)"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        @foreach ($carAd->getMedia() as $media)
                            <div class="col-3">
                                {{ $media->img()->attributes(['class' => 'img-fluid']) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
