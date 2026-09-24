-- create_saranas_table

CREATE TABLE IF NOT EXISTS `sarana` (
    id_sarana         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_ruangan          INT UNSIGNED NOT NULL,
    id_kondisi          INT UNSIGNED NOT NULL,
    kode_sarana       VARCHAR(50) NOT NULL,
    nama_sarana       VARCHAR(255) NOT NULL,
    jumlah_sarana    INT UNSIGNED NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
