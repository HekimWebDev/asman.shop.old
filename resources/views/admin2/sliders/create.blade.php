<x-admin.app-layout>

    @push('styles')
        <script src="{{ asset('admin/vendor/ckeditor/ckeditor.js') }}"></script>
    @endpush

    <x-slot name="header">
        {{ __('Create slider') }}
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
                    <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image-tk">
                                {{ __('Image Tk') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image-tk') is-invalid @enderror"
                                    id="image-tk" name="image:tk" required>
                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                            </div>

                            @error('image-tk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image-en">
                                {{ __('Image En') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image-en') is-invalid @enderror"
                                    id="image-en" name="image:en" required>
                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                            </div>

                            @error('image-en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image-ru">
                                {{ __('Image Ru') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image-ru') is-invalid @enderror"
                                    id="image-ru" name="image:ru" required>
                                <label class="custom-file-label" for="image">{{ __('Choose file') }}</label>
                            </div>

                            @error('image-ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="link">
                                    {{ __('Link') }}
                                </label>
                            </div>

                            <div class="lang-group">
                                <input type="text" id="link" name="link"
                                    class="form-control @error('link') is-invalid @enderror"
                                    value="{{ old('link') }}">

                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
    @endpush

</x-admin.app-layout>
