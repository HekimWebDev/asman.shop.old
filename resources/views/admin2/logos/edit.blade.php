<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Logo') }}
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
                    <form method="POST" action="{{ route('admin.logos.update', $logo->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <div class="card border-light h-100">
                                    <div class="card-header">
                                        {{ __('Current logo') }}
                                    </div>
                                    <div class="card-body text-center">
                                        @include('admin2.components.image', ['image' => $logo->logo])
                                    </div>
                                    <div class="card-footer">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('logo') is-invalid @enderror" id="logo"
                                                name="logo" value="{{ old('logo') }}">
                                            <label class="custom-file-label" for="logo">{{ __('Choose file') }}</label>
                                        </div>

                                        @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <div class="card border-light h-100">
                                    <div class="card-header">
                                        {{ __('Current small logo') }}
                                    </div>
                                    <div class="card-body text-center">
                                        @include('admin2.components.image', ['image' => $logo->small_logo])
                                    </div>
                                    <div class="card-footer">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('small_logo') is-invalid @enderror"
                                                id="small_logo" name="small_logo" value="{{ old('small_logo') }}">
                                            <label class="custom-file-label"
                                                for="small_logo">{{ __('Choose file') }}</label>
                                        </div>

                                        @error('small_logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-3">
                                <div class="card border-light h-100">
                                    <div class="card-header">
                                        {{ __('Current favicon') }}
                                    </div>
                                    <div class="card-body text-center">
                                        <img class="img-fluid" src="{{ asset($logo->favicon) }}" alt="">
                                    </div>
                                    <div class="card-footer">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('favicon') is-invalid @enderror"
                                                id="favicon" name="favicon" value="{{ old('favicon') }}">
                                            <label class="custom-file-label"
                                                for="favicon">{{ __('Choose file') }}</label>
                                        </div>

                                        @error('favicon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-fw fa-pen"></i> {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin.app-layout>
