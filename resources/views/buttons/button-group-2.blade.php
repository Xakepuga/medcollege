{{--<a href="{{ url()->previous() }}" class="#"></a>--}}
@if(request()->routeIs('personal-files.manage.personal-file.show'))
    <a class="btn btn-outline-secondary"
       href="{{ route('personal-files.manage.personal-file.edit', $student->id) }}"
       role="button">Редактировать @include('icons.buttons.button-group-2.edit')
    </a>
@endif
<button class="btn btn-outline-secondary dropdown-toggle rounded-end-0 text-decoration-none"
        type="button"
        id="dropdownMenuPrintWord"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        title="Печать">Печать @include('icons.buttons.button-group-2.print')
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
<button type="button"
        class="btn btn-danger custom-fn-remove"
        data-item-id="{{ $student->id }}"
        data-reload-page="">Удалить @include('icons.buttons.button-group-2.remove')
</button>
