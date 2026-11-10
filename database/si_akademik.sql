CREATE DATABASE IF NOT EXISTS si_akademik CHARACTER SET utf8mb4;
USE si_akademik;

CREATE TABLE IF NOT EXISTS prodi (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS mahasiswa (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nim      VARCHAR(20)  NOT NULL UNIQUE,
    nama     VARCHAR(100) NOT NULL,
    email    VARCHAR(100) NULL,
    prodi_id INT NOT NULL,
    angkatan YEAR NOT NULL,
    FOREIGN KEY (prodi_id) REFERENCES prodi(id)
);

INSERT INTO prodi (nama) VALUES
 ('D4 Teknik Informatika'), ('D3 Manajemen Informatika'), ('D4 Bisnis Digital');

INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan) VALUES
 ('E41240001', 'Budi Santoso', 'budi@mail.com', 1, 2024),
 ('E41240002', 'Siti Aminah',  'siti@mail.com', 1, 2024),
 ('E41240003', 'Andi Pratama', 'andi@mail.com', 2, 2025);
