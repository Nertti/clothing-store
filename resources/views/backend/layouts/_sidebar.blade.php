<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if($active_class !== 'dashboard') collapsed @endif" href="{{ url('panel/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Обзор</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#catalog-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-shop"></i><span>Каталог</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="catalog-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Категории</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Товары</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Свойства</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Фильтр</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Склады</span>
                    </a>
                </li>
            </ul>
        </li><!-- End catalog Nav -->

        <li class="nav-item">
            <a class="nav-link @if($active_class !== 'category' && $active_class !== 'posts') collapsed @endif" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-collection"></i><span>Блог</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="blog-nav" class="nav-content collapse @if($active_class === 'category' || $active_class === 'posts') show @endif" data-bs-parent="#sidebar-nav">
                <li>
                    <a @if($active_class === 'category') class="active" @endif href="/panel/blog/category/">
                        <i class="bi bi-circle"></i><span>Категории</span>
                    </a>
                </li>
                <li>
                    <a @if($active_class === 'posts') class="active" @endif href="#">
                        <i class="bi bi-circle"></i><span>Посты</span>
                    </a>
                </li>
            </ul>
        </li><!-- End blog Nav -->

        <li class="nav-item">
            <a class="nav-link @if($active_class !== 'users') collapsed @endif" href="{{url('panel/users')}}">
                <i class="bi bi-people"></i>
                <span>Пользователи</span>
            </a>
        </li><!-- End Users Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#shop-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-basket"></i><span>Магазин</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="shop-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Заказы</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Службы доставки</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Платёжные системы</span>
                    </a>
                </li>
            </ul>
        </li><!-- End shop Nav -->

        <li class="nav-heading">Страницы</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#home-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-house"></i><span>Главная</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="home-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Слайдер</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Популярное</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Рекомендации</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Home Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-window"></i>
                <span>О нас</span>
            </a>
        </li><!-- End About Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-pin-map"></i>
                <span>Контакты</span>
            </a>
        </li><!-- End Contacts Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
