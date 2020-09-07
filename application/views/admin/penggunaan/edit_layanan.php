<?php
$layanan_lab = $this->db->query('select * from tb_layanan_lab where daflayid="'.$data['daflayid'].'"')->result_array();
$mitra = $this->master_model->get_master('m_mitra');
$penggunaan_ruangan = $this->db->query('select * from tb_penggunaan_ruangan where lanjasid="'.$data['lanjasidpermohonan'].'" and is_active=1 order by created_at asc')->result_array();
$penggunaan_peralatan = $this->db->query('select * from tb_penggunaan_peralatan where lanjasid="'.$data['lanjasidpermohonan'].'" and is_active=1 order by created_at asc')->result_array();
$tenaga = $this->db->query('select * from tb_tenaga_ahli where lanjasid="'.$data['lanjasidpermohonan'].'" and is_active=1 order by created_at asc')->result_array();
$hasil = $this->db->query('select * from tb_hasil_penelitian where lanjasid="'.$data['lanjasidpermohonan'].'" and is_active=1 order by created_at asc')->result_array();
?>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-12">
          <h4><i class="fa fa-list"></i> &nbsp; <?='[Layanan Jasa Laboratorium] '.$data['lanjasketlay'];?> </h4>
        </div>
        
      </div>
    </div>
  </div>


   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Layanan Jasa</a></li>
              <li><a href="#tab_2" data-toggle="tab">Penggunaan Ruangan</a></li>
              <li><a href="#tab_3" data-toggle="tab">Penggunaan Peralatan</a></li>
              <li><a href="#tab_4" data-toggle="tab">Tenaga Ahli</a></li>
              <li><a href="#tab_5" data-toggle="tab">Hasil Penelitian</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box-body col-md-10">
                    <?php if(isset($msg) || validation_errors() !== ''): ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?= validation_errors();?>
                            <?= isset($msg)? $msg: ''; ?>
                        </div>
                      <?php endif; ?>
       
                    <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['lanjasidpermohonan']), 'class="form-horizontal"' )?> 
                    <div class="form-group">
                      <label for="DaflayId" class="col-sm-3 control-label">Nama Layanan</label>
                      <div class="col-sm-9">
                        <select name="DaflayId" class="form-control">
                          <option value="<?=$layanan_lab[0]['daflayid'];?>"><?=$layanan_lab[0]['daflaynama'];?></option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasKetLay" class="col-sm-3 control-label">Keterangan</label>
                      <div class="col-sm-9">
                        <input type="text" name="LanjasKetLay" class="form-control" id="LanjasKetLay" value="<?=$data['lanjasketlay'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasPemohon" class="col-sm-3 control-label">Pemohon</label>
                      <div class="col-sm-9">
                        <input type="text" name="LanjasPemohon" class="form-control" id="LanjasPemohon" value="<?=$data['lanjaspemohon'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasInstansi" class="col-sm-3 control-label">Instansi</label>
                      <div class="col-sm-9">
                        <input type="text" name="LanjasInstansi" class="form-control" id="LanjasInstansi" value="<?=$data['lanjasinstansi'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasPIC" class="col-sm-3 control-label">PIC</label>
                      <div class="col-sm-9">
                        <input type="text" name="LanjasPIC" class="form-control" id="LanjasPIC" value="<?=$data['lanjaspic'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasAlamat" class="col-sm-3 control-label">Alamat</label>
                      <div class="col-sm-9">
                        <input type="text" name="LanjasAlamat" class="form-control" id="LanjasAlamat" value="<?=$data['lanjasalamat'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasTelepon" class="col-sm-3 control-label">Telepon</label>
                      <div class="col-sm-9">
                        <input type="number" name="LanjasTelepon" class="form-control" id="LanjasTelepon" value="<?=$data['lanjastelepon'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="LanjasEmail" class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-9">
                        <input type="text" name="LanjasEmail" class="form-control" id="LanjasEmail" value="<?=$data['lanjasemail'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraSatu" class="col-sm-3 control-label">Mitra 1</label>
                      <div class="col-sm-9">
                        <select name="MitraSatu" class="form-control">
                          <option>Pilih Mitra</option>
                          <?php foreach($mitra as $row){?>
                          <option value="<?=$row->mitra_id;?>" <?=$data['mitra1']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst.' ['.$row->mitrakat.']';?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraDua" class="col-sm-3 control-label">Mitra 2</label>
                      <div class="col-sm-9">
                        <select name="MitraDua" class="form-control">
                          <option>Pilih Mitra</option>
                          <?php foreach($mitra as $row){?>
                          <option value="<?=$row->mitra_id;?>" <?=$data['mitra2']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst.' ['.$row->mitrakat.']';?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraTiga" class="col-sm-3 control-label">Mitra 3</label>
                      <div class="col-sm-9">
                        <select name="MitraTiga" class="form-control">
                          <option>Pilih Mitra</option>
                          <?php foreach($mitra as $row){?>
                          <option value="<?=$row->mitra_id;?>" <?=$data['mitra3']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst.' ['.$row->mitrakat.']';?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <input type="submit" name="submitLayanan" value="Simpan Perubahan" class="btn btn-info pull-right">
                      </div>
                    </div>
                  <?php echo form_close( ); ?>
              </div>
            </div>
          </div>
        </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-md-12">
                    <table id="" class="table table-bordered table-striped ">
                      <thead>
                        <tr>
                          <th>#ID</th>
                          <th>Layanan</th>
                          <th>Sarpras</th>
                          <th>Pemesan</th>
                          <th>Kegiatan</th>
                          <th>Mulai</th>
                          <th>Selesai</th>
                          <th>Internal</th>
                          <th>Eksternal</th>
                          <th width="100" class="text-center">Action</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                          <?php $i=0; foreach($penggunaan_ruangan as $row): 
                          $lanjasketlay = $this->db->query('SELECT * FROM tb_layanan_lab_eks WHERE lanjasidpermohonan="'.$row['lanjasid'].'"')->result()[0]->lanjasketlay;
                          $sarnama = $this->db->query('SELECT * FROM tb_sarpras_lab WHERE sarid="'.$row['sarid'].'"')->result()[0]->sarnama;
                          ?>
                          <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $layanan_lab[0]['daflaynama']; ?></td>
                            <td><?= $sarnama; ?></td>
                            <td><?=$row['rgnpemesan'];?></td>
                            <td><?=$row['rgnkegiatan'];?></td>
                            <td><?= date('d M Y',strtotime($row['rgntglmul'])); ?> <?= date('H:i',strtotime($row['rgnjammul'])); ?></td>
                            <td><?= date('d M Y',strtotime($row['rgntglsel'])); ?> <?= date('H:i',strtotime($row['rgnjamsel'])); ?></td>
                            <td><?=$row['rgnpmkint'];?></td>
                            <td><?=$row['rgnpmkekt'];?></td>
                            <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/penggunaan_ruangan/edit/'.$row['rgnid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                   <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/penggunaan_ruangan/delete/'.$row['rgnid']).'/'.$row['lanjasid'].'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?= base_url("admin/penggunaan_ruangan/add/".$data['lanjasidpermohonan']); ?>" name="addPengRgn" class="btn btn-info pull-right">Tambah Penggunaan Ruangan</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
               <div class="row">
                  <div class="col-md-12">
                    <table id="" class="table table-bordered table-striped ">
                     <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Layanan</th>
                        <th>Sarpras</th>
                        <th>Pemesan</th>
                        <th>Kegiatan</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Internal</th>
                        <th>Eksternal</th>
                        <th width="100" class="text-center">Action</th>
                        
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($penggunaan_peralatan as $row): 
                        $lanjasketlay = $this->db->query('SELECT * FROM tb_layanan_lab_eks WHERE lanjasidpermohonan="'.$row['lanjasid'].'"')->result()[0]->lanjasketlay;
                        $sarnama = $this->db->query('SELECT * FROM tb_sarpras_lab WHERE sarid="'.$row['sarid'].'"')->result()[0]->sarnama;
                        ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $lanjasketlay; ?></td>
                          <td><?= $sarnama; ?></td>
                          <td><?= $row['prtpemesan'] ?></td>
                          <td><?= $row['prtkegiatan'] ?></td>
                          <td><?= date('d M Y',strtotime($row['prttglmul'])); ?> <?= date('H:i',strtotime($row['prtjammul'])); ?></td>
                          <td><?= date('d M Y',strtotime($row['prttglsel'])); ?> <?= date('H:i',strtotime($row['prtjamsel'])); ?></td>
                          <td><?= $row['prtpmkint'] ?></td>
                          <td><?= $row['prtpmkekt'] ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/penggunaan_peralatan/edit/'.$row['prtid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/penggunaan_peralatan/delete/'.$row['prtid']).'/'.$row['lanjasid'].'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/penggunaan_peralatan/add/".$data['lanjasidpermohonan']); ?>" name="PengPrt" class="btn btn-info pull-right">Tambah Penggunaan Peralatan</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4">
               <div class="row">
                  <div class="col-md-12">
                    <table id="" class="table table-bordered table-striped ">
                     <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Layanan</th>
                        <th>Pegawai</th>
                        <th>Komp.Pendidikan</th>
                        <th>Komp.Training</th>
                        <th>Peran</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th width="100" class="text-center">Action</th>
                        
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($tenaga as $row): 
                        $lanjasketlay = $this->db->query('SELECT * FROM tb_layanan_lab_eks WHERE lanjasidpermohonan="'.$row['lanjasid'].'"')->result()[0]->lanjasketlay;
                        $pegnama = $this->db->query('SELECT * FROM m_personil WHERE pegnip="'.$row['pegnip'].'"')->result()[0]->pegnama;
                        ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $lanjasketlay; ?></td>
                          <td><?= $pegnama; ?></td>
                          <td><?= $row['pdkjenjang']; ?></td>
                          <td><?= $row['tranmtraining']; ?></td>
                          <td><?= $row['tnaperan']; ?></td>
                          <td><?= date('d M Y',strtotime($row['tnatglmul'])); ?> <?= date('H:i',strtotime($row['tnajammul'])); ?></td>
                          <td><?= date('d M Y',strtotime($row['tnatglsel'])); ?> <?= date('H:i',strtotime($row['tnajamsel'])); ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/tenaga_ahli/edit/'.$row['tnaid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/tenaga_ahli/delete/'.$row['tnaid']).'/'.$row['lanjasid'].'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/tenaga_ahli/add/".$data['lanjasidpermohonan']); ?>" name="AddTenaga" class="btn btn-info pull-right">Tambah Tenaga Ahli</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_5">
               <div class="row">
                  <div class="col-md-12">
                    <table id="" class="table table-bordered table-striped ">
                     <thead>
                        <tr>
                          <th>#ID</th>
                          <th>Kegiatan</th>
                          <th>Abstrak</th>
                          <th>Kata Kunci</th>
                          <th>Penulis</th>
                          <th>Tgl Laporan</th>
                          <th>Versi</th>
                          <th width="100" class="text-center">Action</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                          <?php $i=0; foreach($hasil as $row): 
                          $lanjasnama = $this->db->query('SELECT * FROM tb_layanan_lab_eks WHERE lanjasidpermohonan="'.$row['lanjasid'].'"')->result()[0]->lanjasketlay;
                          ?>
                          <tr>
                            <td><?= ++$i; ?></td>
                            <td><?= $lanjasnama; ?></td>
                            <td><?= $row['hasilabstrak']; ?></td>
                            <td><?= $row['hasilkunci']; ?></td>
                            <td><?= $row['hasilpenulis']; ?></td>
                            <td><?= date('d M Y',strtotime($row['hasiltgllap'])); ?></td>
                            <td><?= $row['hasilversi']; ?></td>
                            <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/hasil_penelitian/edit/'.$row['hasil_id']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                   <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/hasil_penelitian/delete/'.$row['hasil_id']).'/'.$row['lanjasid'].'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?= base_url("admin/hasil_penelitian/add/".$data['lanjasidpermohonan']); ?>" name="AddHasil" class="btn btn-info pull-right">Tambah Hasil Penelitian</a>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>

  </div>
</div>

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#menu_table").DataTable();
  });
</script>
<script type="text/javascript">
      $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<script>
  $("body").on("change",".tgl_checkbox",function(){
    $.post('<?=base_url("admin/".$page."/change_status_pdk")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',  
      id : $(this).data('id'),
      status : $(this).is(':checked') == true ? 1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });
</script>
<script>
    $("#layanan_lab_eks").addClass('active');
  </script>