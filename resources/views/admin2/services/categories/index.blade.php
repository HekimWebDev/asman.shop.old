<x-admin.app-layout>

    @push('styles')

        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Service categories') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="float-right">
                <a href="{{ route('admin.service.categories.create') }}" class="btn btn-primary btn-sm"
                    data-toggle="tooltip" data-placement="top" title="{{ __('Create') }}">
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
                            <th class="text-center">{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th class="text-center">{{ __('Service count') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceCategories as $serviceCategory)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">
                                    @include('components.image', ['image' => $serviceCategory->image, 'width' =>
                                    '150'])
                                </td>
                                <td>{{ $serviceCategory->name ?? '' }}</td>
                                <td class="text-center">
                                    {{ $serviceCategory->services_count }}
                                </td>
                                <td class="text-center">
                                    @include('admin.components.status', ['id' => $serviceCategory->id, 'status' =>
                                    $serviceCategory->status, 'model' => 'ServiceCategory'])
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.service.categories.edit', $serviceCategory->id) }}"
                                        class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                    </a>
                                    <form class="d-inline delete-form"
                                        action="{{ route('admin.service.categories.destroy', $serviceCategory->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="" data-original-title="{{ __('Delete') }}">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </button>
                                    </form>
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

            $(document).on('submit', '.delete-form', function(e) {
                if (!confirm("{{ __('Do you really want to delete?') }}")) {
                    e.preventDefault();
                }
            });
        </script>

    @endpush

</x-admin.app-layout>
