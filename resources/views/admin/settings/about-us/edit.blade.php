<x-admin.app-layout>
    <x-slot name="header">
        {{ __('About us settings') }}
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
                    <form action="{{ route('admin.settings.about_us.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="title[tk]">
                                    {{ __('Title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('title[tk]')
                                    ])
                                    type="text"
                                    name="title[tk]"
                                    id="title"
                                    value="{{ old('title[tk]', $aboutUsSettings->title['tk']) }}"
                                    required
                                />

                                @error('title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="title[en]">
                                    {{ __('Title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('title[en]')
                                    ])
                                    type="text"
                                    name="title[en]"
                                    id="title"
                                    value="{{ old('title[en]', $aboutUsSettings->title['en']) }}"
                                    required
                                />

                                @error('title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="title[ru]">
                                    {{ __('Title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('title[ru]')
                                    ])
                                    type="text"
                                    name="title[ru]"
                                    id="title"
                                    value="{{ old('title[ru]', $aboutUsSettings->title['ru']) }}"
                                    required
                                />

                                @error('title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="description[tk]">
                                    {{ __('Description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('description[tk]')
                                    ])
                                    name="description[tk]"
                                    id="description[tk]"
                                    required
                                >{{ old('description[tk]', $aboutUsSettings->description['tk']) }}</textarea>

                                @error('description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="description[en]">
                                    {{ __('Description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('description[en]')
                                    ])
                                    name="description[en]"
                                    id="description[en]"
                                    required
                                >{{ old('description[en]', $aboutUsSettings->description['en']) }}</textarea>

                                @error('description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="description[ru]">
                                    {{ __('Description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('description[ru]')
                                    ])
                                    name="description[ru]"
                                    id="description[ru]"
                                    required
                                >{{ old('description[ru]', $aboutUsSettings->description['ru']) }}</textarea>

                                @error('description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_1_title[tk]">
                                    {{ __('Feature 1 title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_1_title[tk]')
                                    ])
                                    type="text"
                                    name="feature_1_title[tk]"
                                    id="title"
                                    value="{{ old('feature_1_title[tk]', $aboutUsSettings->feature_1_title['tk']) }}"
                                    required
                                />

                                @error('feature_1_title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_1_title[en]">
                                    {{ __('Feature 1 title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_1_title[en]')
                                    ])
                                    type="text"
                                    name="feature_1_title[en]"
                                    id="title"
                                    value="{{ old('feature_1_title[en]', $aboutUsSettings->feature_1_title['en']) }}"
                                    required
                                />

                                @error('feature_1_title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_1_title[ru]">
                                    {{ __('Feature 1 title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_1_title[ru]')
                                    ])
                                    type="text"
                                    name="feature_1_title[ru]"
                                    id="title"
                                    value="{{ old('feature_1_title[ru]', $aboutUsSettings->feature_1_title['ru']) }}"
                                    required
                                />

                                @error('feature_1_title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_1_description[tk]">
                                    {{ __('Feature 1 description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_1_description[tk]')
                                    ])
                                    name="feature_1_description[tk]"
                                    id="feature_1_description[tk]"
                                    required
                                >{{ old('feature_1_description[tk]', $aboutUsSettings->feature_1_description['tk']) }}</textarea>

                                @error('feature_1_description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_1_description[en]">
                                    {{ __('Feature 1 description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_1_description[en]')
                                    ])
                                    name="feature_1_description[en]"
                                    id="feature_1_description[en]"
                                    required
                                >{{ old('feature_1_description[en]', $aboutUsSettings->feature_1_description['en']) }}</textarea>

                                @error('feature_1_description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_1_description[ru]">
                                    {{ __('Feature 1 description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_1_description[ru]')
                                    ])
                                    name="feature_1_description[ru]"
                                    id="feature_1_description[ru]"
                                    required
                                >{{ old('feature_1_description[ru]', $aboutUsSettings->feature_1_description['ru']) }}</textarea>

                                @error('feature_1_description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_2_title[tk]">
                                    {{ __('Feature 2 title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_2_title[tk]')
                                    ])
                                    type="text"
                                    name="feature_2_title[tk]"
                                    id="title"
                                    value="{{ old('feature_2_title[tk]', $aboutUsSettings->feature_2_title['tk']) }}"
                                    required
                                />

                                @error('feature_2_title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_2_title[en]">
                                    {{ __('Feature 2 title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_2_title[en]')
                                    ])
                                    type="text"
                                    name="feature_2_title[en]"
                                    id="title"
                                    value="{{ old('feature_2_title[en]', $aboutUsSettings->feature_2_title['en']) }}"
                                    required
                                />

                                @error('feature_2_title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_2_title[ru]">
                                    {{ __('Feature 2 title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_2_title[ru]')
                                    ])
                                    type="text"
                                    name="feature_2_title[ru]"
                                    id="title"
                                    value="{{ old('feature_2_title[ru]', $aboutUsSettings->feature_2_title['ru']) }}"
                                    required
                                />

                                @error('feature_2_title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_2_description[tk]">
                                    {{ __('Feature 2 description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_2_description[tk]')
                                    ])
                                    name="feature_2_description[tk]"
                                    id="feature_2_description[tk]"
                                    required
                                >{{ old('feature_2_description[tk]', $aboutUsSettings->feature_2_description['tk']) }}</textarea>

                                @error('feature_2_description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_2_description[en]">
                                    {{ __('Feature 2 description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_2_description[en]')
                                    ])
                                    name="feature_2_description[en]"
                                    id="feature_2_description[en]"
                                    required
                                >{{ old('feature_2_description[en]', $aboutUsSettings->feature_2_description['en']) }}</textarea>

                                @error('feature_2_description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_2_description[ru]">
                                    {{ __('Feature 2 description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_2_description[ru]')
                                    ])
                                    name="feature_2_description[ru]"
                                    id="feature_2_description[ru]"
                                    required
                                >{{ old('feature_2_description[ru]', $aboutUsSettings->feature_2_description['ru']) }}</textarea>

                                @error('feature_2_description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_3_title[tk]">
                                    {{ __('Feature 3 title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_3_title[tk]')
                                    ])
                                    type="text"
                                    name="feature_3_title[tk]"
                                    id="title"
                                    value="{{ old('feature_3_title[tk]', $aboutUsSettings->feature_3_title['tk']) }}"
                                    required
                                />

                                @error('feature_3_title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_3_title[en]">
                                    {{ __('Feature 3 title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_3_title[en]')
                                    ])
                                    type="text"
                                    name="feature_3_title[en]"
                                    id="title"
                                    value="{{ old('feature_3_title[en]', $aboutUsSettings->feature_3_title['en']) }}"
                                    required
                                />

                                @error('feature_3_title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_3_title[ru]">
                                    {{ __('Feature 3 title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_3_title[ru]')
                                    ])
                                    type="text"
                                    name="feature_3_title[ru]"
                                    id="title"
                                    value="{{ old('feature_3_title[ru]', $aboutUsSettings->feature_3_title['ru']) }}"
                                    required
                                />

                                @error('feature_3_title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_3_description[tk]">
                                    {{ __('Feature 3 description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_3_description[tk]')
                                    ])
                                    name="feature_3_description[tk]"
                                    id="feature_3_description[tk]"
                                    required
                                >{{ old('feature_3_description[tk]', $aboutUsSettings->feature_3_description['tk']) }}</textarea>

                                @error('feature_3_description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                             <div class="form-group col-4">
                                <label for="feature_3_description[en]">
                                    {{ __('Feature 3 description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_3_description[en]')
                                    ])
                                    name="feature_3_description[en]"
                                    id="feature_3_description[en]"
                                    required
                                >{{ old('feature_3_description[en]', $aboutUsSettings->feature_3_description['en']) }}</textarea>

                                @error('feature_3_description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                           <div class="form-group col-4">
                                <label for="feature_3_description[ru]">
                                    {{ __('Feature 3 description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_3_description[ru]')
                                    ])
                                    name="feature_3_description[ru]"
                                    id="feature_3_description[ru]"
                                    required
                                >{{ old('feature_3_description[ru]', $aboutUsSettings->feature_3_description['ru']) }}</textarea>

                                @error('feature_3_description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_4_title[tk]">
                                    {{ __('Feature 4 title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_4_title[tk]')
                                    ])
                                    type="text"
                                    name="feature_4_title[tk]"
                                    id="title"
                                    value="{{ old('feature_4_title[tk]', $aboutUsSettings->feature_4_title['tk']) }}"
                                    required
                                />

                                @error('feature_4_title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_4_title[en]">
                                    {{ __('Feature 4 title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_4_title[en]')
                                    ])
                                    type="text"
                                    name="feature_4_title[en]"
                                    id="title"
                                    value="{{ old('feature_4_title[en]', $aboutUsSettings->feature_4_title['en']) }}"
                                    required
                                />

                                @error('feature_4_title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_4_title[ru]">
                                    {{ __('Feature 4 title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_4_title[ru]')
                                    ])
                                    type="text"
                                    name="feature_4_title[ru]"
                                    id="title"
                                    value="{{ old('feature_4_title[ru]', $aboutUsSettings->feature_4_title['ru']) }}"
                                    required
                                />

                                @error('feature_4_title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_4_description[tk]">
                                    {{ __('Feature 4 description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_4_description[tk]')
                                    ])
                                    name="feature_4_description[tk]"
                                    id="feature_4_description[tk]"
                                    required
                                >{{ old('feature_4_description[tk]', $aboutUsSettings->feature_4_description['tk']) }}</textarea>

                                @error('feature_4_description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_4_description[en]">
                                    {{ __('Feature 4 description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_4_description[en]')
                                    ])
                                    name="feature_4_description[en]"
                                    id="feature_4_description[en]"
                                    required
                                >{{ old('feature_4_description[en]', $aboutUsSettings->feature_4_description['en']) }}</textarea>

                                @error('feature_4_description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_4_description[ru]">
                                    {{ __('Feature 4 description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_4_description[ru]')
                                    ])
                                    name="feature_4_description[ru]"
                                    id="feature_4_description[ru]"
                                    required
                                >{{ old('feature_4_description[ru]', $aboutUsSettings->feature_4_description['ru']) }}</textarea>

                                @error('feature_4_description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_5_title[tk]">
                                    {{ __('Feature 5 title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_5_title[tk]')
                                    ])
                                    type="text"
                                    name="feature_5_title[tk]"
                                    id="title"
                                    value="{{ old('feature_5_title[tk]', $aboutUsSettings->feature_5_title['tk']) }}"
                                    required
                                />

                                @error('feature_5_title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_5_title[en]">
                                    {{ __('Feature 5 title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_5_title[en]')
                                    ])
                                    type="text"
                                    name="feature_5_title[en]"
                                    id="title"
                                    value="{{ old('feature_5_title[en]', $aboutUsSettings->feature_5_title['en']) }}"
                                    required
                                />

                                @error('feature_5_title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_5_title[ru]">
                                    {{ __('Feature 5 title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_5_title[ru]')
                                    ])
                                    type="text"
                                    name="feature_5_title[ru]"
                                    id="title"
                                    value="{{ old('feature_5_title[ru]', $aboutUsSettings->feature_5_title['ru']) }}"
                                    required
                                />

                                @error('feature_5_title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_5_description[tk]">
                                    {{ __('Feature 5 description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_5_description[tk]')
                                    ])
                                    name="feature_5_description[tk]"
                                    id="feature_5_description[tk]"
                                    required
                                >{{ old('feature_5_description[tk]', $aboutUsSettings->feature_5_description['tk']) }}</textarea>

                                @error('feature_5_description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_5_description[en]">
                                    {{ __('Feature 5 description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_5_description[en]')
                                    ])
                                    name="feature_5_description[en]"
                                    id="feature_5_description[en]"
                                    required
                                >{{ old('feature_5_description[en]', $aboutUsSettings->feature_5_description['en']) }}</textarea>

                                @error('feature_5_description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_5_description[ru]">
                                    {{ __('Feature 5 description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_5_description[ru]')
                                    ])
                                    name="feature_5_description[ru]"
                                    id="feature_5_description[ru]"
                                    required
                                >{{ old('feature_5_description[ru]', $aboutUsSettings->feature_5_description['ru']) }}</textarea>

                                @error('feature_5_description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr/>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_6_title[tk]">
                                    {{ __('Feature 6 title TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_6_title[tk]')
                                    ])
                                    type="text"
                                    name="feature_6_title[tk]"
                                    id="title"
                                    value="{{ old('feature_6_title[tk]', $aboutUsSettings->feature_6_title['tk']) }}"
                                    required
                                />

                                @error('feature_6_title[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_6_title[en]">
                                    {{ __('Feature 6 title EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_6_title[en]')
                                    ])
                                    type="text"
                                    name="feature_6_title[en]"
                                    id="title"
                                    value="{{ old('feature_6_title[en]', $aboutUsSettings->feature_6_title['en']) }}"
                                    required
                                />

                                @error('feature_6_title[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="feature_6_title[ru]">
                                    {{ __('Feature 6 title RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <input
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_6_title[ru]')
                                    ])
                                    type="text"
                                    name="feature_6_title[ru]"
                                    id="title"
                                    value="{{ old('feature_6_title[ru]', $aboutUsSettings->feature_6_title['ru']) }}"
                                    required
                                />

                                @error('feature_6_title[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="feature_6_description[tk]">
                                    {{ __('Feature 6 description TK') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_6_description[tk]')
                                    ])
                                    name="feature_6_description[tk]"
                                    id="feature_6_description[tk]"
                                    required
                                >{{ old('feature_6_description[tk]', $aboutUsSettings->feature_6_description['tk']) }}</textarea>

                                @error('feature_6_description[tk]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                             <div class="form-group col-4">
                                <label for="feature_6_description[en]">
                                    {{ __('Feature 6 description EN') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_6_description[en]')
                                    ])
                                    name="feature_6_description[en]"
                                    id="feature_6_description[en]"
                                    required
                                >{{ old('feature_6_description[en]', $aboutUsSettings->feature_6_description['en']) }}</textarea>

                                @error('feature_6_description[en]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                           <div class="form-group col-4">
                                <label for="feature_6_description[ru]">
                                    {{ __('Feature 6 description RU') }}
                                    <span class="required text-danger">*</span>
                                </label>
                                <textarea
                                    @class([
                                        "form-control",
                                        "is-invalid" => $errors->has('feature_6_description[ru]')
                                    ])
                                    name="feature_6_description[ru]"
                                    id="feature_6_description[ru]"
                                    required
                                >{{ old('feature_6_description[ru]', $aboutUsSettings->feature_6_description['ru']) }}</textarea>

                                @error('feature_6_description[ru]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
