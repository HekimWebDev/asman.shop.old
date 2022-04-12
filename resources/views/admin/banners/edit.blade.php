<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Banner') }}
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
                    <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card border-light h-100">
                            <div class="card-header">
                                {{ __('Current banner') }}
                            </div>
                            <div class="card-body text-center mx-auto w-25">
                                @include('admin.components.image', ['image' => $banner->image ?? ''])
                            </div>
                            <div class="card-footer">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('banner') is-invalid @enderror"
                                        id="banner" name="banner" value="{{ old('banner') }}" required>
                                    <label class="custom-file-label" for="banner">{{ __('Choose file') }}</label>
                                </div>

                                @error('banner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
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
