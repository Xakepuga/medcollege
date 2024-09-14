@if(request()->routeIs('admin.manage.users.user.show'))
    <a href="{{ route('admin.manage.users.user.edit', $user->id) }}" class="text-decoration-none me-2 pt-1"
       title="Редактировать">
        @include('icons.buttons.button-group-5.edit')
    </a>
@endif

<button type="button"
        class="btn btn-link custom-fn-remove p-0"
        data-item-id="{{ $user->id }}"
        data-reload-page=""
        {{--data-delete-url="{{ route('admin.manage.users.user.destroy', $user->id) }}"--}}
        title="Удалить"
        @if ($user->email === Auth::user()->email) disabled="disabled" @endif>@include('icons.buttons.button-group-5.remove')
</button>
