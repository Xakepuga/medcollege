@extends('layouts.app')

@section('title', 'Поиск анкеты')

@section('content')
    <h2 class="fw-bold pt-4 pb-5">Поиск анкеты</h2>
    @include('session-message')
    <label for="query-1" class="form-label mb-4">Введите серию и номер паспорта либо фамилию абитуриента</label>
    <form action="{{ route('personal-files.manage.personal-file.search') }}" method="get">
        <div class="d-flex align-items-end">
            <div class="col-3 me-4">
                <input id="query-1"
                       class="form-control"
                       name="query"
                       value="{{ old('query') ?? request()->input('query') ?? '' }}"
                       type="search"
                       required
                       placeholder="Что ищем?">
            </div>
            <button type="submit" class="btn btn-success col-1">Поиск</button>
        </div>
        @if(isset($students))
            <table class="table table-bordered table-striped mt-5">
                <thead>
                <tr class="custom-results-table-bg-color">
                    <th scope="col" class="col-1 text-center">№</th>
                    <th scope="col" class="col-3 text-center">Фамилия</th>
                    <th scope="col" class="col-3 text-center">Имя</th>
                    <th scope="col" class="col-3 text-center">Отчество</th>
                    <th scope="col" class="col-2 text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as $student)
                    <tr>
                        <th scope="row" class="text-center">{{ $student->id }}</th>
                        <td class="text-center">{{ $student->surname }}</td>
                        <td class="text-center">{{ $student->name }}</td>
                        <td class="text-center">{{ $student->patronymic }}</td>
                        <td class="text-center">@include('buttons.button-group-1')</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Ничего не найдено</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        @endif
    </form>
@endsection
