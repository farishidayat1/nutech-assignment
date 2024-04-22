<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #F13B2F !important;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('cms-assets/Handbag.png')}}" alt="logo">
        </div>
        <div class="sidebar-brand-text ml-2 mt-1">SIMS Web App</div>
    </a>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('product') }}">
            <img src="{{ asset('cms-assets/Package.png')}}" alt="logo">
            <span>Produk</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('profile') }}">
            <img src="{{ asset('cms-assets/User.png')}}" alt="logo">
            <span>Profile</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('logout') }}">
            <img src="{{ asset('cms-assets/SignOut.png')}}" alt="logo">
            <span>Logout</span>
        </a>
    </li>

    <div class="text-center d-none d-md-inline" style="margin-top: 20px;">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>