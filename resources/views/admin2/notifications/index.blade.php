<x-admin.app-layout>

    @push('styles')

        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Notifications') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __('Title') }}</th>
                            <th class="text-center">{{ __('Created at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr style=" @if ($notification->read_at) background-color: #F4F7F7 @endif">
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">
                                    <a
                                        href="{{ url($notification->data['url'] . '?notification_id=' . $notification->id) }}">
                                        {{ $notification->data['title'] }}
                                    </a>
                                </td>
                                <td class="text-center">{{ $notification->created_at->diffForHumans() }}</td>
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
