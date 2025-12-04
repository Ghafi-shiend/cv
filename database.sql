--
-- Struktur dari tabel `articles`
--
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Struktur dari tabel `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Memasukkan data default untuk admin
-- Passwordnya adalah 'password123'
--
INSERT INTO `users` (`username`, `password`) VALUES
('admin', '$2y$10$d8.h2e0/dE.gJ9k8hY3.w.e2s7C6o5B4i3N2a1f0G.l1H.p9o7K6');