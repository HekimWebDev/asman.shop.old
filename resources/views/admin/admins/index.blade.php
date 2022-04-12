<x-admin.app-layout>

    @push('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Admins') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ __('Admins') }}
            </span>
            <span class="float-right">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
                    data-placement="top" title="{{ __('Create') }}">
                    <i class="fa fa-fw fa-plus"></i>
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __('Full name') }}</th>
                            <th>{{ __('Email address') }}</th>
                            <th class="text-center">{{ __('Last visit') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <th class="text-center">{{ $admin->full_name }}</th>
                            <td>{{ $admin->email }}</td>
                            <td class="text-center">{{ $admin->last_activity ?? 'Null' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
                                    <i class=" fa fa-fw fa-pen"></i>
                                </a>
                            </td>
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
