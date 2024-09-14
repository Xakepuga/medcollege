@extends('layouts.app')

@section('title')
    @if(request()->routeIs('personal-files.create'))
        Создание личного дела
    @elseif(request()->routeIs('personal-files.manage.personal-file.show'))
        Просмотр личного дела
    @else
        Редактирование личного дела
    @endif
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold pt-4 pb-5">
            @if(request()->routeIs('personal-files.create'))
                Создание личного дела
            @elseif(request()->routeIs('personal-files.manage.personal-file.show'))
                Просмотр личного дела
            @else
                Редактирование личного дела
            @endif
        </h2>
        @if(!request()->routeIs('personal-files.create'))
            <div class="btn-group" role="group">
                @include('buttons.button-group-2')
            </div>
        @endif
    </div>

    <div class="d-none">
        @include('personal-files.form.blocks.faculty-block')
    </div>

    <div class="col-12">
        @if(!empty($errors->all()))
            <p class="alert alert-danger">{{ config('messages.personalFiles.validatorError') }}</p>
        @else
            @include('session-message')
        @endif
    </div>

    <form
        action="{{ isset($student->id) ? route('personal-files.manage.personal-file.update', $student->id) : route('personal-files.store') }}"
        method="post"
        class="custom-fn-form pb-5">
        @csrf
        @if(request()->routeIs('personal-files.manage.personal-file.update'))
            @method('put')
        @elseif(request()->routeIs('personal-files.manage.personal-file.destroy'))
            @method('delete')
        @endif

        @include('personal-files.form.blocks.index')

        @if(!request()->routeIs('personal-files.manage.personal-file.show'))
            <div class="d-flex justify-content-center mt-4">
                <button class="btn btn-success custom-st-form-button-size me-4" type="submit">
                    {{ isset($student->id) ? __('Обновить') : __('Сохранить') }}
                </button>

                @if(request()->routeIs('personal-files.create'))
                    <button class="btn btn-secondary custom-st-form-button-size custom-fn-reset-form" type="button">
                        Очистить форму
                    </button>
                @endif
            </div>
        @endif
    </form>
@endsection
