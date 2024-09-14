@extends('layouts.app')

@section('title', 'Управление категориями')

@section('content')
    <h2 class="fw-bold pt-4 pb-5">Управление категориями</h2>
    <div class="row">
        @include('session-message')
        <div class="col-6">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col" class="col-1 text-center">№</th>
                    <th scope="col" class="col-10 text-center">Наименование</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($data))
                    @php $counter = 1; @endphp
                    @forelse ($data as $item)
                        <tr>
                            <th scope="row" class="text-center align-middle">{{ $counter }}</th>
                            <td class="text-start align-middle">
                                <a href="{{ route('admin.manage.categories.category.show', ['slug' => $item->slug,
                                                                                            'id' => $item->id,
                                                                                            'title' => $item->name]) }}"
                                   class="text-decoration-none d-block h-100 p-0">{{ $item->name }}</a>
                            </td>
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
