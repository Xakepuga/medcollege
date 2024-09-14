@extends('layouts.app')

@section('title', 'Просмотр списков абитуриентов')

@section('content')
    <div class="row">

        <div class="col-12">
            <h2 class="fw-bold pt-4 pb-3 pb-lg-5 ps-2 ps-lg-0">Просмотр списков абитуриентов</h2>
        </div>

        <div class="col-12">
            @include('session-message')
        </div>

        <div class="col-12 rounded-2 custom-st-search-filter ms-lg-2">
            <form action="{{ route('students-lists.search') }}"
                  method="get"
                  class="row p-2 pb-lg-3">
                @include('lists.view-lists.filter')
            </form>
        </div>

        <div class="col-12 d-flex justify-content-center my-4">
            <span>Найдено записей: {{ $students->total() }}</span>
        </div>

        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr class="custom-results-table-bg-color">
                    <th scope="col" class="col-1 text-center">Дело,&nbsp;№</th>
                    <th scope="col" class="col-2 text-center">Фамилия</th>
                    <th scope="col" class="col-2 text-center">Имя</th>
                    <th scope="col" class="col-2 text-center">Отчество</th>
                    <th scope="col" class="col-3 text-center">Специальность</th>
                    <th scope="col" class="col-2 text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($students))
                    @forelse ($students as $student)
                        <tr>
                            <th scope="row" class="text-center">{{ $student->id }}</th>
                            <td class="text-center text-truncate">{{ $student->surname }}</td>
                            <td class="text-center text-truncate">{{ $student->name }}</td>
                            <td class="text-center text-truncate"
                                style="max-width: 200px">{{ $student->patronymic }}</td>
                            <td class="text-start text-truncate" style="max-width: 400px">{{ $student->faculty }}</td>
                            <td class="text-center" style="min-width: 135px;">@include('buttons.button-group-1')</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Ничего не найдено</td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>
        </div>

        @if(isset($students))
            <div class="col-12 my-3">
                {{ $students->links() }}
            </div>
        @endif
    </div>
@endsection
