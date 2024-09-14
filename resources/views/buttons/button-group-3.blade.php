<button type="button"
        class="btn btn-link custom-fn-remove"
        data-item-id="{{ $item->id }}"
        data-table-id="{{ request()->query('id') }}"
        title="Удалить"
        @if (!$item->permission_remove) disabled="disabled" @endif>@include('icons.buttons.button-group-3.remove')
</button>
