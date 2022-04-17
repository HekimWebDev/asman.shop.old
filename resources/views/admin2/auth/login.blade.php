<x-admin.guest-layout>

    <x-slot name="header">
        {{ __('Login') }}
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="p-5">
                        <div class="text-center">
                            <img class="img-fluid w-50" src="{{ asset('images/logo.png') }}">
                            <h4 class="text-gray-900 my-3">
                                "Ýakyndar" onlaýn söwda platformasyna hoş
                                geldiňiz.
                            </h4>
                        </div>
                        <form class="user" method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                    placeholder="Enter Email Address..." required autocomplete="email" autofocus
                                    value="{{ old('email') }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="exampleInputPassword" placeholder="Password" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="customCheck"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck">{{ __('Remember Me')
                                        }}</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                {{ __('Login') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin.guest-layout>
