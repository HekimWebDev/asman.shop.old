<x-admin.app-layout>

    @push('styles')

        <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Attributes') }}
    </x-slot>

    <div class="row">

        <div class="col-12 mb-3">

            <div class="card shadow">
                <div class="card-header">
                    <span class="font-weight-bold text-primary">
                        {{ __('Groups') }}
                    </span>
                    <span class="float-right">
                        <a href="{{ route('admin.attributes.import') }}" class="btn btn-success btn-sm"
                            data-toggle="tooltip" data-placement="top" title="{{ __('Import') }}">
                            <i class="fa fa-fw fa-file-excel"></i>
                        </a>
                        <a href="{{ route('admin.attribute-groups.create') }}" class="btn btn-primary btn-sm"
                            data-toggle="tooltip" data-placement="top" title="{{ __('Create') }}">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{ __('Name') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attribute_groups as $attribute_group)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $attribute_group->name ?? '' }}</td>
                                    <td class="text-center">
                                        @include('admin.components.status', ['id' => $attribute_group->id, 'status' =>
                                        $attribute_group->status, 'model' => 'AttributeGroup'])
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.attributes.index', ['group_id' => $attribute_group->id]) }}"
                                            class="btn btn-light btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="{{ __('View') }}">
                                            <i class=" fa fa-fw fa-search-plus"></i>
                                        </a>
                                        <a href="{{ route('admin.attribute-groups.edit', $attribute_group->id) }}"
                                            class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="{{ __('Edit') }}"><i class="fa fa-pen fa-fw"></i>
                                        </a>
                                        <form class="d-inline delete-form"
                                            action="{{ route('admin.attribute-groups.destroy', $attribute_group->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title=""
                                                data-original-title="{{ __('Delete') }}">
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

        <div class="col-12">

            @if ($attributes)
                <div class="card shadow">
                    <div class="card-header">
                        <span class="font-weight-bold text-primary">
                            {{ __('Attributes') }}
                        </span>
                        <span class="float-right">
                            <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary btn-sm"
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
                                        <th>{{ __('Name') }}</th>
                                        <th class="text-center">{{ __('Attribute value count') }}</th>
                                        <th class="text-center">{{ __('Status') }}</th>
                                        <th class="text-center">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributes as $attribute)
                                        <tr>
                                            <th class="text-center">{{ $loop->iteration }}</th>
                                            <td>{{ $attribute->name ?? '' }}</td>
                                            <td class="text-center">
                                                {{ $attribute->attribute_values_count }}
                                            </td>
                                            <td class="text-center">
                                                @include('admin.components.status', ['id' => $attribute->id, 'status' =>
                                                $attribute->status, 'model' => 'Attribute'])
                                            </td>
                                            <td class="text-center">
                                                @if ($attribute->attributeValues->isNotEmpty())
                                                    <a href="{{ route('admin.attributes.values.index', $attribute->id) }}"
                                                        class="btn btn-light btn-sm" data-toggle="tooltip"
                                                        data-placement="top" title="{{ __('View') }}">
                                                        <i class=" fa fa-fw fa-search-plus"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.attributes.values.create', $attribute->id) }}"
                                                    class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="{{ __('Add value') }}"><i
                                                        class="fa fa-plus fa-fw"></i>
                                                </a>
                                                <a href="{{ route('admin.attributes.edit', $attribute->id) }}"
                                                    class="btn btn-success btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="{{ __('Edit') }}"><i
                                                        class="fa fa-pen fa-fw"></i>
                                                </a>
                                                <form class="d-inline delete-form"
                                                    action="{{ route('admin.attributes.destroy', $attribute->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="{{ __('Delete') }}">
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
            @endif

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
