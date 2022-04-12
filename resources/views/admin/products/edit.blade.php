<x-admin.app-layout>

    @push('styles')
    <style type="text/css">
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 500px !important;
        }
    </style>
    <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Edit product') }}
    </x-slot>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>
                                {{ __('Category') }}
                            </label>

                            <input type="text" class="form-control " value="{{ $product->category->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="brand_id">
                                {{ __('Brand') }}
                            </label>

                            <select
                                class="form-control border selectpicker show-tick @error('brand_id') is-invalid @enderror"
                                name="brand_id" id="brand_id" data-live-search="true" data-style="btn-white"
                                title="{{ __('Select brand') }}">
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id')==$brand->id || $product->brand_id ==
                                    $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name ?? '' }}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="block_id">
                                {{ __('Blocks') }}
                            </label>

                            <select
                                class="form-control border selectpicker show-tick @error('block_id') is-invalid @enderror"
                                name="block_id[]" id="block_id" data-live-search="true" data-style="btn-white"
                                title="{{ __('Select blocks') }}" multiple data-actions-box="true">
                                @foreach ($blocks as $block)
                                <option value="{{ $block->id }}" {{ old('block_id')==$block->id ||
                                    $product->blocks->contains($block->id) ? 'selected' : '' }}>
                                    {{ $block->name ?? '' }}
                                </option>
                                @endforeach
                            </select>

                            @error('block_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <div>
                                <label for="name">
                                    {{ __('Name') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                @include('admin.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                <input type="hidden" id="name" name="name:{{ $key }}"
                                    class="form-control @error('name:' . $key) is-invalid @enderror"
                                    input-lang="{{ $key }}"
                                    value="{{ old('name:' . $key) ?? $product->translate($key)->name }}" required
                                    @if($key==='ru' ) readonly @endif>

                                @error('name:' . $key)
                                <span style="display: none" input-lang="{{ $key }}" class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @endforeach

                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="description">
                                    {{ __('Description') }}
                                </label>
                                @include('admin.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                <div style="display: none;" input-lang="{{ $key }}">
                                    <textarea id="description" name="description:{{ $key }}"
                                        class="ckeditor form-control @error('description:' . $key) is-invalid @enderror">
                                        {{ old('description:' . $key) ?? $product->translate($key)->description }}
                                    </textarea>
                                </div>

                                @error('description:' . $key)
                                <span style="display: none" input-lang="{{ $key }}" class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @endforeach
                            </div>
                        </div>

                        @if ($product->image)
                        <div class="form-group">
                            <label for="image">
                                {{ __('Current image') }}
                            </label>
                            <div class="row">
                                <div class="col-4">
                                    @include('admin.components.image', ['image' => $product->image])
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="image">
                                {{ __('Image') }}
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                    id="image" name="image" value="{{ old('image') }}">
                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                            </div>

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @if ($product->images()->exists())
                        <div class="form-group">
                            <label for="image">
                                {{ __('Other images') }}
                            </label>
                            <div class="row">
                                @foreach ($product->images as $image)
                                <div class="col-4">
                                    <div image-id="{{ $image->id }}">
                                        @include('admin.components.image', ['image' => $image->image])
                                    </div>
                                    <button type="button" class="btn btn-outline-danger btn-sm m-2 delete-image"
                                        data-id="{{ $image->id }}">
                                        <i class="fa fa-times fa-fw"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="images">
                                {{ __('Images') }}
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('images') is-invalid @enderror"
                                    id="images" name="images[]" value="{{ old('images') }}" multiple>
                                <label class="custom-file-label" for="images">{{ __('Choose file') }}</label>
                            </div>

                            @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">
                                {{ __('Price') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <input type="number" min="0" step=".10" id="price" name="price"
                                class="form-control @error('price') is-invalid @enderror" required
                                value="{{ old('price') ?? $product->price }}" placeholder="Turkmen manat (TMT)" readonly="">

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount_price">
                                {{ __('Discount price') }}
                            </label>

                            <input type="number" min="0" step=".10" id="discount_price" name="discount_price"
                                class="form-control @error('discount_price') is-invalid @enderror"
                                value="{{ old('discount_price') ?? $product->discount_price }}"
                                placeholder="Turkmen manat (TMT)">

                            @error('discount_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="quantity">
                                {{ __('Quantity') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <input type="number" min="0" id="quantity" name="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" required
                                value="{{ old('quantity') ?? $product->quantity }}" readonly="">

                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="attribute_value_id">
                                {{ __('Attributes') }}
                                <button type="button" class="btn btn-primary btn-sm ml-2" data-toggle="modal"
                                    id="mediumButton" data-target="#mediumModal"
                                    data-attr="{{ route('admin.attribute-values.create') }}"
                                    title="{{ __('Create attribute') }}"> <i class="fas fa-plus-circle"></i>
                                </button>
                            </label>

                            <select class="attribute_value @error('attribute_value_id') is-invalid @enderror"
                                name="attribute_value_id[]" id="attribute_value_id" multiple="multiple">
                                @foreach ($product->attributeValues as $attributeValue)
                                <option selected="selected" value="{{ $attributeValue->id }}">
                                    {{ $attributeValue->name }}</option>
                                @endforeach
                            </select>

                            @error('attribute_value_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                    class="custom-control-input @error('status') is-invalid @enderror" id="status"
                                    name="status" value="1" {{ old('status')=='1' || $product->status === 1 ? 'checked'
                                : '' }}>
                                <label class="custom-control-label" for="status">{{ __('Status') }}</label>
                            </div>

                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input @error('hit') is-invalid @enderror"
                                    id="hit" name="hit" value="1" {{ old('hit')=='1' || $product->hit === 1 ? 'checked'
                                : '' }}>
                                <label class="custom-control-label" for="hit">{{ __('Hit') }}</label>
                            </div>

                            @error('hit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-fw fa-pen"></i> {{ __('Edit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form id="attributeValueForm">
                            @csrf

                            <div class="form-group">
                                <label for="attribute">
                                    {{ __('Group') }}
                                    <span class="required text-danger">*</span>
                                </label>

                                <select class="form-control attribute @error('attribute_id') is-invalid @enderror"
                                    name="attribute_id" id="attribute_id" required>
                                </select>

                                @error('attribute_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="name">
                                        {{ __('Name') }}
                                        <span class="required text-danger">*</span>
                                    </label>
                                    @include('admin.components.form-lang')
                                </div>

                                <div class="lang-group">
                                    @foreach (config('lang.locales') as $key => $locale)
                                    <input type="hidden" id="name_{{ $key }}" name="name:{{ $key }}"
                                        class="form-control @error('name:' . $key) is-invalid @enderror"
                                        input-lang="{{ $key }}" value="{{ old('name:' . $key) }}" required>

                                    @error('name:' . $key)
                                    <span style="display: none" input-lang="{{ $key }}" class="invalid-feedback"
                                        role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @endforeach

                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" id="attributeValueFormButton"
                                    class="btn btn-primary btn-sm float-right">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Create') }}
                                </button>
                            </div>
                        </form>
                        <span style="display: none" class="alert alert-success" id="success"></span>
                        <span style="display: none" class="alert alert-danger" id="danger"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
    <script src="{{ asset('js/form-lang.js') }}"></script>
    <script>
        $(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $(".delete-image").click(function() {
                    let id = $(this).data("id");
                    $(this).toggle();
                    $('div[image-id=' + id + ']').toggle();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.product.image') }}",
                        data: {
                            id: id,
                        }
                    });
                });

                $(".attribute_value").select2({
                    closeOnSelect: false,
                    multiple: true,
                    placeholder: "{{ __('Select attribute values') }}",
                    width: "100%",
                    allowClear: true,
                    ajax: {
                        cache: true,
                        dataType: "json",
                        type: "GET",
                        url: "{{ route('admin.attributes.values.select') }}",
                        processResults: function(res) {
                            return {
                                results: res
                            };
                        }
                    },
                });

                // display a modal (medium modal)
                $(document).on('click', '#mediumButton', function(event) {
                    event.preventDefault();
                    $('#mediumModal').modal("show");
                });

                $(".attribute").select2({
                    placeholder: "{{ __('Select attribute') }}",
                    width: "100%",
                    ajax: {
                        cache: true,
                        dataType: "json",
                        type: "GET",
                        url: "{{ route('admin.attributes.select') }}",
                        processResults: function(res) {
                            return {
                                results: res
                            };
                        }
                    },
                });

                $('#attributeValueForm').on('submit', function(e) {
                    e.preventDefault();

                    attribute_id = $('#attribute_id').find('option:selected').val();
                    name_tk = $('#name_tk').val();
                    name_en = $('#name_en').val();
                    name_ru = $('#name_ru').val();

                    $.ajax({
                        url: "{{ route('admin.attribute-values.store') }}",
                        type: "POST",
                        data: {
                            attribute_id,
                            name_tk,
                            name_en,
                            name_ru,
                        },
                        beforeSend: function() {
                            $("#attributeValueFormButton").prop('disabled', true);
                        },
                        success: function(response) {
                            $("span[id=success]").html(response.message).show();
                            $("#attributeValueFormButton").prop('disabled', false);
                            setTimeout(function() {
                                $('#mediumModal').modal("hide");
                                $('#name_tk').val('');
                                $('#name_en').val('');
                                $('#name_ru').val('');
                                $("span[id=success]").html('').hide();
                            }, 1000);
                        },
                        error: function(err) {
                            $("span[id=danger]").html("Maglumatlary doly dolduryň").show();
                            setTimeout(function() {
                                $("span[id=danger]").html('').hide();
                            }, 1000);
                            $("#attributeValueFormButton").prop('disabled', false);
                        }
                    });
                });
            });
    </script>
    @endpush

</x-admin.app-layout>
