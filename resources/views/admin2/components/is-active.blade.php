<input type="checkbox" data-id="{{ $id }}" data-model="{{ $model }}" name="is_active" class="js-switch" {{ $is_active==1
    ? 'checked' : '' }}>

@push('scripts')
<script>
    $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $(function () {
                $(".js-switch").change(function () {
                    let is_active = $(this).prop("checked") === true ? 1 : 0;
                    let id = $(this).data("id");
                    let model = $(this).data("model");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.is-active') }}",
                        data: {
                            is_active: is_active,
                            id: id,
                            model: model,
                        },
                        // success: function (res) {
                        //     console.log(res.responseJSON);
                        // },
                        // error: function (err) {
                        //     console.log(err.responseJSON);
                        // },
                    });
                });
            });
</script>
@endpush
