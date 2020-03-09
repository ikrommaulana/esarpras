<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-28 15:34:18 --> Query error: Table 'esarpras_dev.tb_unitkerja' doesn't exist - Invalid query: SELECT kode_unitkerja FROM tb_unitkerja as a
					LEFT JOIN m_pegawai as b ON (a.nip = b.nip)
					WHERE b.id_admin = '1'
ERROR - 2019-11-28 15:36:54 --> Query error: Unknown column 'a.id_sarpras' in 'on clause' - Invalid query: SELECT a.*, b.nama_jalan, b.kecamatan, b.kabupaten, b.provinsi,
					c.nama_pegawai, c.nip, d.nama_sarpras, d.spesifikasi
					FROM tb_pengadaan as a 
					LEFT JOIN m_lokasi as b ON (a.lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (a.id_pemohon = c.id_admin)
					LEFT JOIN tb_sarpras as d ON (a.id_sarpras = d.id)
					 ORDER BY created_date DESC
ERROR - 2019-11-28 15:41:45 --> Severity: Notice --> Undefined index: id_sarpras C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\data_edit.php 38
ERROR - 2019-11-28 15:41:45 --> Severity: Notice --> Undefined index: id_sarpras C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\data_edit.php 38
ERROR - 2019-11-28 15:41:45 --> Severity: Notice --> Undefined index: id_sarpras C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\data_edit.php 38
ERROR - 2019-11-28 15:43:40 --> Severity: Notice --> Undefined property: stdClass::$kode_unitkerja C:\xampp\htdocs\esarp-master\application\controllers\admin\Pengadaan.php 101
ERROR - 2019-11-28 15:49:48 --> Query error: Table 'esarpras_dev.tb_lokasi' doesn't exist - Invalid query: SELECT *
FROM `tb_lokasi`
ERROR - 2019-11-28 16:00:04 --> Severity: Notice --> Undefined index: nama_lokasi C:\xampp\htdocs\esarp-master\application\views\admin\pemeliharaan\add_data.php 102
ERROR - 2019-11-28 16:02:34 --> Severity: Notice --> Undefined property: stdClass::$kode_unitkerja C:\xampp\htdocs\esarp-master\application\controllers\admin\Pemeliharaan.php 58
