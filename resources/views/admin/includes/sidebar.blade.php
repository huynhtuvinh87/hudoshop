<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>

        </div>
    </div>
    @php
    $path = explode('/',Request::path());
    $name=!empty($path[1])?$path[1]:$path[0];
    $action=!empty($path[2])?$path[2]:null;
    @endphp
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
            <li class="nav-item {{ $name==='dashboard'?'menu-open':"" }}">
                <a href=" {{ route('admin.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
            <li class="nav-item {{ $name==='categories'?'menu-open':"" }}">
                <a href="{{ route('admin.categories.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-list-alt "></i>
                    <p>
                        Danh mục
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.create') }}" class="nav-link {{ ($name==='categories' && $action=='create')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.trash.list') }}" class="nav-link {{ ($name==='categories' && $action=='trash')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thùng rác</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ $name==='makers'?'menu-open':"" }}">
                <a href="{{ route('admin.makers.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-list-alt "></i>
                    <p>
                        Hãng sản xuất
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('admin.makers.create') }}" class="nav-link {{ ($name==='makers' && $action=='create')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ $name==='articles'?'menu-open':"" }}">
                <a href="{{ route('admin.articles.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Sản phẩm
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('admin.articles.create') }}" class="nav-link {{ ($name==='articles' && $action=='create')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.articles.trash.list') }}" class="nav-link {{ ($name==='articles' && $action=='trash')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thùng rác</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ $name==='affs'?'menu-open':"" }}">
                <a href="{{ route('admin.affs.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Aff
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('admin.affs.create') }}" class="nav-link {{ ($name==='affs' && $action=='create')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.affs.trash.list') }}" class="nav-link {{ ($name==='affs' && $action=='trash')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thùng rác</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ $name==='lfm'?'menu-open':"" }}">
                <a target="_blank" href="/filemanager?type=images" class="nav-link">
                    <i class="fas fa-image nav-icon"></i>
                    <p>Hình ảnh</p>
                </a>
            </li>
            <li class="nav-item {{ $name==='orders'?'menu-open':"" }}">
                <a href="{{ route('admin.orders.index') }}" class="nav-link">
                    <i class="fas fa-phone nav-icon"></i>
                    <p>Đơn hàng</p>
                </a>
            </li>
            <li class="nav-item {{ $name==='pages'?'menu-open':"" }}">
                <a href="{{ route('admin.pages.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>
                        Trang
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ route('admin.pages.create') }}" class="nav-link {{ ($name==='pages' && $action=='create')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pages.trash.list') }}" class="nav-link {{ ($name==='pages' && $action=='trash')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thùng rác</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ $name==='menus'?'menu-open':"" }}">
                <a href="{{ route('admin.menus.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-list-alt "></i>
                    <p>
                        Menus
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>
            <li class="nav-item {{ $name==='widgets'?'menu-open':"" }}">
                <a href="{{ route('admin.widgets.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-list-alt "></i>
                    <p>
                        Widgets
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>

            <li class="nav-item {{ $name==='users'?'menu-open':"" }}">
                <a href=" {{ route('admin.users.index') }}" class="nav-link ">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Thành viên
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav">

                    <li class="nav-item">
                        <a href="{{ route('admin.users.create') }}" class="nav-link {{ ($name==='users' && $action=='create')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm mới</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.trash') }}" class="nav-link {{ ($name==='users' && $action=='trash')?'active':"" }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thùng rác</p>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item {{ $name==='contacts'?'menu-open':"" }}">
                <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <i class="fas fa-phone nav-icon"></i>
                    <p>Liên hệ</p>
                </a>
            </li>
            <li class="nav-item {{ $name==='settings'?'menu-open':"" }}">
                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Cấu hình</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
