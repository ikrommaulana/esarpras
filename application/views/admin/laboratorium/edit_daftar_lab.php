<?php
$layanan_lab = $this->db->query('select * from tb_layanan_lab where idlab="'.$data['idlab'].'" and is_active=1 order by daflaydittpkn asc')->result_array();
$sert_lembaga = $this->db->query('select * from tb_sertifikat_lembaga where idlab="'.$data['idlab'].'"  and is_active=1 order by sertlbtglakr asc')->result_array();
$sarpras_lab = $this->db->query('select * from tb_sarpras_lab where idlab="'.$data['idlab'].'" and is_active=1 order by sarperolehan asc')->result_array();
$personil_lab = $this->db->query('select * from m_personil where idlab="'.$data['idlab'].'" order by id_personil asc')->result_array();
?>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; <?='['.$data['labnamasingkat'].'] '.$data['labnama'];?> </h4>
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
              <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
              <li><a href="#tab_2" data-toggle="tab">Layanan</a></li>
              <li><a href="#tab_3" data-toggle="tab">Sertifikat</a></li>
              <li><a href="#tab_4" data-toggle="tab">Sarpras</a></li>
              <li><a href="#tab_5" data-toggle="tab">Personil</a></li>
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
       
                      
                    <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['idlab']), 'class="form-horizontal"' )?> 
                        <div class="form-group">
                          <label for="LabNama" class="col-sm-3 control-label">Nama Laboratorium</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabNama" class="form-control" id="LabNama" value="<?=$data['labnama'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabNamaSingkat" class="col-sm-3 control-label">Nama Singkat</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabNamaSingkat" class="form-control" id="LabNamaSingkat" value="<?=$data['labnamasingkat'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabAlamat" class="col-sm-3 control-label">Alamat</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabAlamat" class="form-control" id="LabAlamat" value="<?=$data['labalamat'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabKota" class="col-sm-3 control-label">Kota</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabKota" class="form-control" id="LabKota" value="<?=$data['labkota'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabProvinsi" class="col-sm-3 control-label">Provinsi</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabProvinsi" class="form-control" id="LabProvinsi" value="<?=$data['labprovinsi'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabTelp" class="col-sm-3 control-label">Telepon</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabTelp" class="form-control" id="LabTelp" value="<?=$data['labtelp'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabEmail" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabEmail" class="form-control" id="LabEmail" value="<?=$data['labemail'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LabWeb" class="col-sm-3 control-label">Web</label>
                          <div class="col-sm-9">
                            <input type="text" name="LabWeb" class="form-control" id="LabWeb" value="<?=$data['labweb'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <input type="submit" name="submitPeg" value="Simpan Perubahan" class="btn btn-info pull-right">
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <?php echo form_close( ); ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-md-12">
                    <table id="" class="table table-bordered table-striped ">
                      <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Nama</th>
                        <th>Kapasitas</th>
                        <th>Deskripsi</th>
                        <th>Tarif</th>
                        <th>Durasi</th>
                        <th>Syarat Sert</th>
                        <th width="100" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($layanan_lab as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $row['daflaynama']; ?></td>
                          <td><?= $row['daflaykapas']; ?></td>
                          <td><?= $row['daflaydesk']; ?></td>
                          <td><?= $row['daflaytarif']; ?></td>
                          <td><?= $row['daflaydurasi'].' '.$row['daflaydurasiwkt']; ?></td>
                          <td><?= $row['daflaysyasert']; ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/layanan_lab/edit/'.$row['daflayid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url("admin/layanan_lab/delete/".$row['daflayid']."/".$data['idlab']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/layanan_lab/add?idlab=".$data['idlab']); ?>" name="addDafLay" class="btn btn-info pull-right">Tambah Layanan</a>
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
                        <th>No Sert</th>
                        <th>Nama Sert</th>
                        <th>Pemberi Sert</th>
                        <th>Lingkup Sert</th>
                        <th>Tanggal Sert</th> 
                        <th>Tanggal Akhir</th>
                        <th width="150" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($sert_lembaga as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $row['sertlbno']; ?></td>
                          <td><?= $row['sertlbnama']; ?></td>
                          <td><?= $row['sertlbpemberi']; ?></td>
                          <td><?= $row['sertlblingkup']; ?></td>
                          <td><?= date('d M Y',strtotime($row['sertlbtglsert'])); ?></td>
                          <td><?= date('d M Y',strtotime($row['sertlbtglakr'])); ?></td>
                          <td class="text-center"><?php echo '<a title="View" class="btn btn-sm btn-primary" href="'.base_url('admin/sert_lembaga/view/'.$row['idsertlb']).'"> <i class="fa fa-file-pdf-o"></i></a>
                          <a title="Edit" class="btn btn-sm btn-warning" href="'.base_url('admin/sert_lembaga/edit/'.$row['idsertlb']).'"> <i class="fa fa-pencil-square-o"></i></a>
                          <a title="Delete" class="btn btn-sm btn-danger" data-href="'.base_url("admin/sert_lembaga/delete/".$row['idsertlb']."/".$data['idlab']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>';?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/sert_lembaga/add?idlab=".$data['idlab']); ?>" name="addSert" class="btn btn-info pull-right">Tambah Sertifikat</a>
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
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th>Spek</th>
                        <th>Tahun Perolehan</th>
                        <th>Penyedia</th>
                        <th>Lokasi</th>
                        <th width="100" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($sarpras_lab as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $row['sarjenis']; ?></td>
                          <td><?= $row['sarnama']; ?></td>
                          <td><?= $row['sarspek']; ?></td>
                          <td><?= $row['sarperolehan']; ?></td>
                          <td><?= $row['sarpenyedia']; ?></td>
                          <td><?= $row['sarlokasi']; ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/sarpras_lab/edit/'.$row['sarid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url("admin/sarpras_lab/delete/".$row['sarid']."/".$data['idlab']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/sarpras_lab/add?idlab=".$data['idlab']); ?>" name="addTra" class="btn btn-info pull-right">Tambah Sarpras</a>
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
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Asal</th>
                        <th width="100" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($personil_lab as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $row['pegnip']; ?></td>
                          <td><?= $row['pegnama']; ?></td>
                          <td><?= $row['pegasal']; ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/daftar_pegawai/edit/'.$row['id_personil']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="View" class="view btn btn-sm btn-success" href="'.base_url("admin/daftar_pegawai/view/".$row['id_personil']).'"> <i class="fa fa-eye"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/personil/add"); ?>" name="addPeg" class="btn btn-info pull-right">Tambah Pegawai</a>
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
        <p>As you sure you want to delete.</p>
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
    $("#daftar_lab").addClass('active');
  </script>
nil