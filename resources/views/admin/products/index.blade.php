@extends('admin.layouts.app')

@push('styles')

    <link href="{{ asset('assets/lib/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Products') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <div class="card shadow">
            <div class="card-header">
            <span class="float-right">
                <a href="{{ route('admin.products.attributes.import') }}" class="btn btn-dark btn-sm"
                   data-toggle="tooltip" data-placement="top" title="{{ __('Import images') }}">
                    <i class="fa fa-fw fa-file-archive"></i>
                </a>
                <a href="{{--{{ route('admin.products.import') }}--}}" class="btn btn-success btn-sm"
                   data-toggle="tooltip"
                   data-placement="top" title="{{ __('Import') }}">
                    <i class="fa fa-fw fa-file-excel"></i>
                </a>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip"
                   data-placement="top" title="{{ __('Create') }}">
                    <i class="fa fa-fw fa-plus"></i>
                </a>
            </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th class="text-center">{{ __('Category') }}</th>
                            <th class="text-center">{{ __('Price') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($products as $product)
                            <tr>
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/medium/' . $product->image) }}" alt=""
                                             width="150">
                                    @else
                                        <span class="text-danger">{{ __('No image') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('store.product-single', $product->slug) }}" target="_blank">
                                        {{ $product->name ?? '' }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    {{ $product->category->name ?? '' }}
                                </td>
                                <td class="text-center">
                                    @if ($product->discount_price)
                                        <small>
                                            <del class="text-muted">
                                                {{ number_format($product->tmt_price, 2) . ' TMT' }}
                                            </del>
                                        </small>
                                        {{ number_format($product->discount_tmt_price, 2) . ' TMT' }}
                                    @else
                                        {{ number_format($product->tmt_price, 2) . ' TMT' }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @include('admin.components.status', ['id' => $product->id, 'status' =>
                                    $product->status, 'model' => 'Product'])
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                       title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('admin.products.destroy', $product->id) }}" method="post">
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </section>

    @push('scripts')

        <script src="{{ asset('assets/lib/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/lib/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $('#dataTable').DataTable();
        </script>

    @endpush
@endsection
