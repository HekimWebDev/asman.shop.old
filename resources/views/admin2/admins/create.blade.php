<x-admin.app-layout>

    <x-slot name="header">
        {{ __('Create admin') }}
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
                    <form method="POST" action="{{ route('admin.admins.store') }}">
                        @csrf

                        <div class="form-group">
                            <div>
                                <label for="first_name">
                                    {{ __('First name') }}
                                    <span class="required text-danger">*</span>
                                </label>
                            </div>

                            <input type="text" id="first_name" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}" required>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="last_name">
                                    {{ __('Last name') }}
                                    <span class="required text-danger">*</span>
                                </label>
                            </div>

                            <input type="text" id="last_name" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}" required>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="email">
                                    {{ __('Email') }}
                                    <span class="required text-danger">*</span>
                                </label>
                            </div>

                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="password">
                                    {{ __('Password') }}
                                    <span class="required text-danger">*</span>
                                </label>
                            </div>

                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="password_confirmation">
                                    {{ __('Password confirmation') }}
                                    <span class="required text-danger">*</span>
                                </label>
                            </div>

                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" required>

                            @error('password_confirmation')
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

</x-admin.app-layout>
