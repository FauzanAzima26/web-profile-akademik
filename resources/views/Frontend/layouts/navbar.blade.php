<div class="branding d-flex align-items-cente">

    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ asset('assets/frontend') }}/img/logo.webp" alt=""> -->
            <h1 class="sitename">Grandoria</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('frontend.home') }}"
                        class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">Home</a></li>

                <li class="dropdown">
                    <a href="#"
                        class="{{ request()->routeIs([
                            'frontend.visi-misi.*',
                            'frontend.sejarah.*',
                            'frontend.struktur.*',
                            'frontend.akreditasi.*',
                        ])
                            ? 'active'
                            : '' }}">
                        <span>Profil</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>

                    <ul>
                        <li><a class="{{ request()->routeIs('frontend.visi-misi.*') ? 'active' : '' }}"
                                href="{{ route('frontend.visi-misi.index') }}">Visi dan Misi</a></li>
                        <li><a class="{{ request()->routeIs('frontend.sejarah.*') ? 'active' : '' }}"
                                href="{{ route('frontend.sejarah.index') }}">Sejarah</a></li>
                        <li><a class="{{ request()->routeIs('frontend.struktur.*') ? 'active' : '' }}"
                                href="{{ route('frontend.struktur.index') }}">Struktur Organisasi</a></li>
                        <li><a class="{{ request()->routeIs('frontend.akreditasi.*') ? 'active' : '' }}"
                                href="{{ route('frontend.akreditasi.index') }}">Akreditasi</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('frontend.dosen.index') }}"
                        class="{{ request()->routeIs('frontend.dosen.*') ? 'active' : '' }}">Dosen & Tendik</a></li>

                <li><a href="{{ route('frontend.akademik.index') }}"
                        class="{{ request()->routeIs('frontend.akademik.*') ? 'active' : '' }}">Akademik &
                        Kurikulum</a></li>

                <li><a href="{{ route('frontend.contact.index') }}"
                        class="{{ request()->routeIs('frontend.contact.*') ? 'active' : '' }}">Contact</a></li>

            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>

</div>
