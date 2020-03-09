<?php
$layanan_mitra = $this->db->query('select * from tb_layanan_mitra where mitra_id="'.$data['mitra_id'].'" and is_active=1 order by created_at asc')->result_array();
$kontrak_mitra = $this->db->query('select * from tb_kontrak_mitra where mitra_id="'.$data['mitra_id'].'"  and is_active=1 order by konmittgl asc')->result_array();
$mitrakat  = explode(',',$data['mitrakat']);
?>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-12">
          <h4><i class="fa fa-list"></i> &nbsp; <?='['.$data['mitrainst'].'] '.$data['mitrakat'];?> </h4>
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
              <li><a href="#tab_3" data-toggle="tab">Kontrak</a></li>
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
       
                      
                    <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['mitra_id']), 'class="form-horizontal"' )?> 
                    <div class="form-group">
                      <label for="MitraInst" class="col-sm-3 control-label">Nama Institusi</label>
                      <div class="col-sm-9">
                        <input type="text" name="MitraInst" class="form-control" id="MitraInst" value="<?=$data['mitrainst'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraKat" class="col-sm-3 control-label">Kategori</label>
                      <div class="col-sm-9">
                          <input type="checkbox" name="MitraKat[]" class="minimal" value="PENGADAAN" <?php if(in_array('PENGADAAN',$mitrakat)) echo "checked"; ?>> Pengadaan &nbsp;
                          <input type="checkbox" name="MitraKat[]"  class="minimal" value="PEMELIHARAAN" <?php if(in_array('PEMELIHARAAN',$mitrakat)) echo "checked"; ?>> Pemeliharaan &nbsp;
                          <input type="checkbox" name="MitraKat[]"  class="minimal" value="MITRA LAYANAN" <?php if(in_array('MITRA LAYANAN',$mitrakat)) echo "checked"; ?>> Mitra Layanan
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraBid" class="col-sm-3 control-label">Bidang/Spec Teknis</label>
                      <div class="col-sm-9">
                        <input type="text" name="MitraBid" class="form-control" id="MitraBid" value="<?=$data['mitrabid'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraPIC" class="col-sm-3 control-label">Nama PIC</label>
                      <div class="col-sm-9">
                        <input type="text" name="MitraPIC" class="form-control" id="MitraPIC" value="<?=$data['mitrapic'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraAlamat" class="col-sm-3 control-label">Alamat</label>
                      <div class="col-sm-9">
                        <input type="text" name="MitraAlamat" class="form-control" id="MitraAlamat" value="<?=$data['mitraalmt'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraTelp" class="col-sm-3 control-label">Telepon</label>
                      <div class="col-sm-9">
                        <input type="text" name="MitraTelp" class="form-control" id="MitraTelp" value="<?=$data['mitratelp'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="MitraEmail" class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-9">
                        <input type="text" name="MitraEmail" class="form-control" id="MitraEmail" value="<?=$data['mitraemail'];?>" onkeyup="this.value = this.value.toUpperCase();">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <input type="submit" name="submitMitra" value="Simpan Perubahan" class="btn btn-info pull-right">
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
                        <th>Institusi</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th width="100" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($layanan_mitra as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?=$data['mitrainst'];?></td>
                          <td><?= $row['laymitnama']; ?></td>
                          <td><?= $row['laymitharga']; ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/layanan_mitra/edit/'.$row['laymitid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url("admin/layanan_mitra/delete/".$row['laymitid']."/".$data['mitra_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/layanan_mitra/add/".$data['mitra_id']); ?>" name="addLayMit" class="btn btn-info pull-right">Tambah Layanan</a>
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
                        <th>Kode</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        <th>Nilai</th>
                        <th>Masa Berlaku</th> 
                        <th>Masa Garansi</th>
                        <th>Ttd</th>
                        <th width="150" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($kontrak_mitra as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $row['konmitkode']; ?></td>
                          <td><?= $row['konmitperihal']; ?></td>
                          <td><?= date('d M Y',strtotime($row['konmittgl'])); ?></td>
                          <td><?= $row['konmitnilai']; ?></td>
                          <td><?= date('d M Y',strtotime($row['konmitvalid'])); ?></td>
                          <td><?= date('d M Y',strtotime($row['konmitgaransi'])); ?></td>
                          <td><?= $row['konmitttd']; ?></td>
                          <td class="text-center"><?php echo '<a title="View" class="btn btn-sm btn-primary" href="'.base_url('admin/kontrak_mitra/view/'.$row['konmitid']).'"> <i class="fa fa-file-pdf-o"></i></a>
                          <a title="Edit" class="btn btn-sm btn-warning" href="'.base_url('admin/kontrak_mitra/edit/'.$row['konmitid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                          <a title="Delete" class="btn btn-sm btn-danger" data-href="'.base_url("admin/kontrak_mitra/delete/".$row['konmitid']."/".$data['mitra_id']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>';?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/kontrak_mitra/add/".$data['mitra_id']); ?>" name="addKonMit" class="btn btn-info pull-right">Tambah Kontrak</a>
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
    $("#mitra").addClass('active');
  </script>