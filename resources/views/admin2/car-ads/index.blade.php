<x-admin.app-layout>
    <x-slot name="header">
        {{ __('Ads') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ __('Ads') }}
            </span>
            <span class="float-right">
                <a href="{{ route('admin.ads.settings.edit') }}"
                   class="btn btn-info btn-sm" data-toggle="tooltip"
                   data-placement="top" title="" data-original-title="{{ __('Settings') }}">
                    <i class="fas fa-cog fa-fw"></i>
                </a>
            </span>
        </div>
        <div class="card-body">
            <livewire:tables.car-ads.table/>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).on('submit', '.delete-form', function (e) {
                if (!confirm("{{ __('Do you really want to delete?') }}")) {
                    e.preventDefault();
                }
            });
        </script>
    @endpush
</x-admin.app-layout>
