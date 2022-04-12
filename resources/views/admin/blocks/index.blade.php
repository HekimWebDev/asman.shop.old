<x-admin.app-layout>

    @push('styles')

        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Blocks') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="float-right">
                <a href="{{ route('admin.blocks.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
                    data-placement="top" title="{{ __('Create') }}">
                    <i class="fa fa-fw fa-plus"></i>
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Product count') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blocks as $block)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $block->name ?? '' }}</td>
                                <td class="text-center">
                                    {{ $block->products_count }}
                                </td>
                                <td class="text-center">
                                    @include('admin.components.status', ['id' => $block->id, 'status' =>
                                    $block->status, 'model' => 'Block'])
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.blocks.edit', $block->id) }}"
                                        class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                    </a>
                                    <form class="d-inline delete-form"
                                        action="{{ route('admin.blocks.destroy', $block->id) }}" method="post">
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
