<x-admin.app-layout>

    @push('styles')

        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ __('Users') }}
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
                            <th class="text-center">{{ __('User type') }}</th>
                            <th class="text-center">{{ __('Phone number') }}</th>
                            <th class="text-center">{{ __('Order count') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Registration') }}</th>
                            <th class="text-center">{{ __('Last visit') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <th class="text-center">{{ $user->full_name }}</th>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">{{ $user->user_type }}</td>
                                <td class="text-center">
                                    <a href="tel:{{ $user->phone_number }}">{{ $user->phone_number }}</a>
                                </td>
                                <td class="text-center">
                                    {{ $user->orders->count() }}
                                </td>
                                <td class="text-center">
                                    @include('admin.components.status', ['id' => $user->id, 'status' =>
                                    $user->status, 'model' => 'User'])
                                </td>
                                <td class="text-center">{{ $user->created_at }}</td>
                                <td class="text-center">{{ $user->last_activity ?? 'Null' }}</td>
                                <td class="text-center">
                                    @if ($user->orders->isNotEmpty())
                                        <a href="{{ route('admin.users.orders.index', $user->id) }}"
                                            class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="{{ __('View orders') }}">
                                            <i class=" fa fa-fw fa-search-plus"></i>
                                        </a>
                                    @endif
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
