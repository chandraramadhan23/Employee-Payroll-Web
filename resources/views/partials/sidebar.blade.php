<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <h4>Payroll App</h4>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">

            {{-- Overview --}}
            <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span class="hide-menu">Overview</span></li>

            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

            {{-- Pages --}}
            <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span class="hide-menu">Pages</span></li>

            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('admin*') ? 'active' : '' }}" href="/admin" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Admin</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('karyawan*') ? 'active' : '' }}" href="/karyawan" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Karywan</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('bagian*') ? 'active' : '' }}" href="/bagian" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Bagian</span>
                </a>
            </li>

            {{-- Auth --}}
            <li class="nav-small-cap"><iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6" class="fs-6"></iconify-icon><span class="hide-menu">AUTH</span></li>

            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('logout*') ? 'active' : '' }}" href="/logout" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Keluar</span>
                </a>
            </li>

        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!--  Sidebar End -->