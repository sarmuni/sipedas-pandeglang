/*
SQLyog Ultimate v10.3 
MySQL - 5.5.5-10.4.18-MariaDB : Database - sipedas_pandeglang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sipedas_pandeglang` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sipedas_pandeglang`;

/*Table structure for table `anggaran` */

DROP TABLE IF EXISTS `anggaran`;

CREATE TABLE `anggaran` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(15) DEFAULT NULL,
  `nama_akun` varchar(100) DEFAULT NULL,
  `kode_opd` varbinary(100) DEFAULT NULL,
  `tahun_anggaran` year(4) DEFAULT NULL,
  `jan` double(15,2) DEFAULT NULL,
  `feb` double(15,2) DEFAULT NULL,
  `mar` double(15,2) DEFAULT NULL,
  `apr` double(15,2) DEFAULT NULL,
  `mei` double(15,2) DEFAULT NULL,
  `jun` double(15,2) DEFAULT NULL,
  `jul` double(15,2) DEFAULT NULL,
  `ags` double(15,2) DEFAULT NULL,
  `sep` double(15,2) DEFAULT NULL,
  `okt` double(15,2) DEFAULT NULL,
  `nov` double(15,2) DEFAULT NULL,
  `des` double(15,2) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `creted_user` varchar(100) DEFAULT NULL,
  `update_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `anggaran` */

insert  into `anggaran`(`id`,`kode_akun`,`nama_akun`,`kode_opd`,`tahun_anggaran`,`jan`,`feb`,`mar`,`apr`,`mei`,`jun`,`jul`,`ags`,`sep`,`okt`,`nov`,`des`,`keterangan`,`created_date`,`update_date`,`creted_user`,`update_user`) values (1,'0001','Pemeliharaan Kendaraan Dinas','0002',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,'2022-05-07 18:11:47',NULL,'sarmuni@gmail.com'),(3,'0001','Pemeliharaan Kendaraan Dinas','0003',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(4,'0001','Pemeliharaan Kendaraan Dinas','0004',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(5,'0001','Pemeliharaan Kendaraan Dinas','0005',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(6,'0001','Pemeliharaan Kendaraan Dinas','0006',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(7,'0001','Pemeliharaan Kendaraan Dinas','0007',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(8,'0001','Pemeliharaan Kendaraan Dinas','0008',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(9,'0001','Pemeliharaan Kendaraan Dinas','0009',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(10,'0001','Pemeliharaan Kendaraan Dinas','0010',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(11,'0001','Pemeliharaan Kendaraan Dinas','0011',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(12,'0001','Pemeliharaan Kendaraan Dinas','0012',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(13,'0001','Pemeliharaan Kendaraan Dinas','0013',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(14,'0001','Pemeliharaan Kendaraan Dinas','0014',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(15,'0001','Pemeliharaan Kendaraan Dinas','0015',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(16,'0001','Pemeliharaan Kendaraan Dinas','0016',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(17,'0001','Pemeliharaan Kendaraan Dinas','0017',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(18,'0001','Pemeliharaan Kendaraan Dinas','0018',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(19,'0001','Pemeliharaan Kendaraan Dinas','0019',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(20,'0001','Pemeliharaan Kendaraan Dinas','0020',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(21,'0001','Pemeliharaan Kendaraan Dinas','0021',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(22,'0001','Pemeliharaan Kendaraan Dinas','0022',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(23,'0001','Pemeliharaan Kendaraan Dinas','0023',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(24,'0001','Pemeliharaan Kendaraan Dinas','0024',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(25,'0001','Pemeliharaan Kendaraan Dinas','0025',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(26,'0001','Pemeliharaan Kendaraan Dinas','0026',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(27,'0001','Pemeliharaan Kendaraan Dinas','0027',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(28,'0001','Pemeliharaan Kendaraan Dinas','0028',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(29,'0001','Pemeliharaan Kendaraan Dinas','0029',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(30,'0001','Pemeliharaan Kendaraan Dinas','0001',2022,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,'tes',NULL,NULL,NULL,NULL),(31,'0001','Pemeliharaan Kendaraan Dinas','0002',2023,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,NULL,'2022-05-07 15:38:36','2022-05-07 15:39:05','sarmuni@gmail.com','sarmuni@gmail.com'),(32,'0001','Pemeliharaan Kendaraan Dinas','0002',2024,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,NULL,'2022-05-07 18:12:35','2022-05-07 18:14:49','sarmuni@gmail.com','sarmuni@gmail.com'),(33,'0001','Pemeliharaan Kendaraan Dinas','0001',2024,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,NULL,'2022-05-07 18:16:07','2022-05-07 18:18:37','admin@gmail.com','admin@gmail.com'),(34,'0001','Pemeliharaan Kendaraan Dinas1','0001',2020,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,1000000.00,NULL,'2022-05-07 18:19:30',NULL,'admin@gmail.com',NULL);

/*Table structure for table `jenis_assets` */

DROP TABLE IF EXISTS `jenis_assets`;

CREATE TABLE `jenis_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_assets` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_assets` */

