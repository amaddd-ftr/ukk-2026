-- create_sarpras_table

CREATE TABLE IF NOT EXISTS `sarpras` (
    `id_sarpras` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    
    `id_kategori` INT UNSIGNED NOT NULL,
    `id_kondisi` INT UNSIGNED NOT NULL,

    `kode_sarpras` VARCHAR(50) NOT NULL,
    `nama_sarpras` VARCHAR(255) NOT NULL,

    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,

    

    CONSTRAINT `fk_sarpras_kategori`
        FOREIGN KEY (`id_kategori`)
        REFERENCES `kategori` (`id_kategori`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT `fk_sarpras_kondisi`
        FOREIGN KEY (`id_kondisi`)
        REFERENCES `kondisi` (`id_kondisi`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;