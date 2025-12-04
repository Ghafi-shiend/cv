<?php
require_once 'db_connect.php';

try {
    $stmt = $pdo->query("SELECT id, title, content, image, created_at FROM articles ORDER BY created_at DESC");
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Tidak bisa mengambil data artikel: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghafira Anindya Pasha - Artikel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Animate.css (untuk animasi) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="custom-style.css">
    <style>
        .article-card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            overflow: hidden; /* Menjaga gambar tetap di dalam card */
        }
        .article-card-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .article-card-content {
            padding: 25px;
        }
        .article-card h3 {
            color: var(--text-dark-color);
        }
        .article-card .text-muted {
            font-size: 0.9rem;
        }
        .article-card-body {
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <!-- Neon Loading Bar -->
    <div id="loading-bar"></div>

    <!-- Navbar Modern -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">Ghafira A.P.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang.html">Tentang Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="keahlian.html">Keahlian</a></li>
                    <li class="nav-item"><a class="nav-link" href="projek.html">Projek</a></li>
                    <li class="nav-item"><a class="nav-link active" href="artikel.php">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.html">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="display-5 fw-bold">Kumpulan Artikel</h1>
            <p class="lead text-muted">Tulisan dan pemikiran saya seputar teknologi dan pengembangan diri.</p>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <?php if (empty($articles)): ?>
                    <div class="text-center p-5 bg-light rounded">
                        <p class="lead">Belum ada artikel yang dipublikasikan.</p>
                        <p>Silakan login ke panel admin untuk mulai menulis!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($articles as $article): ?>
                        <div class="article-card animate__animated animate__fadeInUp">
                            <?php if (!empty($article['image'])): ?>
                                <img src="uploads/<?= htmlspecialchars($article['image']) ?>" class="article-card-img" alt="<?= htmlspecialchars($article['title']) ?>">
                            <?php endif; ?>
                            <div class="article-card-content">
                                <h3><?= htmlspecialchars($article['title']) ?></h3>
                                <p class="text-muted">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Dipublikasikan pada <?= date('d F Y', strtotime($article['created_at'])) ?>
                                </p>
                                <div class="article-card-body">
                                    <div><?= substr(strip_tags($article['content']), 0, 250) ?>...</div>
                                    <a href="artikel_detail.php?id=<?= $article['id'] ?>" class="btn btn-primary btn-sm mt-3">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-muted text-center p-3 mt-5">
        <p>&copy; Ghapirrrr</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="custom-script.js"></script>
</body>
</html>
