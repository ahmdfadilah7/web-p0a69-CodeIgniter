<!-- Sidebar navigation-->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/dashboard') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Transaksi</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/pesanan') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Pesanan</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Main</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/cabang') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Cabang</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/produk') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Produk</span>
            </a>
        </li>        
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/rekening') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Rekening</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/ongkir') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Ongkir</span>
            </a>
        </li>

        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Setting</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/setting') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Setting Website</span>
            </a>
        </li>

        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">User Management</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="<?= site_url('admin/user') ?>" aria-expanded="false">
                <span>
                    <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">User</span>
            </a>
        </li>
        
    </ul>
    <a href="<?= site_url('auth/logout/'.$this->session->userdata('role')) ?>" class="btn btn-danger fs-2 fw-semibold d-block"><i class="ti ti-logout"></i> Sign Out</a>
</nav>
<!-- End Sidebar navigation -->
