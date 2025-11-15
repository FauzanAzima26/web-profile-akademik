<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #212529;
        }
    </style>
</head>
<body>
        {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="text-center py-3 border-bottom">Admin Panel</h4>
        <a href="{{ url('/dashboard') }}">🏠 Dashboard</a>
        <a href="{{ url('/pengaturan') }}">⚙️ Pengaturan</a>
        <a href="{{ url('/berita') }}">📰 Berita</a>
        <a href="{{ url('/galeri') }}">🖼️ Galeri</a>
        <a href="{{ url('/dosen') }}">👨‍🏫 Dosen</a>
        <a href="{{ url('/akademik') }}">🏫Akademik</a>
        <a href="{{ url('/kontak') }}">Kontak</a>
        <a href="{{ url('/penelitian') }}">📚 Penelitian</a>
        <a href="{{ url('/logout') }}" class="mt-auto text-danger">🚪 Logout</a>
    </div>

    {{-- Main Content --}}
    <div class="content">
        <nav class="navbar navbar-dark mb-3">
            <div class="container-fluid">
                <span class="navbar-brand">@yield('title')</span>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
