@extends('layouts.app')

@section('title', 'Рейтинг абитуриентов')

@section('content')
    <div class="row">

        <div class="col-12">
            <h2 class="fw-bold pt-4 pb-3 pb-lg-5 ps-2 ps-lg-0">Рейтинг абитуриентов</h2>
            <div class="col-lg-7 d-flex justify-content-start align-items-start mb-4">
                <div class="col-sm-1 d-flex justify-content-center">
                    @include('icons.other.info-circle-fill')
                </div>
                <div class="col-sm-11 ms-2 ms-lg-0 ">
                    <p class="fw-bold mt-1">Что влияет на&nbsp;рейтинг?</p>
                    <ol class="ps-3">
                        <li>Средний балл документа об&nbsp;образовании</li>
                        <li>Оригинал документа (выс) или копия (низ)</li>
                        <li>Тестирование</li>
                    </ol>
                    <span><strong>Наивысший</strong> приоритет имеет абитуриент, <strong>причастный к&nbsp;СВО</strong> (помечен цветом).</span>
                </div>
            </div>
        </div>

        {{--<div class="col-12">
            @include('session-message')
        </div>--}}

        <div class="col-lg-auto rounded-2 custom-st-search-filter ms-lg-2">
            <form action="{{ route('reporting.rating.generate') }}"
                  method="get"
                  class="row d-lg-flex justify-content-lg-start align-items-lg-end p-2 pb-lg-3">
                <div class="col-lg-auto">
                    <label for="faculty-id-1" class="form-label fw-bold">Выберите специальность из списка ниже:</label>
                    <select id="faculty-id-1" class="form-select custom-fn-faculty-select" name="faculty_id" required>
                        <option value="">Выберите...</option>
                        @if(isset($faculties))
                            @foreach($faculties as $item)
                                <option value="{{ $item->id }}"
                                        @if(request()->input('faculty_id') == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="d-grid gap-2 d-lg-block col-lg-2 my-4 my-lg-0 text-center">
                    <button class="btn btn-success" type="submit" style="min-width: 105px">Поиск</button>
                </div>
                @if(Auth::check() && isset($students) && $students->isNotEmpty())
                    <div class="d-grid gap-2 d-lg-block col-lg-2 mb-4 mb-lg-0 text-center">
                        <a class="btn btn-primary"
                           href="{{ route('reporting.rating.export-list', request()->input('faculty_id')) }}"
                           role="button"
                           style="min-width: 105px">Скачать</a>
                    </div>
                @endif
            </form>
        </div>

        @if(isset($students))
            <div class="col-12 d-flex justify-content-center my-3 my-lg-4">
                <span>Найдено записей: {{ $students->total() }}</span>
            </div>

            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">№</th>
                        <th scope="col" class="text-center">Фамилия</th>
                        <th scope="col" class="text-center">Имя</th>
                        <th scope="col" class="text-center">Отчество</th>
                        <th scope="col" class="text-center">Ср.балл</th>
                        <th scope="col" class="text-center">Тест</th>
                        <th scope="col" class="text-center">Документы</th>
                        <th scope="col" class="text-center">Финансирование</th>
                        @if(Auth::check())
                            <th scope="col" class="text-center">Управление</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($students as $student)
                        <tr @if($student->special_circumstance) class="table-warning" @endif>
                            <th scope="row"
                                class="text-center align-center">
                                {{ ($students->perPage() * ($students->currentPage() - 1)) + $loop->iteration }}
                            </th>
                            <td class="text-center align-center">{{ $student->surname }}</td>
                            <td class="text-center align-center">{{ $student->name }}</td>
                            <td class="text-center align-center">{{ $student->patronymic }}</td>
                            <td class="text-center align-center">{{ $student->avg_rating }}</td>
                            <td class="text-center align-center">{!! $student->testing ?? '&mdash;' !!}</td>
                            <td class="text-center align-center">{{ $student->is_original_docs ? 'Оригиналы' : 'Копии' }}</td>
                            <td class="text-center align-center" style="min-width: 150px">{{ $student->financing_type }}</td>
                            @if(Auth::check())
                                <td class="text-center align-center">@include('buttons.button-group-6')</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::check() ? 9 : 8 }}" class="text-center">Ничего не найдено</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="col-12 my-3">
                {{ $students->links() }}
            </div>
        @endif
    </div>
@endsection