insert  into `jenis_assets`(`id`,`nama_assets`) values (1,'Mobil (Roda 4)'),(2,'Motor (Roda 2)');

/*Table structure for table `jenis_bahan_bakar` */

DROP TABLE IF EXISTS `jenis_bahan_bakar`;

CREATE TABLE `jenis_bahan_bakar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bahan_bakar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_bahan_bakar` */

insert  into `jenis_bahan_bakar`(`id`,`nama_bahan_bakar`) values (1,'Bensin'),(2,'Solar'),(3,'Listrik'),(4,'Pertalite'),(5,'Pertamax'),(6,'Pertamax Dex');

/*Table structure for table `jenis_kendaraan` */

DROP TABLE IF EXISTS `jenis_kendaraan`;

CREATE TABLE `jenis_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_kendaraan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_kendaraan` */

insert  into `jenis_kendaraan`(`id`,`nama_jenis_kendaraan`) values (1,'Toyota'),(2,'Mitsubishi'),(3,'Honda'),(4,'Suzuki'),(5,'Yamaha'),(6,'Mercedes'),(7,'BMW');

/*Table structure for table `jenis_perawatan` */

DROP TABLE IF EXISTS `jenis_perawatan`;

CREATE TABLE `jenis_perawatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_perawatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jenis_perawatan` */

insert  into `jenis_perawatan`(`id`,`nama_jenis_perawatan`) values (1,'Pengisian BBM'),(2,'Service Rutin'),(3,'Perbaikan'),(4,'Penggantian'),(5,'Bayar Pajak');

/*Table structure for table `kendaraan` */

DROP TABLE IF EXISTS `kendaraan`;

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_qr` varchar(100) DEFAULT NULL,
  `kode_opd` varchar(100) DEFAULT NULL,
  `nomor_polisi` varchar(100) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `pengguna_kendaraan` varchar(100) DEFAULT NULL,
  `jenis_assets` int(11) DEFAULT NULL,
  `id_merek` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `tahun_pembuatan` varchar(100) DEFAULT NULL,
  `silinder` varchar(100) DEFAULT NULL,
  `nomor_rangka` varchar(100) DEFAULT NULL,
  `nomor_mesin` varchar(100) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL,
  `id_bahan_bakar` int(11) DEFAULT NULL,
  `warna_tnkb` varchar(100) DEFAULT NULL,
  `tahun_registrasi` year(4) DEFAULT NULL,
  `nomor_bpkb` varchar(100) DEFAULT NULL,
  `tanggal_berlaku` date DEFAULT NULL,
  `berat_kb` varchar(100) DEFAULT NULL,
  `jumlah_sumbu` varchar(100) DEFAULT NULL,
  `jbb_penumpang` varchar(100) DEFAULT NULL,
  `gambar_depan` varchar(100) DEFAULT 'mobil-depan.png',
  `gambar_belakang` varchar(100) DEFAULT 'mobil-belakang.png',
  `gambar_samping_kiri` varchar(100) DEFAULT 'mobil-kiri.png',
  `gambar_samping_kanan` varchar(100) DEFAULT 'mobil-kanan.png',
  `harga_pembelian` varchar(100) DEFAULT NULL,
  `tahun_penyusutan` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kendaraan` */

