-- create_statuses_table

CREATE TABLE IF NOT EXISTS `status` (
    `id_status` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nama_status` VARCHAR(100) NOT NULL,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;