<x-admin.app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('admin/vendor/tagsinput/bootstrap-tagsinput.css') }}">
        <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Create blog post') }}
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
                    <form method="POST" action="{{ route('admin.blog.posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="blog_category_id">
                                {{ __('Blog category') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select
                                class="form-control border selectpicker show-tick @error('blog_category_id.*') is-invalid @enderror"
                                name="blog_category_id" id="blog_category_id" data-live-search="true"
                                data-style="btn-white" title="{{ __('Select blog category') }}" required>
                                @foreach ($blogCategories as $blogCategory)
                                    <option value="{{ $blogCategory->id }}">
                                        {{ $blogCategory->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>

                            @error('blog_category_id')
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
                                        input-lang="{{ $key }}" value="{{ old('name:' . $key) }}" required>

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
                                    <span class="required text-danger">*</span>
                                </label>
                                @include('admin2.components.form-lang')
                            </div>

                            <div class="lang-group">
                                @foreach (config('lang.locales') as $key => $locale)
                                    <div style="display: none;" input-lang="{{ $key }}">
                                        <textarea id="description" name="description:{{ $key }}"
                                            class="ckeditor form-control @error('description:' . $key) is-invalid @enderror"
                                            required>
                                        {{ old('description:' . $key) ?? '' }}
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
                            <label for="" class="d-block">
                                {{ __('Tags') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <select name="tags[]" multiple data-role="tagsinput" required></select>
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
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                    class="custom-control-input @error('status') is-invalid @enderror" id="status"
                                    name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">{{ __('Status') }}</label>
                            </div>

                            @error('status')
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
        <script src="{{ asset('admin/vendor/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    @endpush

</x-admin.app-layout>
