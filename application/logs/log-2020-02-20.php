<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-20 19:14:07 --> Severity: Notice --> Undefined variable: lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:14:07 --> Severity: Warning --> Invalid argument supplied for foreach() F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:16:30 --> Severity: Notice --> Undefined variable: lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:16:30 --> Severity: Warning --> Invalid argument supplied for foreach() F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:17:23 --> Severity: Notice --> Undefined variable: lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:17:23 --> Severity: Warning --> Invalid argument supplied for foreach() F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:23:21 --> Severity: Error --> Call to undefined method Pengadaan_model::get_lokasi_byuser() F:\xampp\htdocs\esarpras_rev\application\controllers\admin\Pengadaan.php 66
ERROR - 2020-02-20 19:23:39 --> Query error: Table 'esarpras_rev.m_lokasi' doesn't exist - Invalid query: SELECT a.* FROM m_lokasi as a LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin='1'
ERROR - 2020-02-20 19:23:56 --> Severity: Warning --> Invalid argument supplied for foreach() F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\add_data.php 61
ERROR - 2020-02-20 19:37:42 --> Severity: Parsing Error --> syntax error, unexpected '}', expecting ')' F:\xampp\htdocs\esarpras_rev\application\controllers\admin\Admin.php 91
