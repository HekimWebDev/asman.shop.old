<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Products') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="float-right">
                <a href="{{ route('admin.products.attributes.import') }}" class="btn btn-success btn-sm"
                   data-toggle="tooltip" data-placement="top" title="{{ __('Import product attributes') }}">
                    <i class="fa fa-fw fa-file-excel"></i>
                </a>
                 <a href="{{ route('admin.products.trash') }}" class="btn btn-dark btn-sm"
                    data-toggle="tooltip" data-placement="top" title="{{ __('Trash') }}">
                    <i class="fa fa-fw fa-trash-alt"></i>
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="table">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')

        {{ $dataTable->scripts() }}

    @endpush

</x-admin.app-layout>
