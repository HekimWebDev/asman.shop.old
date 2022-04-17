<x-admin.app-layout>

    @push('styles')
    <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Create product') }}
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
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">
                                {{ __('Category') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select
                                class="form-control border selectpicker show-tick @error('category_id.*') is-invalid @enderror"
                                name="category_id[]" id="category_id" data-live-search="true" data-style="btn-white"
                                title="{{ __('Select category') }}" required>
                                @include('admin2.components.category', ['childs' => $categories, 'spaces' =>
                                0])
                            </select>

                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_id">
                                {{ __('Brand') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <select
                                class="form-control border selectpicker show-tick @error('brand_id') is-invalid @enderror"
                                name="brand_id" id="brand_id" data-live-search="true" data-style="btn-white"
                                title="{{ __('Select brand') }}" required>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name ?? '' }}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="block_id">
                                {{ __('Blocks') }}
                            </label>

                            <select
                                class="form-control border selectpicker show-tick @error('block_id') is-invalid @enderror"
                                name="block_id[]" id="block_id" data-live-search="true" data-style="btn-white"
                                title="{{ __('Select blocks') }}" multiple data-actions-box="true">
                                @foreach ($blocks as $block)
                                <option value="{{ $block->id }}" {{ old('block_id') == $block->id ? 'selected' : '' }}>
                                    {{ $block->name ?? '' }}
                                </option>
                                @endforeach
                            </select>

                            @error('block_id')
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
                                @include('admin2.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                <input type="hidden" id="name" name="name:{{ $key }}"
                                    class="form-control @error('name:'.$key) is-invalid @enderror"
                                    input-lang="{{ $key }}" value="{{ old('name:'.$key) }}" required>

                                @error('name:'.$key)
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
                                    <span class="required text-danger">*</span>
                                </label>
                                @include('admin2.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                <div style="display: none;" input-lang="{{ $key }}">
                                    <textarea id="description" name="description:{{ $key }}"
                                        class="ckeditor form-control @error('description:'.$key) is-invalid @enderror"
                                        required>
                                        {{ old('description:'.$key) ?? '' }}
                                    </textarea>
                                </div>

                                @error('description:'.$key)
                                <span style="display: none" input-lang="{{ $key }}" class="invalid-feedback"
                                    role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">
                                {{ __('Image') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                    id="image" name="image" value="{{ old('image') }}" required>
                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                            </div>

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

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
                                value="{{ old('price') ?? '' }}" placeholder="Turkmen manat (TMT)">

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
                                value="{{ old('discount_price') ?? '' }}" placeholder="Turkmen manat (TMT)">

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
                                value="{{ old('quantity') ?? '' }}">

                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="attribute_value_id">
                                {{ __('Attributes') }}
                        </label>
                        <select class="form-control custom-select @error('attribute_value_id.*') is-invalid @enderror"
                            name="attribute_value_id[]" id="attribute_value_id" required multiple
                            size="{{ $attributes->count() + $attributes->first()->attributeValues->count() }}">
                            @forelse ($attributes as $attribute)
                            <optgroup label="{{ $attribute->name ?? '' }}">
                                @foreach ($attribute->attributeValues as $attributeValue)
                                <option value="{{ $attributeValue->id }}">{{ $attributeValue->name }}
                                </option>
                                @endforeach
                            </optgroup>
                            @empty
                            {{ __('No attribute') }}
                            @endforelse
                        </select>

                        @error('attribute_value_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div> --}}

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror"
                            id="status" name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
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
                        <input type="checkbox" class="custom-control-input @error('hit') is-invalid @enderror" id="hit"
                            name="hit" value="1" {{ old('hit') == '1' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="hit">{{ __('Hit') }}</label>
                    </div>

                    @error('hit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-fw fa-plus"></i> {{ __('Create') }}
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/form-lang.js') }}"></script>
    @endpush

</x-admin.app-layout>
