<ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">
                {{ $notifications->count() + $notificationsVerification->count() }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">
                {{ $notifications->count() + $notificationsVerification->count() }} Notifications
            </span>
            @if ($notifications->count() > 0)
                <div class="dropdown-divider"></div>
                <a href="{{ route('pendaftar-online.index') }}" class="dropdown-item">
                    <i class="fas fa-users"></i>
                    Pendaftar Online
                    <span class="float-right text-muted text-sm">{{ $notifications->count() }} Siswa</span>
                </a>
            @endif

            @if ($notificationsVerification->count() > 0)
                <div class="dropdown-divider"></div>
                <a href="{{ route('pendaftaran.create') }}" class="dropdown-item">
                    <i class="fas fa-check-circle"></i>
                    Verifikasi Pendaftar
                    <span class="float-right text-muted text-sm">{{ $notificationsVerification->count() }} Siswa</span>
                </a>
            @endif

            @if ($notifications->count() == 0 && $notificationsVerification->count() == 0)
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-center">No Notifications</a>
            @else
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">All Notifications</a>
            @endif
        </div>
    </li>

    {{-- @auth --}}
    <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Selamat Datang,
            {{ ucwords(auth()->user()->nm_lengkap) }}</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu dropdown-menu-right border-0 shadow">
            <li><a href="/admin/ganti-password" class="dropdown-item"><i class="nav-icon fas fa-key"></i>
                    Ganti Password </a></li>
            <li class="dropdown-divider"></li>
            <li>
                <form action="/admin/logout" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="nav-icon fas fa-sign-out-alt"></i>
                        Logout</button>
                </form>
            </li>
        </ul>
    </li>
</ul>
