<x-admin.app-layout>

    @push('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Orders') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ __('Orders') }}
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>{{ __('Order №') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Registered') }}</th>
                            <th>{{ __('Phone number') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Comment') }}</th>
                            <th>{{ __('Payment method') }}</th>
                            <th>{{ __('Ordered date') }}</th>
                            <th>{{ __('Order status') }}</th>
                            <th>{{ __('Approved order?') }}</th>
                            <th>{{ __('Product count') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td class="text-center">{{ '#' . $order->id }}</td>
                            <td>{{ $order->full_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td class="text-center">
                                @if ($order->user)
                                <i class="fa fa-check text-success"></i>
                                @else
                                <i class="fa fa-times text-danger"></i>
                                @endif
                            </td>
                            <td> {{ '+993 ' . $order->phone ?? '' }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->comment }}</td>
                            <td class="text-center">
                                @if ($order->payment_type_id === 3)
                                <button type="button" class="btn
                                         @if ($order->orderStatus === 2) btn-success
                                        @else btn-danger @endif" data-toggle="tooltip" data-html="true"
                                    data-placement="top" title="             @if ($order->errorMessage)
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
                            </td>
                            <td class="text-center">{{ $order->created_at->format('d.m.Y H:i:s') }}</td>
                            <td class="text-center">
                                <select onchange="getval(this);" @if ($order->status || !$order->is_approved) disabled
                                    @endif>
                                    <option data-order-id="{{ $order->id }}" @if (!$order->status) selected @endif
                                        value="0">
                                        {{ __('Waiting') }}
                                    </option>
                                    <option data-order-id="{{ $order->id }}" @if ($order->status) selected @endif
                                        value="1">
                                        {{ __('Accepted') }}
                                    </option>
                                </select>
                            </td>
                            <td class="text-center">
                                @if ($order->is_approved)
                                <i class="fa fa-check text-success"></i>
                                @else
                                <i class="fa fa-times text-danger"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ $order->quantity }}</td>
                            <td class="text-center">
                                {{ number_format($order->total, 2) . ' TMT' }}
                            </td>
                            <td class="text-center">
                                @if ($order->order_products_count)
                                <a href="{{ route('admin.orders.products.index', $order) }}"
                                    class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('View') }}">
                                    <i class=" fa fa-fw fa-search-plus"></i>
                                </a>
                                @endif
                                <form class="d-inline delete-form"
                                    action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
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
