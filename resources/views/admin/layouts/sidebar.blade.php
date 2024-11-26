<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light"><i class="fa fa-bank"></i> Market</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link
                    {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-chart-area"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs
                    ('users.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('branches.index') }}" class="nav-link {{ request()->routeIs
                    ('branches.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-code-branch"></i>
                        <p>
                            Филиалы
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs
                    ('categories.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>
                            Категория
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('brands.index') }}" class="nav-link {{ request()->routeIs
                    ('brands.index') ? 'active' : '' }}">
                        <i class="nav-icon fa-brands fa-medium"></i>
                        <p>
                            Бренд
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs
                    ('products.index') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Продукты
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('register_products.index') }}" class="nav-link {{ request()->routeIs
                    ('register_products.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa fa-check-circle"></i>
                        <p>
                            Партии продукта

                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('order.index') }}" class="nav-link {{ request()->routeIs
                    ('order.index') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Заказы
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('banners.index') }}" class="nav-link {{ request()->routeIs
                    ('banners.index') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-image"></i>
                        <p>
                            Баннер
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('discount_products.index') }}" class="nav-link {{ request()->routeIs
                    ('discount_products.index') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-percent "></i>
                        <p>
                            Товары со скидкой
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('tariff.index') }}" class="nav-link {{ request()->routeIs
                    ('tariff.index') ? 'active' : '' }}">
                        <i class="nav-icon  fa fa-text-width"></i>
                        <p>
                            Тариф
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('ware_house.index') }}" class="nav-link {{ request()->routeIs
                    ('ware_house.index') ? 'active' : '' }}">
                        <i class="nav-icon  fa fa-text-width"></i>
                        <p>
                            Склад
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
