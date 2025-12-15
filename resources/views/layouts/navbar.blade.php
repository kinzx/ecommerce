<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm"
    style="backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.9) !important;">
    <div class="container">
        {{-- LOGO / BRAND --}}
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">
            <i class="bi bi-shop-window me-2"></i>TokoApp
        </a>

        {{-- TOMBOL TOGGLER (UNTUK HP) --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- MENU LINK --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-2">

                {{-- Link Dashboard/Home --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-pill {{ request()->is('/') ? 'active bg-primary text-white' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door-fill me-1"></i>Home
                    </a>
                </li>

                {{-- Link Categories --}}
                {{-- request()->routeIs('categories.*') artinya: jika sedang buka index, create, atau edit kategori, menu ini aktif --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-pill {{ request()->routeIs('categories.*') ? 'active bg-primary text-white' : '' }}"
                        href="{{ route('categories.index') }}">
                        <i class="bi bi-tags-fill me-1"></i> Kategori
                    </a>
                </li>

                {{-- Link Products --}}
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-pill {{ request()->routeIs('products.*') ? 'active bg-primary text-white' : '' }}"
                        href="{{ route('products.index') }}">
                        <i class="bi bi-box-seam-fill me-1"></i> Produk
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>


<div style="margin-top: 80px;"></div>
