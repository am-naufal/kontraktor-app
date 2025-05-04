<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('build/assets/img/kaiadmin/logo_light.svg') }}" alt="Logo" height="20">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Kelola User</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('proyeks*') ? 'active' : '' }}">
                    <a href="{{ route('proyeks.index') }}">
                        <i class="fas fa-project-diagram"></i>
                        <p>Kelola Proyek</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('customers*') ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}">
                        <i class="fas fa-user-tie"></i>
                        <p>Kelola Customer</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('penjualans*') ? 'active' : '' }}">
                    <a href="{{ route('penjualans.index') }}">
                        <i class="fas fa-cash-register"></i>
                        <p>Kelola Penjualan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('barangs*') ? 'active' : '' }}">
                    <a href="{{ route('barangs.index') }}">
                        <i class="fas fa-box"></i>
                        <p>Kelola Barang</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('pembiayaans*') ? 'active' : '' }}">
                    <a href="{{ route('pembiayaans.index') }}">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Kelola Pembiayaan</p>
                    </a>
                </li>
                <!-- Tambahkan menu lainnya di sini -->
            </ul>
        </div>
    </div>
</div>
