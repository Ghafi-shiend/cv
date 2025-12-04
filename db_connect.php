-<?php
// --- PENGATURAN KONEKSI DATABASE ---
$db_host = 'localhost'; // Host database Anda, biasanya 'localhost'
$db_name = 'dbcv';      // Nama database Anda
$db_user = 'root';      // Username database Anda
$db_pass = '';          // Password database Anda
// ------------------------------------

// Opsi untuk koneksi PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Tampilkan error sebagai exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch data sebagai associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Gunakan native prepared statements
];

try {
    // Buat instance PDO baru
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Tangkap error jika koneksi gagal
    // Sebaiknya jangan tampilkan error detail di lingkungan produksi
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>