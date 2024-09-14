@extends('layouts.app')

@section('title')
    @if(request()->routeIs('admin.manage.users.create'))
        Добавление нового пользователя
    @elseif(request()->routeIs('admin.manage.users.user.show'))
        Просмотр профиля пользователя
    @else
        Редактирование профиля пользователя
    @endif
@endsection

@section('content')
    <a href="{{ route('admin.manage.users.index') }}"
       class="text-decoration-none">@include('icons.other.arrow-left-circle')К списку пользователей</a>

    <h2 class="fw-bold py-5">
        @if(request()->routeIs('admin.manage.users.create'))
            Добавление нового пользователя
        @elseif(request()->routeIs('admin.manage.users.user.show'))
            Просмотр профиля пользователя
        @else
            Редактирование профиля пользователя
        @endif
    </h2>

    <div class="mb-3">
        @include('session-message')
    </div>

    <form action="{{ isset($user->id) ? route('admin.manage.users.user.update', $user->id) : route('register') }}"
          method="post"
          class="row col-7 border border-3 rounded gy-3 mb-5 pt-2 pb-3 px-3">
        @csrf

        @if(!request()->routeIs('admin.manage.users.create'))
            <div class="d-flex justify-content-end align-items-center mt-2">@include('buttons.button-group-5')</div>
        @endif

        <div class="w-100 m-1"></div>

        {{-- NAME / SURNAME --}}
        <fieldset class="row m-0 p-0">
            <legend></legend>
            <div class="col my-2">
                <label for="surname-1" class="form-label">Фамилия<span class="custom-st-required-field">*</span></label>
                <input id="surname-1"
                       class="form-control custom-fn-capslock @error('surname') is-invalid @enderror"
                       name="surname"
                       value="{{ old('surname') ?? $user->surname ?? '' }}"
                       type="text"
                       required
                       aria-describedby="surname-1-validation">
                @error('surname')
                <div id="surname-1-validation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col my-2">
                <label for="name-1" class="form-label">Имя<span class="custom-st-required-field">*</span></label>
                <input id="name-1"
                       class="form-control custom-fn-capslock @error('name') is-invalid @enderror"
                       name="name"
                       value="{{ old('name') ?? $user->name ?? '' }}"
                       type="text"
                       required
                       aria-describedby="name-1-validation">
                @error('name')
                <div id="name-1-validation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </fieldset>

        <div class="w-100 m-1"></div>

        {{-- EMAIL / ADMIN --}}
        <fieldset class="row m-0 p-0">
            <legend></legend>
            <div class="col my-2">
                <label for="email-1" class="form-label">Электронная почта<span
                        class="custom-st-required-field">*</span></label>
                <input id="email-1"
                       class="form-control custom-fn-capslock @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') ?? $user->email ?? '' }}"
                       type="email"
                       required
                       aria-describedby="email-1-validation">
                @error('email')
                <div id="email-1-validation" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col my-2" disabled>
                <p>Администратор?</p>
                <div class="form-check form-check-inline">
                    <input id="is-admin-false"
                           class="form-check-input custom-st-fix-circle"
                           name="isAdmin"
                           value="0"
                           type="radio"
                           checked
                           @if(isset($user->email) && Auth::user()->email === $user->email) disabled @endif>
                    <label for="is-admin-false" class="form-check-label">Нет</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="is-admin-true"
                           class="form-check-input custom-st-fix-circle"
                           name="isAdmin"
                           value="1"
                           type="radio"
                           @if(old('isAdmin') === '1' || (isset($user) && ($user->is_admin) === true)) checked @endif
                           @if(isset($user->email) && Auth::user()->email === $user->email) disabled @endif>
                    <label for="is-admin-true" class="form-check-label">Да</label>
                </div>
            </div>
        </fieldset>

        <div class="w-100 m-1"></div>

        @if(!request()->routeIs('admin.manage.users.user.show'))
            {{-- PASSWORD / PASSWORD CONFIRM --}}
            <fieldset class="row m-0 p-0">
                <legend></legend>
                <div class="col my-2">
                    @if(request()->routeIs('admin.manage.users.user.edit'))
                        <label for="password" class="form-label">Новый пароль (необязательно)</label>
                    @else
                        <label for="password" class="form-label">Пароль<span
                                class="custom-st-required-field">*</span></label>
                    @endif
                    <input id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           type="password"
                           @if(request()->routeIs('admin.manage.users.create')) required @endif
                           aria-describedby="password-1-validation">
                    @error('password')
                    <div id="password-1-validation" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col my-2">
                    @if(request()->routeIs('admin.manage.users.user.edit'))
                        <label for="password-confirm" class="form-label">Подтверждение нового пароля</label>
                    @else
                        <label for="password-confirm" class="form-label">Подтверждение пароля<span
                                class="custom-st-required-field">*</span></label>
                    @endif
                    <input id="password-confirm"
                           class="form-control"
                           name="password_confirmation"
                           type="password"
                           @if(request()->routeIs('admin.manage.users.create')) required @endif>
                </div>
            </fieldset>

            <div class="w-100 m-1"></div>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success px-4">
                    {{ isset($user->id) ? __('Обновить') : __('Сохранить') }}
                </button>
            </div>
        @endif
    </form>
@endsection
