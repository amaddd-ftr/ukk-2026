-- create_prasarana_table

CREATE TABLE IF NOT EXISTS `prasarana` (
    id_prasarana INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_ruangan INT UNSIGNED NOT NULL,
    id_kondisi INT UNSIGNED NOT NULL,
    kode_prasarana VARCHAR(50) NOT NULL,
    nama_prasarana VARCHAR(255) NOT NULL,
    jumlah_prasarana INT UNSIGNED NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    CONSTRAINT fk_prasarana_ruangan
        FOREIGN KEY (id_ruangan)
        REFERENCES ruangan(id_ruangan)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_prasarana_kondisi
        FOREIGN KEY (id_kondisi)
        REFERENCES kondisi(id_kondisi)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;