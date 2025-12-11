<div class="branding d-flex align-items-center">

    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <h1 class="sitename">Grandoria</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('frontend.home') }}"
                        class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                        <i class="bi bi-house me-1"></i>
                        <span class="d-none d-lg-inline">Home</span>
                    </a>
                </li>

                <!-- DROPDOWN PROFIL -->
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

                <!-- ICON: DOSEN -->
                <li>
                    <a href="{{ route('frontend.dosen.index') }}"
                        class="{{ request()->routeIs('frontend.dosen.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-1"></i>
                        <span class="d-none d-lg-inline">Dosen & Tendik</span>
                    </a>
                </li>

                <!-- ICON: AKADEMIK -->
                <li>
                    <a href="{{ route('frontend.akademik.index') }}"
                        class="{{ request()->routeIs('frontend.akademik.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark me-1"></i>
                        <span class="d-none d-lg-inline">Akademik & Kurikulum</span>
                    </a>
                </li>

                <!-- DROPDOWN INFORMASI -->
                <li class="dropdown">
                    <a href="#"
                        class="{{ request()->routeIs(['frontend.berita.*', 'frontend.contact.*']) ? 'active' : '' }}">
                        <span>Informasi</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{ route('frontend.berita.index') }}"
                                class="{{ request()->routeIs('frontend.berita.*') ? 'active' : '' }}">
                                Berita & Agenda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.contact.index') }}"
                                class="{{ request()->routeIs('frontend.contact.*') ? 'active' : '' }}">
                                Contact
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- DROPDOWN KEGIATAN -->
                <li class="dropdown">
                    <a href="#"
                        class="{{ request()->routeIs(['frontend.penelitian.*', 'frontend.prestasi.*']) ? 'active' : '' }}">
                        <span>Kegiatan</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>

                    <ul>
                        <li><a href="{{ route('frontend.penelitian.index') }}"
                                class="{{ request()->routeIs('frontend.penelitian.*') ? 'active' : '' }}">
                                Penelitian & Pengabdian
                            </a>
                        </li>

                        <li><a href="{{ route('frontend.prestasi.index') }}"
                                class="{{ request()->routeIs('frontend.prestasi.*') ? 'active' : '' }}">
                                Prestasi Mahasiswa
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ICON: galery -->
                <li>
                    <a href="{{ route('frontend.galery.index') }}"
                        class="{{ request()->routeIs('frontend.galery.*') ? 'active' : '' }}">
                        <i class="bi bi-images me-1"></i>
                        <span class="d-none d-lg-inline">Galery</span>
                    </a>
                </li>

            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>

</div>
