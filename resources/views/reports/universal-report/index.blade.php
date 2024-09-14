@extends('layouts.app')

@section('title', 'Универсальный отчёт')

@section('content')
    <div class="row">

        <div class="col-12">
            <h2 class="fw-bold pt-4 pb-3 pb-lg-5 ps-2 ps-lg-0">Универсальный отчёт</h2>
        </div>

        <div class="col-12">
            @include('session-message')
        </div>

        <div class="row">
            <div class="col-3">
                <form action="{{ route('reporting.universal-report.generate') }}" class="#">
                    @include('reports.universal-report.filter')
                    <div class="d-flex flex-column">
                        @if(isset($students) && $students->isNotEmpty())
                            <div class="col text-center bg-warning text-dark p-1 mb-4">
                                <span class="d-inline-block lh-sm">Время экспорта Excel-файла <strong>2&nbsp;минуты</strong></span>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary mb-3">Сформировать</button>
                        @if(request()->input('report'))
                            @if($students->isNotEmpty())
                                <button class="btn btn-success custom-fn-button-excel mb-3"
                                        type="button"
                                        data-report-name="{{ request()->query('report') }}">Экспорт в Excel
                                </button>
                            @endif
                            <button class="btn btn-success custom-fn-button-generate mb-3" type="button" disabled hidden>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Генерация файла...
                            </button>
                            <a class="btn btn-success custom-fn-button-download mb-3"
                               href="{{ route('reporting.universal-report.download') }}"
                               role="button"
                               hidden>Скачать
                            </a>
                        @endif
                        <a class="btn btn-secondary"
                           href="{{ route('reporting.universal-report.index') }}"
                           role="button">Очистить
                        </a>
                    </div>
                </form>
            </div>

            <div class="col-9">
                @if(isset($students))
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                @include('reports.universal-report.table-blocks.thead.index')
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($students as $student)
                                <tr>
                                    @include('reports.universal-report.table-blocks.tbody.index')
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Ничего не найдено</td>
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
        </div>
    </div>
@endsection
