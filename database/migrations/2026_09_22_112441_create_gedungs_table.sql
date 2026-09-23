-- create_gedungs_table

CREATE TABLE IF NOT EXISTS `gedung` (
    id_gedung         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_gedung       VARCHAR(255) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
