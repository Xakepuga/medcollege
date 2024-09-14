@extends('layouts.app')

@section('title', 'Управление зачислением')

@section('content')
    <div class="row">

        <div class="row col-12">
            <h2 class="fw-bold pt-4 pb-3 pb-lg-5 ps-2 ps-lg-0">Управление зачислением</h2>
            <div class="col-7 d-flex justify-content-start align-items-center mb-4">
                <div class="col-1 d-flex justify-content-center">
                    @include('icons.other.info-circle-fill')
                </div>
                <div class="col-11 ms-2">
                    <span>В&nbsp;данном разделе отображаются лишь те&nbsp;абитуриенты, у&nbsp;которых на&nbsp;выбранную специальность
                        поданы <strong>оригиналы</strong> документов.
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12">
            @include('session-message')
        </div>

        <div class="col-lg-7 rounded-2 custom-st-search-filter ms-lg-2">
            <form action="{{ route('students-lists.manage.enrollment.search') }}"
                  method="get"
                  class="row d-lg-flex justify-content-lg-start align-items-lg-end p-2 pb-lg-3">
                <div class="col-lg-10">
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
                <div class="d-grid gap-2 d-lg-block col-lg-2 my-4 my-lg-0">
                    <button class="btn btn-success px-3" type="submit">Поиск</button>
                </div>
            </form>
        </div>

        @if(isset($students))
            <div class="col-12 d-flex justify-content-center my-3 my-lg-4">
                <span>Найдено записей: {{ $students->total() }}</span>
            </div>

            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                    <tr class="custom-results-table-bg-color">
                        <th scope="col" class="col-1 text-center">Дело,&nbsp;№</th>
                        <th scope="col" class="col-2 text-center">Фамилия</th>
                        <th scope="col" class="col-2 text-center">Имя</th>
                        <th scope="col" class="col-2 text-center">Отчество</th>
                        <th scope="col" class="col-2 text-center">Приказ</th>
                        <th scope="col" class="col-1 text-center">Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($students as $student)
                        <tr class="custom-fn-toggle-row-color {{ $student->decree ? 'table-success' : 'table-danger' }}">
                            <th scope="row" class="text-center align-middle">{{ $student->id }}</th>
                            <td class="text-center text-truncate align-middle">{{ $student->surname }}</td>
                            <td class="text-center text-truncate align-middle">{{ $student->name }}</td>
                            <td class="text-center text-truncate align-middle">{{ $student->patronymic }}</td>
                            <td class="text-center">
                                <select class="form-select custom-fn-decree-select" name="decree"
                                        data-student-id="{{ $student->id }}">
                                    <option value="">Не зачислен</option>
                                    @foreach($decrees as $item)
                                        <option value="{{ $item->id }}"
                                                @if($student->decree == $item->id) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center align-middle">@include('buttons.button-group-6')</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Ничего не найдено</td>
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
