<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
        <a href="{{ route('dashboard.index') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    @if (auth()->user()->role == 'ADMIN')
    <li class="sidebar-item {{ Route::is('users.*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class="sidebar-link">
            <i class="bi bi-collection-fill"></i>
            <span>Pengguna</span>
        </a>
    </li>
    @endif

    <li class="sidebar-item has-sub {{ Route::is('uker.*') ? 'active' : '' }}">
        <a href="#" class="sidebar-link">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>NDS</span>
        </a>

        <ul class="submenu submenu-closed" style="--submenu-height:215px;">
            <li class="submenu-item">
                <a href="{{ route('uker.edit') }}" class="submenu-link">Ubah Uker</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item">
        <a href="index.html" class="sidebar-link">
            <i class="bi bi-calendar2-minus-fill"></i>
            <span>WBS</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="index.html" class="sidebar-link">
            <i class="bi bi-clipboard-data-fill"></i>
            <span>MMS</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="index.html" class="sidebar-link">
            <i class="bi bi-distribute-vertical"></i>
            <span>Brinets</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a href="index.html" class="sidebar-link">
            <i class="bi bi-file-text-fill"></i>
            <span>Express</span>
        </a>
    </li>

    <li class="sidebar-title">Settings</li>
    <li class="sidebar-item">
        <a href="{{ route('auth.logout') }}" class="sidebar-link">
            <i class="bi bi-door-closed-fill"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>