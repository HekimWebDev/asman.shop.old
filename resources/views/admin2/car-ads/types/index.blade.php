<x-admin.app-layout>
    <x-slot name="header">
        {{ $ad->id . ' - ' . __('Premium requests') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ $ad->id . ' - ' . __('Premium requests') }}
            </span>
            @unless($ad->is_premium)
                <span class="float-right">
                    <a href="{{ route('admin.ads.types.create', $ad->id) }}"
                       class="btn btn-primary btn-sm" data-toggle="tooltip"
                       data-placement="top" title="" data-original-title="{{ __('Create') }}">
                        <i class="fas fa-plus fa-fw"></i>
                    </a>
                </span>
            @endunless
        </div>
        <div class="card-body">
            <livewire:tables.car-ads.types-table :car-ad-id="$ad->id"/>
        </div>
    </div>
</x-admin.app-layout>
