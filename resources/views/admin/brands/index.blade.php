@extends('admin.layouts.app')

@section('content')

    @push('styles')
        <link href="{{ asset('assets/lib/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Create brand') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card shadow">
            <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ __('Brands') }}
            </span>
                <span class="float-right">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
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
                            <th class="text-center">{{ __('Image') }}</th>
                            <th class="text-center">{{ __('Product count') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $brand->name ?? '' }}</td>
                                <td class="text-center"><img src="{{ asset('storage/medium/' . $brand->image) }}"
                                                             alt="" width="150"></td>
                                <td class="text-center">
                                    {{ $brand->products_count }}
                                </td>
                                <td class="text-center">
                                    @include('admin.components.status', ['id' => $brand->id, 'status' =>
                                    $brand->status, 'model' => 'Brand'])
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                       class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                       title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                    </a>
                                    <form class="d-inline delete-form"
                                          action="{{ route('admin.brands.destroy', $brand->id) }}" method="post">
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
    </section>

    @push('scripts')

        <script src="{{ asset('/assets/lib/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/assets/lib/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $('#dataTable').DataTable();

            $(document).on('submit', '.delete-form', function(e) {
                if (!confirm("{{ __('Do you really want to delete?') }}")) {
                    e.preventDefault();
                }
            });
        </script>

    @endpush

@endsection
