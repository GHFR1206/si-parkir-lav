<ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('parkir.create') ? 'active' : '' }}" aria-current="page"
            href="{{ route('parkir.create') }}">Parkir Masuk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('parkir.getKeluar') ? 'active' : '' }}"
            href={{ route('parkir.getKeluar') }}>Parkir Keluar</a>
    </li>
</ul>
