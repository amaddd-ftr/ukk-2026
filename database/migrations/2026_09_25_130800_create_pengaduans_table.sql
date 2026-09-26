CREATE TABLE IF NOT EXISTS `pengaduan` (
    `id_pengaduan` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    `id_siswa` INT UNSIGNED NOT NULL,
    `id_sarpras` INT UNSIGNED NOT NULL,
    `id_lokasi` INT UNSIGNED NOT NULL,
    `id_status` INT UNSIGNED NOT NULL,

    `judul` VARCHAR(255) NOT NULL,
    `deskripsi` TEXT NOT NULL,

    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,

    CONSTRAINT `fk_pengaduan_siswa`
        FOREIGN KEY (`id_siswa`)
        REFERENCES `siswas` (`id_siswa`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT `fk_pengaduan_sarpras`
        FOREIGN KEY (`id_sarpras`)
        REFERENCES `sarpras` (`id_sarpras`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT `fk_pengaduan_lokasi`
        FOREIGN KEY (`id_lokasi`)
        REFERENCES `lokasi` (`id_lokasi`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT `fk_pengaduan_status`
        FOREIGN KEY (`id_status`)
        REFERENCES `status` (`id_status`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4