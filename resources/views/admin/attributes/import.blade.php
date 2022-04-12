<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Import attributes') }}
    </x-slot>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif --}}
                    <form method="POST" action="{{ route('admin.attributes.import.post') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="file">
                                {{ __('Excel file') }}
                                <span class="required text-danger">*</span>
                            </label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('file') is-invalid @enderror"
                                    id="file" name="file" value="{{ old('file') ?? '' }}" required>
                                <label class="custom-file-label" for="file">{{ __('Choose file') }}</label>
                            </div>

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-sm float-right">
                                <i class="fa fa-fw fa-file-upload"></i> {{ __('Upload') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin.app-layout>
