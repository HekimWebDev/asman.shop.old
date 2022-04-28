@extends('admin.layouts.app')

@push('styles')
    <script src="{{ asset('/assets/lib/ckeditor/ckeditor.js') }}"></script>
@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Create category') }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

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
                        <form method="POST" action="{{ route('admin.categories.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="parent_id">
                                    {{ __('Parent category') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select
                                    class="form-control border selectpicker show-tick @error('parent_id') is-invalid @enderror"
                                    name="parent_id" id="parent_id" data-live-search="true" data-style="btn-white"
                                    title="{{ __('Select category') }}" required>
                                    <option value="0" {{ old('parent_id') === 'null' ? 'selected' : '' }}>
                                        {{ __('Root') }}
                                    </option>
                                    @include('admin2.components.category', ['childs' => $categories, 'spaces' => 0])
                                </select>

                                @error('parent_id')
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
                                    </label>
                                    @include('admin2.components.form-lang')
                                </div>

                                <div class="lang-group">
                                    @foreach (config('lang.locales') as $key => $locale)
                                        <div style="display: none;" input-lang="{{ $key }}">
                                            <textarea id="description" name="description:{{ $key }}"
                                                      class="ckeditor form-control @error('description:'.$key) is-invalid @enderror">
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
                                           id="image" name="image" value="{{ old('image') ?? '' }}" required>
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
                                           class="custom-control-input @error('status') is-invalid @enderror"
                                           id="status"
                                           name="status" value="1" {{ old('status') === '1' ? 'checked' : '' }}>
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

    </section>

    @push('scripts')
        <script src="{{ asset('js/form-lang.js') }}"></script>
        <script src="{{ asset('assets/lib/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script>
            $(function () {
                bsCustomFileInput.init();
            });
        </script>
    @endpush

@endsection
