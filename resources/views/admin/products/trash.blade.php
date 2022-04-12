<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Trash') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="float-right">
                <form class="d-inline" action="{{ route('admin.products.restore-all') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top"
                            title="{{ __("Restore All") }}">
                            <span class="btn-inner--icon">
                              <i class="fa fa-trash-restore-alt fa-fw"></i>
                            </span>
                    </button>
                </form>
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
