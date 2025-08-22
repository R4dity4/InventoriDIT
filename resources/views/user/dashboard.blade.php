<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(135deg, #fffbe6 0%, #ffe066 100%);
        }
        .navbar, .footer {
            background-color: #ffe066 !important;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(255, 224, 102, 0.2);
        }
        .btn-primary {
            background-color: #ffd600;
            border-color: #ffd600;
            color: #333;
        }
        .btn-primary:hover {
            background-color: #ffe066;
            border-color: #ffe066;
            color: #333;
        }
    </style>
</head>
<body>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}
                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Profil</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center py-4" style="background:#fffbe6;">
                <h2 class="mb-3" style="color:#ffd600;">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="lead" style="color:#333;">Nikmati kemudahan belanja dan cek stok produk favoritmu di sini.</p>
                <a href="#" class="btn btn-primary mt-3">Lihat Produk</a>
            </div>
        </div>
    </div>
</div>
<footer class="footer mt-auto py-3 text-center">
    <div class="container">
        <span class="text-muted">&copy; 2025 InventoriDIT - Pelanggan</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
