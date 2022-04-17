<x-admin.app-layout>
    <x-slot name="header">
        {{ __('Contact settings') }}
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
                    <form action="{{ route('admin.settings.contact.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="email">
                                {{ __('Email') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <input
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('email')
                                ])
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $contactSettings->email) }}"
                                required
                            />

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="phone_number">
                                    {{ __('Phone number') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('phone_number')
                                    ])
                                    type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    value="{{ old('phone_number', $contactSettings->phone_number) }}"
                                    required
                                />

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="business_number">
                                    {{ __('Business number') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('business_number')
                                    ])
                                    type="text"
                                    name="business_number"
                                    id="business_number"
                                    value="{{ old('business_number', $contactSettings->business_number) }}"
                                    required
                                />

                                @error('business_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="working_time_start">
                                    {{ __('Working time start') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('working_time_start')
                                    ])
                                    type="time"
                                    name="working_time_start"
                                    id="working_time_start"
                                    value="{{ old('working_time_start', $contactSettings->working_time_start) }}"
                                    required
                                />

                                @error('working_time_start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="working_time_end">
                                    {{ __('Working time end') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('working_time_end')
                                    ])
                                    type="time"
                                    name="working_time_end"
                                    id="working_time_end"
                                    value="{{ old('working_time_end', $contactSettings->working_time_end) }}"
                                    required
                                />

                                @error('working_time_end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="about_us_tk">
                                {{ __('About us TK') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <textarea
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('about_us_tk')
                                ])
                                name="about_us_tk"
                                id="about_us_tk"
                                required
                            >{{ old('about_us_tk', $contactSettings->about_us_tk) }}</textarea>

                            @error('about_us_tk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="about_us_en">
                                {{ __('About us EN') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <textarea
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('about_us_en')
                                ])
                                name="about_us_en"
                                id="about_us_en"
                                required
                            >{{ old('about_us_en', $contactSettings->about_us_en) }}</textarea>

                            @error('about_us_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="about_us_ru">
                                {{ __('About us RU') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <textarea
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('about_us_ru')
                                ])
                                name="about_us_ru"
                                id="about_us_ru"
                                required
                            >{{ old('about_us_ru', $contactSettings->about_us_ru) }}</textarea>

                            @error('about_us_ru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="business_address_tk">
                                {{ __('Business address TK') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <textarea
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('business_address_tk')
                                ])
                                name="business_address_tk"
                                id="business_address_tk"
                                required
                            >{{ old('business_address_tk', $contactSettings->business_address_tk) }}</textarea>

                            @error('business_address_tk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="business_address_en">
                                {{ __('Business address EN') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <textarea
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('business_address_en')
                                ])
                                name="business_address_en"
                                id="business_address_en"
                                required
                            >{{ old('business_address_en', $contactSettings->business_address_en) }}</textarea>

                            @error('business_address_en')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="business_address_ru">
                                {{ __('Business address RU') }}
                                <span class="required text-danger">*</span>
                            </label>
                            <textarea
                                @class([
                                    "form-control",
                                    "is-invalid" => $errors->has('business_address_ru')
                                ])
                                name="business_address_ru"
                                id="business_address_ru"
                                required
                            >{{ old('business_address_ru', $contactSettings->business_address_ru) }}</textarea>

                            @error('business_address_ru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <i class="fa fa-save fa-fw"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.app-layout>