insert  into `kendaraan`(`id`,`kode_qr`,`kode_opd`,`nomor_polisi`,`nama_pemilik`,`alamat`,`pengguna_kendaraan`,`jenis_assets`,`id_merek`,`type`,`jenis`,`model`,`tahun_pembuatan`,`silinder`,`nomor_rangka`,`nomor_mesin`,`warna`,`id_bahan_bakar`,`warna_tnkb`,`tahun_registrasi`,`nomor_bpkb`,`tanggal_berlaku`,`berat_kb`,`jumlah_sumbu`,`jbb_penumpang`,`gambar_depan`,`gambar_belakang`,`gambar_samping_kiri`,`gambar_samping_kanan`,`harga_pembelian`,`tahun_penyusutan`,`keterangan`,`created_date`,`created_user`,`update_date`,`update_by`) values (1,'OPD-KND0705220001','0002','A 1234 AZ','Dinas Prov Banten','Kabupaten Pandeglang','Kepala Bagian',1,2,'Pajero Sport','Mini Bus','Exceed','2020','8','HJANl9200JHGS6851398','JKAH23999','Hitam',1,'Merah',2020,'JUK-323-KLAP','2022-05-07','2000','2','7','mobil-depan.png','mobil-belakang.png','mobil-kiri.png','mobil-kanan.png','500000000',10,'tes2','2022-05-07 21:52:40','sarmuni@gmail.com','2022-05-07 17:16:13','sarmuni@gmail.com'),(2,'OPD-KND0705220002','0001','A 1112 HB','Dinas Prov Banten','Kabupaten Pandeglang','Kepala Bagian',1,2,'Pajero Sport','Mini Bus','Exceed','2020','8','HJANl9200JHGS6851398','JKAH23999','Hitam',2,'Merah',2020,'JUK-323-KLAP','2022-05-07','2000','20','7','mobil-depan.png','mobil-belakang.png','mobil-kiri.png','mobil-kanan.png','500000000',10,'tes','2022-05-07 22:17:59','admin@gmail.com','2022-05-07 18:22:40','admin@gmail.com'),(3,'OPD-KND0705220003','0002','A 1512 XD','Dinas Prov Banten','Kabupaten Pandeglang','Kepala Bagian',1,2,'Pajero Sport','Mini Bus','Exceed','2020','8','HJANl9200JHGS6851398','JKAH23999','Hitam',2,'Merah',2020,'JUK-323-KLAP','2022-05-07','2000','2','7','mobil-depan.png','mobil-belakang.png','mobil-kiri.png','mobil-kanan.png','500000000',10,'tes2','2022-05-07 23:23:39','admin@gmail.com',NULL,NULL);

/*Table structure for table `master_opd` */

DROP TABLE IF EXISTS `master_opd`;

