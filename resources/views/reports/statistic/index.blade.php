@extends('layouts.app')

@section('title', 'Статистика поданных заявлений')

@section('content')
    <div class="row">

        <div class="col-12">
            <h2 class="fw-bold pt-4 pb-3 pb-lg-5 ps-2 ps-lg-0">Статистика поданных заявлений</h2>
        </div>

        {{--<div class="col-12">
            @include('session-message')
        </div>--}}

        @if(!empty($data))
            @php $counter = 1; @endphp

            <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                <div class="#">
                    <span class="d-inline-block bg-success rounded-pill py-2 px-3 text-white bg-opacity-75 me-2">
                        Всего абитуриентов: {{ $data['countUniqueStudents'] }}
                    </span>
                    <span class="d-inline-block bg-success rounded-pill py-2 px-3 text-white bg-opacity-75">
                        С оригиналами: {{ $data['countOrigDocs'] }}
                    </span>
                </div>
                @if(!empty($data))
                    <div class="col-auto p-0">
                        <a class="btn btn-primary"
                           href="{{ route('reporting.statistics.export-list') }}"
                           role="button"
                           style="min-width: 130px">Скачать
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-5">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center align-middle">№</th>
                            <th scope="col" class="text-center align-middle custom-st-min-width-475">Специальность</th>
                            @foreach($data['financingNames'] as $name)
                                <th scope="col" class="text-center align-middle custom-st-min-width-75">{{ $name }}</th>
                            @endforeach
                            <th scope="col" class="text-center align-middle custom-st-min-width-75">Всего</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['faculties'] as $faculty)
                            <tr>
                                <th scope="row" class="text-center align-middle">{{ $counter }}</th>
                                <td class="text-start align-middle">{{ $faculty['name'] }}</td>
                                @foreach($faculty['financing'] as $key => $value)
                                    <td class="text-center align-middle">{{ $value }}</td>
                                @endforeach
                                <td class="text-center align-middle">{{ $faculty['totalCount'] }}</td>
                            </tr>
                            @php $counter++; @endphp
                        @endforeach
                        <tr>
                            <th colspan="2"></th>
                            @foreach($data['rowTotal']['financing'] as $key => $value)
                                <th class="text-center align-middle">{{ $value }}</th>
                            @endforeach
                            <th class="text-center align-middle">{{ $data['rowTotal']['totalCount'] }}</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p class="fs-5 text-danger pt-3">Ничего не найдено</p>
        @endif
    </div>
@endsection
