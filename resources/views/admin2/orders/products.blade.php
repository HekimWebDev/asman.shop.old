<x-admin.app-layout>

    @push('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ $order->id . ' - ' . __('Products') }}
    </x-slot>

    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <span class="m-1 font-weight-bold text-primary">
                        <i class="fas fa-user fa-fw"></i>
                        <span>{{ __('Order details') }}</span>
                    </span>
                    <span class="float-right">
                        <form class="d-inline delete-form" action="{{ route('admin.orders.destroy', $order->id) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                data-placement="top" title="" data-original-title="{{ __('Delete') }}">
                                <i class="fa fa-trash fa-fw"></i>
                            </button>
                        </form>
                    </span>
                </div>
                <div class="card-body text-gray-900">
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('User') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $order->full_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Registered') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            @if ($order->user)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-times text-danger"></i>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Email') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $order->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Phone number') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ '+993 ' . $order->phone }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Address') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $order->address }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Comment') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $order->comment }}
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-sm-6 font-weight-bold">{{ __('Payment method') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            @if ($order->payment_type_id === 3)
                            <button type="button" class="btn
                                         @if ($order->orderStatus === 2) btn-success
                                        @else btn-danger @endif" data-toggle="tooltip" data-html="true"
                                data-placement="top" title="                           @if ($order->errorMessage)
                                    <span>errorMessage: {{ $order->errorMessage }}</span>
                                @else
                                    <span>orderStatusDescription:
                                        {{ $order->orderStatusDescription }}</span><br />
                                    <span>actionCode: {{ $order->actionCode }}</span><br />
                                    <span>actionCodeDescription:
                                        {{ $order->actionCodeDescription }}</span>
                                    @endif">
                                {{ $order->paymentType->name }}
                            </button>
                            @else
                            {{ $order->paymentType->name }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 font-weight-bold">{{ __('Ordered date') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $order->created_at->format('d.m.Y H:i:s') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Order status') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            <select onchange="getval(this);" @if ($order->status || !$order->is_approved) disabled
                                @endif>
                                <option data-order-id="{{ $order->id }}" @if (!$order->status) selected @endif
                                    value="0">
                                    {{ __('Waiting') }}
                                </option>
                                <option data-order-id="{{ $order->id }}" @if ($order->status) selected @endif value="1">
                                    {{ __('Accepted') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Approved order?') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            @if ($order->is_approved)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-times text-danger"></i>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Product count') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ $order->quantity }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 font-weight-bold">{{ __('Total') }}</div>
                        <div class="col-sm-6 font-italic float-right">
                            {{ number_format($order->total, 2) . ' TMT' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderProducts as $orderProduct)
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td class="text-center">
                                @if ($orderProduct->product->image)
                                <img src="{{ asset('storage/original/' . $orderProduct->product->image) }}" alt=""
                                    height="150">
                                @else
                                <span class="text-danger">{{ __('No image') }}</span>
                                @endif
                            </td>
                            <td>{{ $orderProduct->product->name }}</td>
                            <td class="text-center">{{ number_format($orderProduct->price, 2) . ' TMT' }}</td>
                            <td class="text-center">{{ $orderProduct->quantity }}</td>
                            <td class="text-center">
                                {{ number_format($orderProduct->price * $orderProduct->quantity, 2) . ' TMT' }}
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

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            function getval(select) {
                var url = "{{ route('admin.orders.status.post') }}";
                var data = {
                    order_id: $(select).find(":selected").data("order-id"),
                    status: select.value
                };

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    beforeSend: function() {
                        return confirm("{{ __('Do you want to change?') }}")
                    },
                    success: function(response) {
                        // console.log(response);
                    },
                    error: function(e) {
                        console.log(e.responseJSON);
                    }
                });
            };

            $(document).on('submit', '.delete-form', function(e) {
                if (!confirm("{{ __('Do you really want to delete?') }}")) {
                    e.preventDefault();
                }
            });
    </script>

    @endpush

</x-admin.app-layout>
