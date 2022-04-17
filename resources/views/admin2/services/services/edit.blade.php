<x-admin.app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('admin/vendor/tagsinput/bootstrap-tagsinput.css') }}">
        <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Edit service') }}
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
                    <form method="POST" action="{{ route('admin.service.services.update', $service->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="service_category_id">
                                {{ __('Service category') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select
                                class="form-control border selectpicker show-tick @error('service_category_id.*') is-invalid @enderror"
                                name="service_category_id" id="service_category_id" data-live-search="true"
                                data-style="btn-white" title="{{ __('Select service category') }}" required>
                                @foreach ($serviceCategories as $serviceCategory)
                                    <option value="{{ $serviceCategory->id }}"
                                        {{ $service->serviceCategory->id === $serviceCategory->id ? 'selected' : '' }}>
                                        {{ $serviceCategory->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('service_category_id')
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
                                        class="form-control @error('name:' . $key) is-invalid @enderror"
                                        input-lang="{{ $key }}"
                                        value="{{ old('name:' . $key) ?? $service->translate($key)->name }}"
                                        required>

                                    @error('name:' . $key)
                                        <span style="display: none" input-lang="{{ $key }}"
                                            class="invalid-feedback" role="alert">
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
                                @include('admin2.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                    <div style="display: none;" input-lang="{{ $key }}">
                                        <textarea id="description" name="description:{{ $key }}"
                                            class="ckeditor form-control @error('description:' . $key) is-invalid @enderror">
                                        {{ old('description:' . $key) ?? $service->translate($key)->description }}
                                    </textarea>
                                    </div>

                                    @error('description:' . $key)
                                        <span style="display: none" input-lang="{{ $key }}"
                                            class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="owner">
                                    {{ __('Owner') }}
                                </label>
                                @include('admin2.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                    <input type="hidden" id="owner" name="owner:{{ $key }}"
                                        class="form-control @error('owner:' . $key) is-invalid @enderror"
                                        input-lang="{{ $key }}"
                                        value="{{ old('owner:' . $key) ?? $service->translate($key)->owner }}">

                                    @error('owner:' . $key)
                                        <span style="display: none" input-lang="{{ $key }}"
                                            class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @endforeach
                            </div>

                            <small>{{ __('Format') }}: F.A.A</small>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="address">
                                    {{ __('Address') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                @include('admin2.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                    <input type="hidden" id="address" name="address:{{ $key }}"
                                        class="form-control @error('address:' . $key) is-invalid @enderror"
                                        input-lang="{{ $key }}"
                                        value="{{ old('address:' . $key) ?? $service->translate($key)->address }}"
                                        required>

                                    @error('address:' . $key)
                                        <span style="display: none" input-lang="{{ $key }}"
                                            class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @endforeach

                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="phone">
                                    {{ __('Phone number') }}
                                    <span class="required text-danger">*</span>
                                </label>
                            </div>

                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                maxlength="8"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value="{{ old('phone') ?? $service->phone }}" required>

                            <small>{{ __('Format') }}: 61234567</small>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <div>
                                <label for="email">
                                    {{ __('Email') }}
                                </label>
                            </div>

                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') ?? $service->email }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        @if ($service->image)
                            <div class="w-25">
                                <label for="image">
                                    {{ __('Current image') }}
                                </label>

                                @include('admin2.components.image', ['image' => $service->image])
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

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                    class="custom-control-input @error('status') is-invalid @enderror" id="status"
                                    name="status" value="1" {{ $service->status == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">{{ __('Status') }}</label>
                            </div>

                            @error('status')
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

    @push('scripts')
        <script src="{{ asset('js/form-lang.js') }}"></script>
        <script src="{{ asset('admin/vendor/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    @endpush

</x-admin.app-layout>
