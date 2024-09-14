@extends('layouts.app')

@section('title', 'Управление пользователями')

@section('content')
    <h2 class="fw-bold pt-4 pb-5">Управление пользователями</h2>
    <div class="row">
        @include('session-message')
        <div class="col-5">
            <a class="btn btn-success mb-4" href="{{ route('admin.manage.users.create') }}"
               role="button">Добавить&nbsp;@include('icons.other.plus-lg')</a>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col" class="col-1 text-center">№</th>
                    <th scope="col" class="col-10 text-center">Пользователь</th>
                    <th scope="col" class="col-1 text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data))
                    @php $counter = 1; @endphp
                    @forelse($data as $item)
                        <tr>
                            <th scope="row" class="text-center align-middle">{{ $counter }}</th>
                            <td class="text-start align-middle">{{ $item->name }}&nbsp;{{ $item->surname }}</td>
                            <td class="d-flex justify-content-between align-items-center">@include('buttons.button-group-4')</td>
                        </tr>
                        @php $counter++; @endphp
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Список пользователей пуст</td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
