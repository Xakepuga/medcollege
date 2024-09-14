<ul class="navbar-nav me-auto">
    <li class="nav-item dropdown custom-st-dropdown-navbar px-2">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownPersonalFiles" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            Личные дела
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPersonalFiles">
            @include('menu.personal-files')
        </ul>
    </li>
    <li class="nav-item dropdown custom-st-dropdown-navbar px-2">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownLists" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            Списки
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownLists">
            @include('menu.lists')
        </ul>
    </li>
    <li class="nav-item dropdown custom-st-dropdown-navbar px-2">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownLists" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            Отчётность
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownLists">
            @include('menu.reports')
        </ul>
    </li>
    @if(Auth::user()->is_admin)
        <li class="nav-item dropdown custom-st-dropdown-navbar px-2">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownLists" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                Админка
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownLists">
                @include('menu.admin')
            </ul>
        </li>
    @endif
</ul>
