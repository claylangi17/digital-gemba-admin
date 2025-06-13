<aside class="sidebar">
    <button type="button" class="sidebar-close-btn !mt-4">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('index') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('index') }}">
                    <iconify-icon icon="mage:home-3" class="menu-icon"></iconify-icon>
                    <span>Beranda</span>
                </a>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                    <span>Gemba</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('gemba.analytics') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> 
                            Statistik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('genba.history') }}">
                            <i class="ri-circle-fill circle-icon text-secondary-600 w-auto"></i> 
                            Riwayat
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('appreciation.index') }}">
                    <iconify-icon icon="gg:awards" class="menu-icon"></iconify-icon>
                    <span>Penghargaan</span>
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}">
                    <iconify-icon icon="humbleicons:users" class="menu-icon"></iconify-icon>
                    <span>Pengguna</span>
                </a>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Pengaturan</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="#">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> 
                            Presensi
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ri-circle-fill circle-icon text-warning-600 w-auto"></i> 
                            Reward System
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>