@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Create brand') }}</h1>
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
                        <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div>
                                    <label for="name">
                                        {{ __('Name') }}
                                        <span class="required text-danger">*</span>
                                    </label>
                                </div>

                                <div class="lang-group">
                                    <input type="text" id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                           required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
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
                                           class="custom-control-input @error('status') is-invalid @enderror" id="status"
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

@endsection
