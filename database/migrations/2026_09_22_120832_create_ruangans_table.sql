-- create_ruangans_table

CREATE TABLE IF NOT EXISTS `ruangan` (
    id_ruangan         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_gedung INT UNSIGNED NOT NULL,
    nama_ruangan       VARCHAR(255) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
