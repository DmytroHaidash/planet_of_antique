@extends('layouts.auth')

@section('content')
    <section class="my-12 w-full max-w-md">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <input id="name"
                       type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       placeholder="{{ __('Name') }}">

                @error('name')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <input id="email"
                       type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autocomplete="email"
                       autofocus
                       placeholder="{{ __('auth.email') }}">

                @error('email')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <input id="password"
                       type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="{{ __('auth.password') }}">

                @error('password')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <input id="password-confirm"
                       type="password"
                       class="form-control"
                       name="password_confirmation"
                       required
                       placeholder="{{ __('Confirm Password') }}">
            </div>
            <div class="form-group">
                <div class="variants">
                    @foreach(['buyer', 'seller'] as $role)
                        <div class="w-1/2">
                            <input type="radio" name="role" id="role-{{ $role }}" class="invisible"
                                   value="{{ $role }}" {{$loop->first ? 'checked' : ''}} onclick="rolesInput()">
                            <label for="role-{{ $role }}" class="text-center">
                                {{ $role }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="hidden" id="for-shop">
                <div class="mt-4 mb-4">
                    <input id="shop_name"
                           type="text"
                           class="form-control @error('shop_name') is-invalid @enderror"
                           name="title[{{app()->getLocale()}}]"
                           value="{{ old('title') }}"
                           placeholder="{{ __('Shop name') }}">

                    @error('shop_name')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mt-3 flex justify-center">
                <button type="submit" class="button button--primary ">
                    {{ __('auth.register') }}
                </button>
            </div>
        </form>
        <hr class="border-0 border-b-2 my-6">

        <div class="text-center text-gray-600">
            <p><a href="{{ route('login') }}" class="button button--gray">{{ __('Login') }}</a></p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
      function rolesInput() {
        const shop = document.querySelector('#for-shop');
        if (event.target.value === 'seller') {
          shop.classList.remove('hidden')
        } else {
          shop.classList.add('hidden')
        }
      }
    </script>
@endpush
