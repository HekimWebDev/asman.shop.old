<x-admin.app-layout>

    @push('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @endpush

    <x-slot name="header">
        {{ __('Blog comments') }}
    </x-slot>

    <div class="card shadow">
        <div class="card-header">
            <span class="font-weight-bold text-primary">
                {{ __('Blog comments') }}
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>{{ __('Comment') }}</th>
                            <th class="text-center">{{ __('Post') }}</th>
                            <th class="text-center">{{ __('User') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                        <tr>
                            <th class="text-center">{{ $loop->iteration }}</th>
                            <td>{{ $comment->message ?? '' }}</td>
                            <td class="text-center">{{ $comment->post->name ?? '' }}</td>
                            <td class="text-center">{{ $comment->user->fullName ?? '' }}</td>
                            <td class="text-center">
                                @include('admin.components.status', ['id' => $comment->id, 'status' =>
                                $comment->status, 'model' => 'BlogPostComment'])
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
