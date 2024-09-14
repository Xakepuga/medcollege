<div class="d-flex justify-content-around align-items-center">
    <a href="{{ route('personal-files.manage.personal-file.show', $student->id) }}" class="text-decoration-none"
       title="Просмотр">
        @include('icons.buttons.button-group-1.show')
    </a>
    <a href="{{ route('personal-files.manage.personal-file.edit', $student->id) }}" class="text-decoration-none"
       title="Редактировать">
        @include('icons.buttons.button-group-1.edit')
    </a>

    <div class="dropdown d-inline">
        <button class="btn btn-link dropdown-toggle text-decoration-none custom-st-dropdown-menu p-0"
                type="button"
                id="dropdownMenuPrintWord"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Печать">@include('icons.buttons.button-group-1.print')
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuPrintWord">
            <li>
                <a href="{{ route('personal-files.manage.personal-file.export-app', $student->id) }}"
                   class="text-decoration-none dropdown-item">Печать заявления
                </a>
            </li>
            <li>
                <a href="#"
                   class="text-decoration-none dropdown-item disabled">Печать личного дела
                </a>
            </li>
        </ul>
    </div>

    <button type="button"
            class="btn btn-link custom-fn-remove p-0"
            data-item-id="{{ $student->id }}"
            data-reload-page="{{ request()->routeIs('students-lists.index') ? '1' : '' }}"
            title="Удалить анкету">@include('icons.buttons.button-group-1.remove')
    </button>

</div>
