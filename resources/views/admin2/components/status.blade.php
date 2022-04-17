<input type="checkbox" data-id="{{ $id }}" data-model="{{ $model }}" name="status" class="js-switch"
    {{ $status == 1 ? 'checked' : '' }}>

@push('scripts')
<script>
    $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $(function () {
                $(".js-switch").change(function () {
                    let status = $(this).prop("checked") === true ? 1 : 0;
                    let id = $(this).data("id");
                    let model = $(this).data("model");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.status') }}",
                        data: {
                            status: status,
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
