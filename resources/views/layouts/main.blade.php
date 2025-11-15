<!DOCTYPE html>
<html lang="id">
<head>
<style>
  .text-justify {
    text-align: justify;
    line-height: 1.7; /* jarak antarbaris */
    margin-bottom: 1rem; /* jarak antar paragraf */
  }
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Profil Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">Profil Prodi</a>

    <!-- Tombol toggle (buat tampilan mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu utama -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>

        <!-- 🔽 Dropdown menu Profil -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            Profil
          </a>
          <ul class="dropdown-menu" aria-labelledby="profilDropdown">
            <li><a class="dropdown-item" href="{{ url('/profil/visi-misi') }}">Visi & Misi</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil/sejarah') }}">Sejarah</a></li>
            <li><a class="dropdown-item" href="{{ url('/profil/struktur') }}">Struktur Organisasi</a></li>
            <li><a class="dropdown-item" href="https://lp3m.unimal.ac.id/akreditasi/hasil-akreditasi" target="_blank">Akreditasi</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="{{ url('/dosen') }}">Dosen</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/berita') }}">Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/galeri') }}">Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/akademik') }}">Akademik</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/penelitian') }}">Penelitian</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/prestasi') }}">Prestasi</a></li>

      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  @yield('content')
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
  &copy; {{ date('Y') }} Program Studi Informatika | Universitas Malikussaleh
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
