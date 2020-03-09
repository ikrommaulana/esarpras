<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-02-21 13:10:43 --> Severity: Notice --> Undefined offset: 0 F:\xampp\htdocs\esarpras_rev\application\models\admin\Pengadaan_model.php 104
ERROR - 2020-02-21 13:10:43 --> Severity: Notice --> Trying to get property of non-object F:\xampp\htdocs\esarpras_rev\application\models\admin\Pengadaan_model.php 104
ERROR - 2020-02-21 13:11:05 --> Severity: Notice --> Undefined offset: 0 F:\xampp\htdocs\esarpras_rev\application\models\admin\Pengadaan_model.php 105
ERROR - 2020-02-21 13:11:05 --> Severity: Notice --> Trying to get property of non-object F:\xampp\htdocs\esarpras_rev\application\models\admin\Pengadaan_model.php 105
ERROR - 2020-02-21 13:11:16 --> Severity: Notice --> Undefined offset: 0 F:\xampp\htdocs\esarpras_rev\application\models\admin\Pengadaan_model.php 105
ERROR - 2020-02-21 13:11:16 --> Severity: Notice --> Trying to get property of non-object F:\xampp\htdocs\esarpras_rev\application\models\admin\Pengadaan_model.php 105
ERROR - 2020-02-21 13:11:56 --> Query error: Unknown column '$id' in 'where clause' - Invalid query: select * from ci_admin where admin_id=$id
ERROR - 2020-02-21 13:18:49 --> Severity: Notice --> Undefined index: pegnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 67
ERROR - 2020-02-21 13:18:49 --> Severity: Notice --> Undefined index: labnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 68
ERROR - 2020-02-21 13:18:49 --> Severity: Notice --> Undefined index: sarprasnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 69
ERROR - 2020-02-21 13:18:49 --> Severity: Notice --> Undefined index: loklabkota F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 70
ERROR - 2020-02-21 13:18:49 --> Severity: Notice --> Undefined index: waktu F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 71
ERROR - 2020-02-21 13:19:37 --> Severity: Notice --> Undefined index: pegnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 67
ERROR - 2020-02-21 13:19:37 --> Severity: Notice --> Undefined index: labnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 68
ERROR - 2020-02-21 13:19:37 --> Severity: Notice --> Undefined index: waktu F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 71
ERROR - 2020-02-21 13:19:51 --> Severity: Notice --> Undefined index: pegnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 67
ERROR - 2020-02-21 13:19:51 --> Severity: Notice --> Undefined index: labnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 68
ERROR - 2020-02-21 13:19:51 --> Severity: Notice --> Undefined index: pengsarwak F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 71
ERROR - 2020-02-21 13:20:18 --> Severity: Notice --> Undefined index: pegnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 67
ERROR - 2020-02-21 13:20:18 --> Severity: Notice --> Undefined index: labnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 68
ERROR - 2020-02-21 13:20:37 --> Severity: Notice --> Undefined index: pegnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 67
ERROR - 2020-02-21 13:20:37 --> Severity: Notice --> Undefined index: labnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 68
ERROR - 2020-02-21 18:57:54 --> Severity: Notice --> Undefined index: pegnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 67
ERROR - 2020-02-21 18:57:54 --> Severity: Notice --> Undefined index: labnama F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 68
ERROR - 2020-02-21 19:06:11 --> Severity: Parsing Error --> syntax error, unexpected '' (T_ENCAPSED_AND_WHITESPACE), expecting identifier (T_STRING) or variable (T_VARIABLE) or number (T_NUM_STRING) F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 64
ERROR - 2020-02-21 19:11:11 --> Query error: Unknown column 'm_lab.pegnip' in 'on clause' - Invalid query: SELECT tb_personil_daftar.* ,m_lab.labnama FROM tb_personil_daftar LEFT JOIN m_lab ON tb_personil_daftar.pegnip=m_lab.pegnip WHERE tb_personil_daftar.pegnip=20191000
ERROR - 2020-02-21 19:11:26 --> Query error: Unknown column 'm_lab.pegnip' in 'on clause' - Invalid query: SELECT tb_personil_daftar.* ,m_lab.labnama FROM tb_personil_daftar LEFT JOIN m_lab ON tb_personil_daftar.pegnip=m_lab.pegnip WHERE tb_personil_daftar.pegnip=20191000
ERROR - 2020-02-21 19:13:36 --> Query error: Table 'esarpras_rev.m_lokasi' doesn't exist - Invalid query: SELECT a.* FROM m_lokasi as a LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin='3'
ERROR - 2020-02-21 19:16:07 --> Query error: Table 'esarpras_rev.m_lokasi' doesn't exist - Invalid query: SELECT a.* FROM m_lokasi as a LEFT JOIN tb_lokasi_unitkerja as b ON (a.id_lokasi = b.id_lokasi)
					LEFT JOIN m_pegawai as c ON (b.id_lokasi_unitkerja = c.id_lokasi_unitkerja)
					WHERE c.id_admin='3'
ERROR - 2020-02-21 19:19:59 --> Severity: Parsing Error --> syntax error, unexpected 'else' (T_ELSE) F:\xampp\htdocs\esarpras_rev\application\controllers\admin\Pengadaan.php 64
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: sarpras F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 35
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: spesifikasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 41
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: jumlah F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 47
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: tujuan F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 53
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: id_lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: id_lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: kode_lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: id_lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: id_lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: kode_lokasi F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 62
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: waktu F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 70
ERROR - 2020-02-21 19:20:16 --> Severity: Notice --> Undefined index: biaya F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\data_edit.php 76
ERROR - 2020-02-21 19:31:09 --> Severity: Notice --> Undefined index: admin_id F:\xampp\htdocs\esarpras_rev\application\views\admin\pengadaan\index.php 94
ERROR - 2020-02-21 22:57:19 --> 404 Page Not Found: admin/Pengadaan/viewPengadaan
ERROR - 2020-02-21 23:00:23 --> Severity: Warning --> Missing argument 1 for Pengadaan::viewPengadaan() F:\xampp\htdocs\esarpras_rev\application\controllers\admin\Pengadaan.php 152
ERROR - 2020-02-21 23:21:29 --> Severity: Notice --> Undefined variable: view F:\xampp\htdocs\esarpras_rev\application\views\layout.php 83
ERROR - 2020-02-21 23:21:36 --> Severity: Notice --> Undefined variable: view F:\xampp\htdocs\esarpras_rev\application\views\layout.php 83
ERROR - 2020-02-21 23:22:53 --> Severity: 4096 --> Object of class CI_Loader could not be converted to string F:\xampp\htdocs\esarpras_rev\application\controllers\admin\Pengadaan.php 157
ERROR - 2020-02-21 23:23:30 --> Severity: 4096 --> Object of class CI_Loader could not be converted to string F:\xampp\htdocs\esarpras_rev\application\controllers\admin\Pengadaan.php 157
