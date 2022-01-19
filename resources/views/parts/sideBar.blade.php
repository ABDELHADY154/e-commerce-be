<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon ">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="/logo/logo.png" alt="" style="width: 4rem;height:4rem">
        </div>

        <div class="sidebar-brand-text">Beam</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::currentRouteName() == 'home'? 'active' : '' }}">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Route::currentRouteName() == 'clientMessage.index' || Route::currentRouteName() == 'ad.index' ||  Route::currentRouteName() == 'clientAddress.index' || Route::currentRouteName() == 'user.index' || Route::currentRouteName() == 'client.index'? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Route::currentRouteName() == 'clientMessage.index' || Route::currentRouteName() == 'ad.index' ||  Route::currentRouteName() == 'clientAddress.index' || Route::currentRouteName() == 'user.index' || Route::currentRouteName() == 'client.index'? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item {{ Route::currentRouteName() == 'user.index'? 'active' : '' }}" href="{{ route('user.index') }}">Admin</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'client.index'? 'active' : '' }}" href="{{ route('client.index') }}">Client</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'clientAddress.index'? 'active' : '' }}" href="{{ route('clientAddress.index') }}">Client Address</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'clientMessage.index'? 'active' : '' }}" href="{{ route('clientMessage.index') }}">Client Messages</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'ad.index'? 'active' : '' }}" href="{{ route('ad.index') }}">Ads</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Products
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Route::currentRouteName() == 'brand.index' || Route::currentRouteName() == 'gender.index' || Route::currentRouteName() == 'productSize.index' ||  Route::currentRouteName() == 'category.index' || Route::currentRouteName() == 'product.index' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-shopping-cart"></i> <span>Products</span>
        </a>
        <div id="collapseThree" class="collapse {{ Route::currentRouteName() == 'gender.index' || Route::currentRouteName() == 'productSize.index' || Route::currentRouteName() == 'brand.index' || Route::currentRouteName() == 'category.index' || Route::currentRouteName() == 'product.index'  ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item {{ Route::currentRouteName() == 'gender.index'? 'active' : '' }}" href="{{ route('gender.index') }}">Gender</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'brand.index'? 'active' : '' }}" href="{{ route('brand.index') }}">Brand</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'category.index'? 'active' : '' }}" href="{{ route('category.index') }}">Category</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'product.index'? 'active' : '' }}" href="{{ route('product.index') }}">Products</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'productSize.index' ? 'active' : '' }}" href="{{ route('productSize.index') }}">Product Sizes</a>

                {{-- <a class="collapse-item {{ Route::currentRouteName() == 'client.index'? 'active' : '' }}" href="{{ route('client.index') }}">Client</a> --}}
            </div>

        </div>

    </li>
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Orders
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{  Route::currentRouteName() == 'order.index' || Route::currentRouteName() == 'promocode.index' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-shopping-basket"></i> <span>Orders</span>
        </a>
        <div id="collapseFour" class="collapse {{  Route::currentRouteName() == 'order.index' || Route::currentRouteName() == 'promocode.index'  ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item {{ Route::currentRouteName() == 'order.index'? 'active' : '' }}" href="{{ route('order.index') }}">Orders</a>
                <a class="collapse-item {{ Route::currentRouteName() == 'promocode.index'? 'active' : '' }}" href="{{ route('promocode.index') }}">Promo Codes</a>

                {{-- <a class="collapse-item {{ Route::currentRouteName() == 'client.index'? 'active' : '' }}" href="{{ route('client.index') }}">Client</a> --}}
            </div>

        </div>

    </li>

    {{-- <a href="{{route('logout')}}">logout</a> --}}
    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

    <!-- Sidebar Toggler (Sidebar) -->
    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
