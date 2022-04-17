<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Categories position') }}
    </x-slot>

    @unless(!$categories->isNotEmpty())
        <div class="card shadow">
            <div class="card-header">
                <span class="font-weight-bold text-primary">
                    {{ __('Categories') }}
                </span>
            </div>
            <div class="card-body">
                <ul class="list-group" id="sort_category">
                    @foreach ($categories as $category)
                        <li class="list-group-item" data-id="{{ $category->id }}">
                            <span class="handle"></span> {{ $category->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endunless

    @push('scripts')

        <script>
            $(document).ready(function() {

                function updateToDatabase(idString) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    $.ajax({
                        url: "{{ route('admin.categories.position.update') }}",
                        method: 'POST',
                        data: {
                            ids: idString
                        },
                        success: function() {
                            alert('Successfully updated')
                            //do whatever after success
                        }
                    })
                }
                var target = $('#sort_category');
                target.sortable({
                    axis: "y",
                    update: function(e, ui) {
                        var sortData = target.sortable('toArray', {
                            attribute: 'data-id'
                        })
                        updateToDatabase(sortData.join(','))
                    }
                });

            });
        </script>

    @endpush

</x-admin.app-layout>
