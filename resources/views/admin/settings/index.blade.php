@extends('layouts.admin', ['pages_title' => 'Setting'])

@section('content')
    <div class="flex items-center -mx-6 mb-6">
        <div class="px-6 flex-1">
            <h1 class="font-bold font-slab text-3xl">Setting</h1>
        </div>
        <form action="{{ route('admin.settings.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="ads_per_user">Max products for shop</label>
                        <input id="ads_per_user" type="number" name="ads_per_user"
                               class="form-control{{ $errors->has('ads_per_user') ? ' is-invalid' : '' }}"
                               value="{{ old('ads_per_user') ?? $setting->ads_per_user }}" required>
                        @if($errors->has('ads_per_user'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('ads_per_user') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input id="facebook" type="text" name="facebook"
                               class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                               value="{{ old('facebook') ?? $setting->facebook }}">
                        @if($errors->has('facebook'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="youtube">Youtube</label>
                        <input id="youtube" type="text" name="youtube"
                               class="form-control{{ $errors->has('youtube') ? ' is-invalid' : '' }}"
                               value="{{ old('youtube') ?? $setting->youtube }}">
                        @if($errors->has('youtube'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input id="instagram" type="text" name="instagram"
                               class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}"
                               value="{{ old('instagram') ?? $setting->instagram }}">
                        @if($errors->has('instagram'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('instagram') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="pinterest">Pinterest</label>
                        <input id="pinterest" type="text" name="pinterest"
                               class="form-control{{ $errors->has('pinterest') ? ' is-invalid' : '' }}"
                               value="{{ old('pinterest') ?? $setting->pinterest }}">
                        @if($errors->has('pinterest'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('pinterest') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               value="{{ old('email') ?? $setting->email }}">
                        @if($errors->has('email'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp</label>
                        <input id="whatsapp" type="text" name="whatsapp"
                               class="form-control{{ $errors->has('whatsapp') ? ' is-invalid' : '' }}"
                               value="{{ old('whatsapp') ?? $setting->whatsapp }}">
                        @if($errors->has('whatsapp'))
                            <div class="mt-1 text-danger">
                                {{ $errors->first('whatsapp') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

@endsection