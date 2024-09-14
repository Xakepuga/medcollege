@extends('layouts.app')

@section('title')
    Управление категорией: {{ request()->query('title') }}
@endsection

@section('content')
    <a href="{{ route('admin.manage.categories.index') }}"
       class="text-decoration-none">@include('icons.other.arrow-left-circle')К списку категорий</a>

    <h2 class="col-9 fw-bold py-5">Управление категорией: «{{ request()->query('title') }}»</h2>

    <div class="row">
        @include('session-message')
        <div class="col-6">
            <form
                action="{{ route('admin.manage.categories.category.store', ['table' => request()->query('id')]) }}"
                method="post"
                class="mb-5">
                @csrf
                <div class="input-group mb-3">
                    <label for="newItem-1" class="form-label"></label>
                    <input id="newItem-1"
                           class="form-control @error('newItem') is-invalid @enderror"
                           name="newItem"
                           value="{{ old('newItem') ?? $newItem->name ?? '' }}"
                           type="text"
                           placeholder="Новый элемент"
                           required
                           aria-describedby="newItem-1-validation">
                    <button class="btn btn-outline-secondary rounded-0" title="Добавить" type="submit"
                            id="button-addon2">
                        <span class="fw-bold fs-5">+</span>
                    </button>
                    @error('newItem')
                    <div id="newItem-1-validation" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col" class="col-1 text-center">№</th>
                    <th scope="col" class="col-10 text-center">Наименование</th>
                    <th scope="col" class="col-1 text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data))
                    @php $counter = 1; @endphp
                    @forelse ($data as $item)
                        <tr>
                            <th scope="row" class="text-center align-middle">{{ $counter }}</th>
                            <td class="text-start align-middle">{{ $item->name }}</td>
                            <td class="text-center align-middle p-0">@include('buttons.button-group-3')</td>
                        </tr>
                        @php $counter++; @endphp
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Список категорий пуст</td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
