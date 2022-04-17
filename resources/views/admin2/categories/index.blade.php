<x-admin.app-layout>

    @push('styles')

        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Categories') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                @if (request('parent_id'))
                    {{ $parent->name . ' ' . __('category') }}
                @else
                    {{ __('Root category') }}
                @endif
            </span>
            <span class="float-right">
                <a href="{{ route('admin.categories.position') }}" class="btn btn-warning btn-sm" data-toggle="tooltip"
                   data-placement="top" title="{{ __('Position') }}">
                    <i class="fa fa-fw fa-sort"></i>
                </a>
                <a href="{{ route('admin.categories.index', ['show' => 'all']) }}" class="btn btn-light btn-sm"
                   data-toggle="tooltip" data-placement="top" title="{{ __('Show all') }}">
                    <i class="fa fa-fw fa-search"></i>
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th class="d-none">{{ __('Position') }}</th>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Icon') }}</th>
                        <th>{{ __('Product count') }}</th>
                        <th>{{ __('Category count') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Date of creation') }}</th>
                        <th>{{ __('Date of editing') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $chunk)
                        @foreach ($chunk as $category)
                            <tr class="text-center">
                                <th class="d-none">{{ $category->position }}</th>
                                <th>{{ $category->id }}</th>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    @if ($category->icon)
                                        <img src="{{ asset('storage/' . $category->icon) }}" height="36" alt=""/>
                                    @endif
                                </td>
                                <td>
                                    {{ $category->products_count }}
                                </td>
                                <td>
                                    {{ $category->categories_count }}
                                </td>
                                <td>
                                    <x-admin.status :id="$category->id" :status="$category->status"
                                                    model="Category"/>
                                </td>
                                <td>{{ $category->created_at->format('d.m.Y H:i:s') }}</td>
                                <td>{{ $category->updated_at->format('d.m.Y H:i:s') }}</td>
                                <td>
                                    @if ($category->childs->isNotEmpty())
                                        <a href="{{ route('admin.categories.index', ['show' => $category->id]) }}"
                                           class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top"
                                           title="{{ __('View') }}">
                                            <i class=" fa fa-fw fa-search-plus"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                       title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
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
