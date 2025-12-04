<?php
require_once 'db_connect.php';

// Dapatkan ID dari URL, pastikan itu integer
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    // Redirect atau tampilkan error jika tidak ada ID
    header("Location: artikel.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT title, content, image, created_at FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();

    // Jika artikel tidak ditemukan, tampilkan pesan
    if (!$article) {
        http_response_code(404);
        $page_title = "Artikel Tidak Ditemukan";
        $article_not_found = true;
    } else {
        $page_title = htmlspecialchars($article['title']);
    }

} catch (PDOException $e) {
    die("Tidak bisa mengambil data artikel: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghafira Anindya Pasha - <?= $page_title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="custom-style.css">
    <style>
        .article-header-image {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .article-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div id="loading-bar"></div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">Ghafira A.P.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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

    <main class="container mt-5 pt-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <?php if (isset($article_not_found)): ?>
                    <div class="text-center p-5 bg-light rounded animate__animated animate__fadeIn">
                        <h1 class="display-4">404</h1>
                        <p class="lead">Artikel yang Anda cari tidak ditemukan.</p>
                        <a href="artikel.php" class="btn btn-primary">Kembali ke Daftar Artikel</a>
                    </div>
                <?php else: ?>
                    <article class="animate__animated animate__fadeInUp">
                        <h1 class="display-5 fw-bold mb-3"><?= htmlspecialchars($article['title']) ?></h1>
                        
                        <p class="text-muted">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Dipublikasikan pada <?= date('d F Y', strtotime($article['created_at'])) ?>
                        </p>

                        <?php if (!empty($article['image'])): ?>
                            <img src="uploads/<?= htmlspecialchars($article['image']) ?>" class="article-header-image" alt="<?= htmlspecialchars($article['title']) ?>">
                        <?php endif; ?>

                        <div class="article-content mt-4">
                            <?= $article['content'] /* Konten dari TinyMCE */ ?>
                        </div>

                        <hr class="my-5">

                        <a href="artikel.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-2"></i> Kembali ke semua artikel</a>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="bg-light text-muted text-center p-3 mt-5">
        <p>&copy; Ghapirrrr</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="custom-script.js"></script>
</body>
</html>
