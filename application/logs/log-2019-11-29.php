<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-29 14:44:25 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\add_data.php 68
ERROR - 2019-11-29 14:45:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'asc ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin=''' at line 2 - Invalid query: SELECT a.* FROM m_lokasi as a LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai asc ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin=''
ERROR - 2019-11-29 14:48:23 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\add_data.php 68
ERROR - 2019-11-29 14:50:31 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\add_data.php 68
ERROR - 2019-11-29 14:51:03 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\add_data.php 68
ERROR - 2019-11-29 14:53:31 --> Query error: Unknown table 'esarpras_dev.a' - Invalid query: SELECT a.* FROM m_lokasi asa LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin='1'
ERROR - 2019-11-29 14:53:40 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp\htdocs\esarp-master\application\views\admin\pengadaan\add_data.php 68
ERROR - 2019-11-29 15:37:54 --> Query error: Table 'esarpras_dev.tb_lokasi' doesn't exist - Invalid query: SELECT *
FROM `tb_lokasi`
ERROR - 2019-11-29 15:44:18 --> Severity: Notice --> Undefined index: id C:\xampp\htdocs\esarp-master\application\views\admin\penggunaan\index.php 47
ERROR - 2019-11-29 16:01:36 --> Severity: Notice --> Undefined property: stdClass::$kode_unitkerja C:\xampp\htdocs\esarp-master\application\controllers\admin\Pemeliharaan.php 58
ERROR - 2019-11-29 16:02:14 --> Query error: Unknown column 'a.id_lokasi_unitkerja' in 'on clause' - Invalid query: SELECT id_unitkerja FROM tb_lokasi_unitkerja asa
					LEFT JOIN m_pegawai as b ON (a.id_lokasi_unitkerja = b.id_lokasi_unitkerja)
					WHERE b.id_admin = '1'
ERROR - 2019-11-29 16:17:45 --> Query error: Table 'esarpras_dev.tb_lokasi' doesn't exist - Invalid query: SELECT *
FROM `tb_lokasi`
ERROR - 2019-11-29 16:38:25 --> Severity: Notice --> Undefined variable: pemeliharaan C:\xampp\htdocs\esarp-master\application\views\admin\pemeliharaan\data_export.php 96
ERROR - 2019-11-29 16:38:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\esarp-master\application\views\admin\pemeliharaan\data_export.php 96
ERROR - 2019-11-29 23:44:37 --> Severity: Notice --> Undefined index: fungsi C:\xampp\htdocs\esarp-master\application\views\admin\penggunaan\add_data.php 57
ERROR - 2019-11-29 23:44:37 --> Severity: Notice --> Undefined index: durasi C:\xampp\htdocs\esarp-master\application\views\admin\penggunaan\add_data.php 58
