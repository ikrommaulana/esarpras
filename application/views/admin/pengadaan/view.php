<link rel="stylesheet" href="'.base_url().'/public/bootstrap/css/bootstrap.min.css">
<?php 
  $get_admin_personil = $this->db->query("SELECT ci_admin.* ,m_personil.pegnama FROM ci_admin LEFT JOIN m_personil ON ci_admin.pegnip=m_personil.pegnip WHERE ci_admin.admin_id=".$get_pengadaan['id_pemohon'])->result();
  $pegnama = (isset($get_admin_personil[0]->pegnama))? $get_admin_personil[0]->pegnama : set_value('pegnama');
  $pegnip = (isset($get_admin_personil[0]->pegnip))? $get_admin_personil[0]->pegnip : set_value('pegnip');

  $get_lab = $this->db->query("SELECT tb_personil_daftar.* ,m_lab.labnama FROM tb_personil_daftar LEFT JOIN m_lab ON tb_personil_daftar.idlab=m_lab.idlab WHERE tb_personil_daftar.pegnip=".$pegnip)->result();
  $labnama = (isset($get_lab[0]->labnama))? $get_lab[0]->labnama : set_value('labnama');

  $get_lokasi_lab = $this->db->query("SELECT* FROM tb_lokasi_lab WHERE loklabid=".$get_pengadaan['loklabid'])->result();
  $loklabkota = (isset($get_lokasi_lab[0]->loklabkota))? $get_lokasi_lab[0]->loklabkota : set_value('loklabkota');

  if($get_pengadaan['respon_L1']=='Y') {
    $getL1 = $this->db->query('select * from ci_admin a join m_personil b on a.pegnip=b.pegnip where a.admin_id='.$get_pengadaan['L1'])->result();
    $namaL1 = $getL1[0]->pegnama;
    $respon1 = "<span class='label label-success' data-toggle='tooltip' data-placement='top'>Approved</span>";
    $note1 = $get_pengadaan['note_L1'];
  } else if($get_pengadaan['respon_L1']=='N') {
    $getL1 = $this->db->query('select * from ci_admin a join m_personil b on a.pegnip=b.pegnip where a.admin_id='.$get_pengadaan['L1'])->result();
    $namaL1 = $getL1[0]->pegnama;
    $respon1 = "<span class='label label-danger' data-toggle='tooltip' data-placement='top'>Revised</span>";
    $note1 = $get_pengadaan['note_L1'];
  } else {
    $namaL1 = '';
    $respon1 = "<span class='label label-warning'>Process</span>";
    $note1 = '';
  }

  if($get_pengadaan['respon_L2']=='Y') {
    $getL2 = $this->db->query('select * from ci_admin a join m_personil b on a.pegnip=b.pegnip where a.admin_id='.$get_pengadaan['2'])->result();
    $namaL2 = $get2[0]->pegnama;
    $respon2 = "<span class='label label-success' data-toggle='tooltip' data-placement='top'>Approved</span>";
    $note2 = $get_pengadaan['note_L2'];
  } else if($get_pengadaan['respon_L2']=='N') {
    $getL2 = $this->db->query('select * from ci_admin a join m_personil b on a.pegnip=b.pegnip where a.admin_id='.$get_pengadaan['2'])->result();
    $namaL2 = $get2[0]->pegnama;
    $respon2 = "<span class='label label-danger' data-toggle='tooltip' data-placement='top'>Revised</span>";
    $note2 = $get_pengadaan['note_L2'];
  } else {
    $namaL2 = '';
    $respon2 = "<span class='label label-warning'>Process</span>";
    $note2 = '';
  }


$date_L1 = (isset($get_pengadaan['date_L1']))? date('d F Y', strtotime($get_pengadaan['date_L1'])): set_value('date_L1');
$date_L2 = (isset($get_pengadaan['date_L2']))? date('d F Y', strtotime($get_pengadaan['date_L2'])): set_value('date_L2');

 ?>
            <div class="row"><div class="col-sm-12">
              <table id="menu_table" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <td>Nama Pemohon</td>
                    <td><?=$pegnama;?></td>
                  </tr>
                  <tr>
                    <td>Nama Sarpras</td>
                    <td><?=$get_pengadaan['pengsarnama'];?></td>
                  </tr>
                  <tr>
                    <td>Spesifikasi</td>
                    <td><?=$get_pengadaan['pengsarspes'];?></td>
                  </tr>
                  <tr>
                    <td>Jumlah</td>
                    <td><?=$get_pengadaan['pengsarjum'];?></td>
                  </tr>
                  <tr>
                    <td>Tujuan</td>
                    <td><?=$get_pengadaan['pengsartuj'];?></td>
                  </tr>
                  <tr>
                    <td>Lokasi</td>
                    <td><?=$loklabkota;?></td>
                  </tr>
                  <tr>
                    <td>Laboratorium</td>
                    <td><?=$labnama;?></td>
                  </tr>
                  <tr>
                    <td>Waktu</td>
                    <td><?=date('d F Y', strtotime($get_pengadaan['loklabwak']));?></td>
                  </tr>
                  <tr>
                    <td>Biaya</td>
                    <td><?=number_format($get_pengadaan['loklabbia'],0,',','.');?></td>
                  </tr>
                  <tr>
                    <td>Respon L1</td>
                    <td><?=$respon1?><br/><p style="margin:0px;margin-top:5px"><?=$note1?></p></td>
                  </tr>
                  <tr>
                    <td>L1</td>
                    <td><?=$namaL1?> | <?=$date_L1?></td>
                  </tr>
                  <tr>
                    <td>Respon L2</td>
                    <td><?=$respon2?><br/><p style="margin:0px;margin-top:5px"><?=$note2?></p></td>
                  </tr>
                  <tr>
                    <td>L2</td>
                    <td><?=$namaL2?> | <?=$date_L2?></td>
                  </tr>
                </thead>
              </table>
            </div></div>
                  