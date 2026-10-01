
<button id="sidebarToggle"
        class="sidebar-toggle"
        type="button">
    ☰
</button>

<div id="sidebarOverlay" class="sidebar-overlay"></div>

<aside id="sidebar" class="sidebar">

    <div class="sidebar-brand">
        @php
            $dbConnected = false;

            try {
                \Sakuci\Database\Connection::pdo();
                $dbConnected = true;
            } catch (\Throwable $e) {
                $dbConnected = false;
            }
        @endphp

        <button id="themeToggle"
                type="button"
                class="logo-toggle"
                aria-label="Ganti tema terang/gelap"
                title="Ganti tema terang/gelap">

            <svg width="30" height="30" viewBox="0 0 32 32"
                 xmlns="http://www.w3.org/2000/svg"
                 aria-hidden="true">

                <circle class="logo-ring"
                        cx="16" cy="16" r="15"/>

                <circle cx="16" cy="16" r="9"
                        fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
            </svg>

        </button>

        <a href="{{ route('home') }}" class="sidebar-title">
            {{ config('app.name') }}
        </a>
    </div>


    {{-- Menu --}}
<nav class="sidebar-nav">

    {{-- ========================= --}}
    {{-- BERANDA --}}
    {{-- ========================= --}}
    <a class="sidebar-link {{ is_route('home') ? 'active' : '' }}"
       href="{{ route('home') }}">
        <span>🏠</span>
        <span>Beranda</span>
    </a>


    @php
        $currentUser = \App\Models\User::current();
    @endphp


    {{-- ========================= --}}
    {{-- BELUM LOGIN --}}
    {{-- ========================= --}}
    @if (!$currentUser)

        @php
            $canRegister = false;

            if ($dbConnected) {
                try {
                    $canRegister =
                        \App\Models\Role::where('can_register', 1)->exists();
                } catch (\Throwable $e) {
                    $canRegister = false;
                }
            }
        @endphp

        @if ($canRegister)
            <a class="sidebar-link {{ is_route('register') ? 'active' : '' }}"
               href="{{ route('register') }}">
                <span>📝</span>
                <span>Daftar</span>
            </a>
        @endif

        <a class="sidebar-link sidebar-login"
           href="{{ route('login') }}">
            <span>👤</span>
            <span>Masuk</span>
        </a>


    {{-- ========================= --}}
    {{-- ADMIN --}}
    {{-- ========================= --}}
    @elseif ($currentUser->role === 'admin')

        <a class="sidebar-link {{ is_route('admin.dashboard') ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
            <span>📊</span>
            <span>Dashboard</span>
        </a>

        <a class="sidebar-link {{ is_route('admin.kategori.index') ? 'active' : '' }}"
           href="{{ route('admin.kategori.index') }}">
            <span>📂</span>
            <span>Kategori</span>
        </a>

        <a class="sidebar-link {{ is_route('admin.lokasi.index') ? 'active' : '' }}"
           href="{{ route('admin.lokasi.index') }}">
            <span>📍</span>
            <span>Lokasi</span>
        </a>
        
        <a class="sidebar-link {{ is_route('admin.siswa.index') ? 'active' : '' }}"
           href="{{ route('admin.siswa.index') }}">
            <span>👨‍🎓</span>
            <span>Siswa</span>
        </a>

        <a class="sidebar-link {{ is_route('admin.sarpras.index') ? 'active' : '' }}"
           href="{{ route('admin.sarpras.index') }}">
            <span>🏢</span>
            <span>Sarpras</span>
        </a>

        <a class="sidebar-link {{ is_route('admin.status.index') ? 'active' : '' }}"
           href="{{ route('admin.status.index') }}">
            <span>📋</span>
            <span>Status</span>
        </a>

        <a class="sidebar-link {{ is_route('admin.pengaduan.index') ? 'active' : '' }}"
           href="{{ route('admin.pengaduan.index') }}">
            <span>📢</span>
            <span>Pengaduan</span>
        </a>

        <div class="sidebar-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="sidebar-link sidebar-logout">
                <span>↪️</span>
                <span>Logout</span>
            </button>
        </form>


    {{-- ========================= --}}
    {{-- SISWA --}}
    {{-- ========================= --}}
    @else

        <a class="sidebar-link {{ is_route('dashboard') ? 'active' : '' }}"
           href="{{ route('dashboard') }}">
            <span>📊</span>
            <span>Dashboard</span>
        </a>

        <a class="sidebar-link {{ is_route('pengaduan.index') ? 'active' : '' }}"
           href="{{ route('pengaduan.index') }}">
            <span>📢</span>
            <span>Pengaduan Saya</span>
        </a>

        <a class="sidebar-link {{ is_route('pengaduan.create') ? 'active' : '' }}"
           href="{{ route('pengaduan.create') }}">
            <span>➕</span>
            <span>Buat Pengaduan</span>
        </a>

        <div class="sidebar-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="sidebar-link sidebar-logout">
                <span>↪️</span>
                <span>Logout</span>
            </button>
        </form>

    @endif

</nav>

</aside>