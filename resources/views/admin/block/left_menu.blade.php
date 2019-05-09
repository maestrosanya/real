
    <ul class="nav flex-column">
        <li class="nav-item">
            <h5>
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </h5>

        </li>
        <li class="nav-item">
            <a class="nav-link left_menu_link" href="{{ route('admin.users.index') }}">Пользователи</a>
        </li>
        <li class="nav-item">
            <a class="nav-link left_menu_link" href="{{ route('admin.regions.index') }}">Регионы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link left_menu_link" href="{{ route('admin.categories.index') }}">Категории</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>
