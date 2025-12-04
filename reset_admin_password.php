<?php
require_once 'db_connect.php';

// Password baru yang akan di-set
$new_password = 'password123';
$admin_username = 'admin';

// Generate hash yang baru dan aman untuk password
$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

try {
    // Siapkan dan jalankan query UPDATE
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->execute([$new_password_hash, $admin_username]);

    // Cek apakah ada baris yang terpengaruh (updated)
    if ($stmt->rowCount() > 0) {
        $message = "Password untuk pengguna '{$admin_username}' telah berhasil direset. <br>";
        $message .= "Silakan coba login kembali menggunakan password: <strong>{$new_password}</strong> <br><br>";
        $message .= "<strong style='color:red;'>PENTING: Hapus file 'reset_admin_password.php' ini sekarang demi keamanan.</strong>";
    } else {
        $message = "Gagal mereset password. Pengguna '{$admin_username}' tidak ditemukan di database.";
    }
} catch (PDOException $e) {
    $message = "Error database: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f6f9fc;
        }
        .message-card {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="message-card card">
        <h3 class="mb-3">Status Reset Password</h3>
        <div class="alert alert-info">
            <?= $message ?>
        </div>
        <a href="login.php" class="btn btn-primary mt-3">Ke Halaman Login</a>
    </div>
</body>
</html>
