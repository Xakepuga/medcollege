<a href="{{ route('admin.manage.users.user.show', $item->id) }}" class="text-decoration-none"
   title="Просмотр">
    @include('icons.buttons.button-group-4.show')
</a>

<a href="{{ route('admin.manage.users.user.edit', $item->id) }}" class="text-decoration-none"
   title="Редактировать">
    @include('icons.buttons.button-group-4.edit')
</a>

<button type="button"
        class="btn btn-link custom-fn-remove p-0"
        data-item-id="{{ $item->id }}"
        data-reload-page="1"
        {{--data-delete-url="{{ route('admin.manage.users.user.destroy', $item->id) }}"--}}
        title="Удалить"
        @if ($item->email === Auth::user()->email) disabled="disabled" @endif>@include('icons.buttons.button-group-4.remove')
</button>
