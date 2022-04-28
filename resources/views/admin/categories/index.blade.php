@extends('admin.layouts.app')

@push('styles')
    <link href="{{ asset('/assets/lib/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Categories') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

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
                <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-sm" data-toggle="tooltip"
                   data-placement="top" title="{{ __('Create') }}">
                    <i class="fa fa-fw fa-plus"></i>
                </a>
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
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Product count') }}</th>
                            <th>{{ __('Category count') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Date of creation') }}</th>
                            <th>{{ __('Date of editing') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($categories->count())
                            @foreach ($categories as $category)
                                <tr class="text-center">
                                    {{--                                    <th class="d-none">{{ $category->position }}</th>--}}
                                    <th>{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->products_count }}</td>
                                    <td>{{ $category->descendants_count }}</td>
                                    <td>
                                        <x-admin.status :id="$category->id" :status="$category->status"
                                                        model="Category"/>
                                    </td>
                                    <td>{{ $category->created_at->format('d.m.Y H:i:s') }}</td>
                                    <td>{{ $category->updated_at->format('d.m.Y H:i:s') }}</td>
                                    <td>
                                        {{--@if ($category->childs->isNotEmpty())
                                            <a href="{{ route('admin.categories.index', ['show' => $category->id]) }}"
                                               class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top"
                                               title="{{ __('View') }}">
                                                <i class=" fa fa-fw fa-search-plus"></i>
                                            </a>
                                        @endif--}}
                                        <form class="d-inline"
                                              action="{{ route('admin.categories.destroy', $category->id) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title=""
                                                    data-original-title="{{ __('Delete') }}">
                                                <i class="fa fa-trash fa-fw"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                           class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                           title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </section>

    @push('scripts')

        <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $('#dataTable').DataTable();
        </script>

    @endpush
@endsection
