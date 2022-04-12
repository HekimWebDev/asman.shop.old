<x-admin.app-layout>

    @push('styles')
        <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Edit category') }}
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
                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>
                                {{ __('Category') }}
                            </label>

                            <input type="text" class="form-control " value="{{ $category->name }}" readonly>
                        </div>

                        @if ($category->icon)
                            <div class="w-25">
                                <label for="image">
                                    {{ __('Current icon') }}
                                </label>
                                <br>
                                <img src="{{ asset('storage/' . $category->icon) }}" height="36" />
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="icon">
                                {{ __('Icon') }}
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('icon') is-invalid @enderror"
                                    id="icon" name="icon" value="{{ old('icon') }}">
                                <label class="custom-file-label" for="icon">{{ __('Choose file') }}</label>
                            </div>

                            @error('icon')
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
                                    <input type="hidden" id="name" name="name:{{ $key }}"
                                        class="form-control @error('name:' . $key) is-invalid @enderror"
                                        input-lang="{{ $key }}"
                                        value="{{ old('name:' . $key) ?? $category->translate($key)->name }}"
                                        required @if ($key === 'ru') readonly @endif>

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
                                @include('admin.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                    <div style="display: none;" input-lang="{{ $key }}">
                                        <textarea id="description" name="description:{{ $key }}"
                                            class="ckeditor form-control @error('description:' . $key) is-invalid @enderror">
                                        {{ old('description:' . $key) ?? $category->translate($key)->description }}
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

                        @if ($category->image)
                            <div class="w-25">
                                <label for="image">
                                    {{ __('Current image') }}
                                </label>

                                @include('admin.components.image', ['image' => $category->image])
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
                                    class="custom-control-input @error('is_main') is-invalid @enderror" id="is_main"
                                    name="is_main" value="1"
                                    {{ old('is_main') == '1' || $category->is_main === 1 ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_main">{{ __('Main category') }}</label>
                            </div>

                            @error('is_main')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                    class="custom-control-input @error('status') is-invalid @enderror" id="status"
                                    name="status" value="1"
                                    {{ old('status') == '1' || $category->status === 1 ? 'checked' : '' }}>
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
    @endpush

</x-admin.app-layout>