CREATE TABLE `master_opd` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `kode_opd` varchar(100) DEFAULT NULL,
  `nama_opd` varchar(250) DEFAULT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `telpon` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_opd` */

insert  into `master_opd`(`id`,`kode_opd`,`nama_opd`,`alamat`,`telpon`,`created_date`,`created_by`,`update_date`,`update_by`) values (1,'0001','Kabupaten Pandeglang','Kabupaten Pandeglang','085711899949',NULL,NULL,'2022-05-07 14:17:25','admin@gmail.com'),(2,'0002','Dinas Kependudukan dan Pencatatan Sipil','Kabupaten Pandeglang','085711899949',NULL,NULL,NULL,NULL),(3,'0003','Dinas Sosial',NULL,NULL,NULL,NULL,NULL,NULL),(4,'0004','Dinas Pendidikan, Kepemudaan dan Olahraga',NULL,NULL,NULL,NULL,NULL,NULL),(5,'0005','Dinas Kesehatan',NULL,NULL,NULL,NULL,NULL,NULL),(6,'0006','RSUD Berkah',NULL,NULL,NULL,NULL,NULL,NULL),(7,'0007','DP2KBP3A',NULL,NULL,NULL,NULL,NULL,NULL),(8,'0008','Dinas Tenaga Kerja dan Transmigrasi',NULL,NULL,NULL,NULL,NULL,NULL),(9,'0009','Dinas Pemberdayaan Masyarakat dan Pemerintahan Desa',NULL,NULL,NULL,NULL,NULL,NULL),(10,'0010','Badan Perencanaan Pembangunan Daerah',NULL,NULL,NULL,NULL,NULL,NULL),(11,'0011','Dinas Pertanian dan Ketahanan Pangan',NULL,NULL,NULL,NULL,NULL,NULL),(12,'0012','Dinas Perikanan',NULL,NULL,NULL,NULL,NULL,NULL),(13,'0013','Dinas Koperasi, UMKM, Perindustrian dan Perdagangan',NULL,NULL,NULL,NULL,NULL,NULL),(14,'0014','Dinas Lingkungan Hidup',NULL,NULL,NULL,NULL,NULL,NULL),(15,'0015','Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',NULL,NULL,NULL,NULL,NULL,NULL),(16,'0016','Satuan Polisi Pamong Praja',NULL,NULL,NULL,NULL,NULL,NULL),(17,'0017','Dinas Perhubungan',NULL,NULL,NULL,NULL,NULL,NULL),(18,'0018','Dinas Pekerjaan Umum dan penataan Ruang',NULL,NULL,NULL,NULL,NULL,NULL),(19,'0019','Dinas Perumahan Kawasan Permukiman dan Pertanahan',NULL,NULL,NULL,NULL,NULL,NULL),(20,'0020','Dinas Pariwisata dan Kebudayaan',NULL,NULL,NULL,NULL,NULL,NULL),(21,'0021','Dinas Komunikasi, Informatika, Sandi dan Statistik',NULL,NULL,NULL,NULL,NULL,NULL),(22,'0022','Dinas Perpustakaan dan Arsip Daerah',NULL,NULL,NULL,NULL,NULL,NULL),(23,'0023','Sekretariat Daerah',NULL,NULL,NULL,NULL,NULL,NULL),(24,'0024','Sekretariat DPRD',NULL,NULL,NULL,NULL,NULL,NULL),(25,'0025','Inspektorat Daerah',NULL,NULL,NULL,NULL,NULL,NULL),(26,'0026','Badan Pengelolaan Keuangan Daerah',NULL,NULL,NULL,NULL,NULL,NULL),(27,'0027','Badan Pendapatan Daerah',NULL,NULL,NULL,NULL,NULL,NULL),(28,'0028','Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',NULL,NULL,NULL,NULL,NULL,NULL),(29,'0029','Badan Kesatuan Bangsa dan Politik',NULL,NULL,NULL,NULL,NULL,NULL),(30,'0030','Badan Penanggulangan Bencana Daerah dan Pemadam Kebakaran',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `nota_dinas` */

DROP TABLE IF EXISTS `nota_dinas`;

CREATE TABLE `nota_dinas` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `kode_opd` varchar(100) DEFAULT NULL,
  `nomor_nota_dinas` varchar(50) DEFAULT NULL,
  `kepada` varchar(250) DEFAULT NULL,
  `dari` varchar(250) DEFAULT NULL,
  `tanggal_permohonan` date DEFAULT NULL,
  `perihal` varchar(250) DEFAULT NULL,
  `no_polisi` varchar(100) DEFAULT NULL,
  `rincian_penggantian` longtext DEFAULT NULL,
  `dokumen` varchar(500) DEFAULT NULL,
  `vendor` int(100) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  `update_user` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `nota_dinas` */

insert  into `nota_dinas`(`id`,`kode_opd`,`nomor_nota_dinas`,`kepada`,`dari`,`tanggal_permohonan`,`perihal`,`no_polisi`,`rincian_penggantian`,`dokumen`,`vendor`,`status`,`keterangan`,`created_date`,`update_date`,`created_user`,`update_user`,`code`) values (1,'0002','025/11-Umum/IV-BPKAD/2023','Sekban Cq. Kasubag Umum1','Kasubit Perencanan','2022-05-07','Permohonan Service Kendaraan','A 1512 XD','1. Services Kendaraan\r\n2. Ganti Kaki-kaki','Surat_Pengantar_-_024_11-Umum_IV-BPKAD_20225.pdf',1,2,NULL,'2022-05-07 18:51:07','2022-05-07 19:05:41','sarmuni@gmail.com','sarmuni@gmail.com',NULL);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `nomor_polisi` varchar(100) DEFAULT NULL,
  `tanggal_perawatan` date DEFAULT NULL,
  `jenis_perawatan` int(11) DEFAULT NULL,
  `kilometer_kendaraan` varchar(100) DEFAULT NULL,
  `kode_akun` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `code_transaksi` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `harga` double(15,2) DEFAULT NULL,
  `jumlah` double(15,2) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi_detail` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opd` varchar(100) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`opd`,`name`,`email`,`image`,`password`,`role_id`,`is_active`,`date_created`) values (5,'0001','Administrator','admin@gmail.com','pandeglang.png','$2y$10$k1BAyFBwb2WYWpO.LOiBaOMcpDOCW8nprZGAFKL/4IuALW/b692DW',1,1,1552120289),(6,'0002','Sarmuni','sarmuni@gmail.com','pandeglang1.png','$2y$10$l0Cui170D2toSh6Pyp8QN.NNqhotAQldazPEHGBWYqpbvGR2Yl9fa',2,1,1552285263);

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values (1,1,1),(3,2,2),(7,1,3),(8,1,2),(15,3,6),(16,3,5),(17,3,3),(18,3,2),(19,6,2),(20,6,5),(21,6,6),(22,12,2),(23,12,5),(24,12,6),(27,1,8),(28,2,8),(29,1,9),(30,2,9),(32,1,7),(34,2,7);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`,`icon`) values (1,'Admin','fas fa-fw fa-tachometer-alt'),(2,'User','fas fa-fw fa-user'),(3,'Menu','fas fa-fw fa-cog'),(7,'Master','fas fa-fw fa-wrench'),(8,'Transaksi','fas fa-fw fa-chart-area'),(9,'Laporan','fas fa-fw fa-table');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values (1,'Administrator'),(2,'User');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`url`,`icon`,`is_active`) values (1,1,'Dashboard','admin','fas fa-fw fa-tachometer-alt',1),(2,2,'My Profile','user','fas fa-fw fa-user',1),(3,2,'Edit Profile','user/edit','fas fa-fw fa-user-edit',1),(4,3,'Menu Management','menu','fas fa-fw fa-folder',1),(5,3,'Submenu Management','menu/submenu','fas fa-fw fa-folder-open',1),(7,1,'Role','admin/role','fas fa-fw fa-user-tie',1),(8,2,'Change Password','user/changepassword','fas fa-fw fa-key',1),(11,7,'Jenis Kendaraan','master/kendaraan','fas fa-fw fa-car',1),(12,7,'Jenis Perawatan','master/perawatan','fas fa-fw fa-car',1),(13,7,'Jenis Bahan Bakar','master/bahan_bakar','fas fa-fw fa-car',1),(14,8,'Transaksi','transaksi','fas fa-fw fa-car',1),(15,8,'Kendaraan','transaksi/kendaraan','fas fa-fw fa-car',1),(16,9,'Laporan','laporan','fas fa-fw fa-car',1),(17,8,'Nota Dinas','transaksi/nota_dinas','fas fa-fw fa-user',1),(18,7,'Vendor/Penyedia','master/vendor','fas fa-fw fa-user',1),(19,7,'Anggaran Perawatan','master/anggaran','fas fa-fw fa-user',1),(20,2,'OPD/Instansi','user/opd','fas fa-fw fa-user',1);

/*Table structure for table `user_token` */

DROP TABLE IF EXISTS `user_token`;

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user_token` */

insert  into `user_token`(`id`,`email`,`token`,`date_created`) values (1,'admin@gmail.com','9FdmxtR2DDzrv07AXmiHO7k1MdTKwrGaCuaAofSaXGg=',1650730214);

/*Table structure for table `vendor` */

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(250) DEFAULT NULL,
  `alamat` varchar(500) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `created_user` varchar(100) DEFAULT NULL,
  `update_user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `vendor` */

insert  into `vendor`(`id`,`nama_vendor`,`alamat`,`no_telp`,`created_date`,`update_date`,`created_user`,`update_user`) values (1,'PT. Auto 2000','Tembong','0857118994',NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
