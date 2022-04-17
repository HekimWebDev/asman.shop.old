<x-admin.app-layout>

    @push('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Blog tags') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="float-right">
                <a href="{{ route('admin.blog.tags.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
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
                            <th>{{ __('Name') }}</th>
                            <th class="text-center">{{ __('Post count') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogTags as $blogtag)
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $blogtag->name ?? '' }}</td>
                            <td class="text-center">{{ $blogtag->posts_count ?? '' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.blog.tags.edit', $blogtag->id) }}"
                                    class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
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
