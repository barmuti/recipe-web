<?php
session_start(); // Pastikan session dimulai agar $_SESSION tersedia
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MaMa`E</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active m-2" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link m-2" href="like.php">Suka</a>
                    </li>

                    <!-- Tampilkan link 'Unggah' hanya jika user login -->
                    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true): ?>
                        <li class="nav-item">
                            <a class="nav-link m-2" href="create.php">Unggah</a>
                        </li>
                        <!-- Tampilkan link 'Inspirasi Resep' hanya jika user login -->
                        <li class="nav-item">
                            <a class="nav-link m-2" href="crud.php">Inspirasi Resep</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex align-items-center">
                    <?php if (isset($_SESSION['name'])): ?>
                        <span class="text-white me-3">Halo, <?= htmlspecialchars($_SESSION['name']) ?>!</span>
                        <a href="controller/auth.php?action=logout" class="btn btn-danger btn-sm">Logout</a>
                    <?php else: ?>
                        <?php
                            // Ambil halaman saat ini
                            $currentPage = basename($_SERVER['PHP_SELF']);
                            if ($currentPage == "login.php"): 
                        ?>
                            <a href="register.php" class="btn btn-light btn-sm">Register</a>
                        <?php elseif ($currentPage == "register.php"): ?>
                            <a href="login.php" class="btn btn-light btn-sm">Login</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-light btn-sm">Login</a>
                            <a href="register.php" class="btn btn-outline-light btn-sm ms-2">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
