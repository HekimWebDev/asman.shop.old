<x-admin.app-layout>

    @push('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Desired products') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="float-right">
                {{-- <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
                data-placement="top" title="{{ __('Create') }}">
                <i class="fa fa-fw fa-plus"></i>
                </a> --}}
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>{{ __('Product name') }}</th>
                            <th>{{ __('Quantity of desired') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($desiredProducts as $desiredProduct)
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('store.product-single', $desiredProduct->product->slug) }}"
                                    target="_blank">
                                    {{ $desiredProduct->product->name ?? '' }}
                                </a>
                            </td>
                            <td class="text-center">{{ $desiredProduct->quantity ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')

    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#dataTable').DataTable();
    </script>

    @endpush

</x-admin.app-layout>
