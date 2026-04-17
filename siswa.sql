-- Insert data siswa ke tabel users
-- Username menggunakan NIS, Password untuk semua siswa: siswa123
-- Hash password: $2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi

INSERT INTO `users` (`username`, `nama`, `password`, `role`, `created_at`, `updated_at`) VALUES
('2024001', 'Siswa Test', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024002', 'Ahmad Rizki', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024003', 'Siti Nurhaliza', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024004', 'Budi Santoso', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024005', 'Dewi Lestari', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024006', 'Andi Pratama', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024007', 'Rina Wati', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024008', 'Dimas Aditya', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024009', 'Fitri Handayani', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW()),
('2024010', 'Rudi Hermawan', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewY5idGRusEM64W6', 'siswa', NOW(), NOW());

-- Tabel Siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa_nis_unique` (`nis`),
  KEY `siswa_id_user_foreign` (`id_user`),
  CONSTRAINT `siswa_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data detail siswa ke tabel siswa (sesuaikan id_user dengan id yang dihasilkan dari insert users)
INSERT INTO `siswa` (`nis`, `nama`, `kelas`, `jurusan`, `no_telp`, `alamat`, `id_user`, `created_at`, `updated_at`) VALUES
('2024001', 'Siswa Test', 'XII', 'RPL', '081234567890', 'Jl. Contoh No. 123', (SELECT id FROM users WHERE username = '2024001'), NOW(), NOW()),
('2024002', 'Ahmad Rizki', 'XI', 'TKJ', '081234567891', 'Jl. Merdeka No. 45', (SELECT id FROM users WHERE username = '2024002'), NOW(), NOW()),
('2024003', 'Siti Nurhaliza', 'X', 'MM', '081234567892', 'Jl. Sudirman No. 78', (SELECT id FROM users WHERE username = '2024003'), NOW(), NOW()),
('2024004', 'Budi Santoso', 'XII', 'RPL', '081234567893', 'Jl. Ahmad Yani No. 12', (SELECT id FROM users WHERE username = '2024004'), NOW(), NOW()),
('2024005', 'Dewi Lestari', 'XI', 'TKJ', '081234567894', 'Jl. Gatot Subroto No. 56', (SELECT id FROM users WHERE username = '2024005'), NOW(), NOW()),
('2024006', 'Andi Pratama', 'XII', 'MM', '081234567895', 'Jl. Diponegoro No. 89', (SELECT id FROM users WHERE username = '2024006'), NOW(), NOW()),
('2024007', 'Rina Wati', 'X', 'RPL', '081234567896', 'Jl. Pahlawan No. 34', (SELECT id FROM users WHERE username = '2024007'), NOW(), NOW()),
('2024008', 'Dimas Aditya', 'XI', 'TKJ', '081234567897', 'Jl. Veteran No. 67', (SELECT id FROM users WHERE username = '2024008'), NOW(), NOW()),
('2024009', 'Fitri Handayani', 'XII', 'MM', '081234567898', 'Jl. Kartini No. 23', (SELECT id FROM users WHERE username = '2024009'), NOW(), NOW()),
('2024010', 'Rudi Hermawan', 'X', 'RPL', '081234567899', 'Jl. Pemuda No. 90', (SELECT id FROM users WHERE username = '2024010'), NOW(), NOW());

