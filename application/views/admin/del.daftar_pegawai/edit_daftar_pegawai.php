<?php
$lab = $this->master_model->get_master('m_lab');
//$personil_pendidikan = $this->master_model->get_master_by_id('tb_personil_pendidikan','pegnip',$personil['pegnip']);
$personil_pendidikan = $this->db->query('select * from tb_personil_pendidikan where pegnip="'.$personil['pegnip'].'" and is_active=1 order by pdklulus asc')->result_array();
$personil_sertifikat = $this->db->query('select * from tb_sertifikat_personil where pegnip="'.$personil['pegnip'].'"  and is_active=1 order by sertpsno asc')->result_array();
$personil_training = $this->db->query('select * from tb_personil_training where pegnip="'.$personil['pegnip'].'" and is_active=1 order by traselesai asc')->result_array();
?>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; <?='['.$personil['pegnip'].'] '.$personil['pegnama'];?> </h4>
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
          <img class="profile-user-img img-responsive img-circle" src="<?=base_url();?>uploads/images/personil/<?= $personil['pegphoto'];?>" alt="Photo <?=$personil['pegnama'];?>" style="">
          <h3 class="profile-username text-center"><?=$personil['pegnama'];?></h3>
          <p class="text-muted text-center"><?=$personil['pegasal'];?></p>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
              <li><a href="#tab_2" data-toggle="tab">Pendidikan</a></li>
              <li><a href="#tab_3" data-toggle="tab">Sertifikat</a></li>
              <li><a href="#tab_4" data-toggle="tab">Training</a></li>
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
       
                      
                    <?php echo form_open_multipart(base_url('admin/'.$page.'/edit/'.$personil['id_personil']), 'class="form-horizontal"' )?> 
                        <div class="form-group">
                          <label for="PegNIP" class="col-sm-3 control-label">NIP Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" name="PegNIP" class="form-control" id="PegNIP" value="<?=$personil['pegnip'];?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="PegNama" class="col-sm-3 control-label">Nama Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" name="PegNama" class="form-control" id="PegNama" value="<?=$personil['pegnama'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="PegAsal" class="col-sm-3 control-label">Asal Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" name="PegAsal" class="form-control" id="PegAsal" value="<?=$personil['pegasal'];?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="IdLab" class="col-sm-3 control-label">Laboratorium</label>
                          <div class="col-sm-9">
                            <select name="IdLab" class="form-control">
                              <option value="">Pilih Laboratorium Mitra</option>
                              <?php foreach($lab as $row){?>
                              <option value="<?=$row->idlab;?>" <?=$personil['idlab']==$row->idlab?'selected':'';?>><?=$row->labnama;?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="PegPhoto" class="col-sm-3 control-label">Foto Pegawai</label>
                          <div class="col-sm-9">
                            <input type="file" name="PegPhoto" class="form-control" id="PegPhoto" accept=".jpg,.jpeg,.png">
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
                        <th>Lulus</th>
                        <th>Jenjang</th>
                        <th>Sekolah</th>
                        <th>Kota</th>
                        <!--th>Negara</th-->
                        <th>Bid.Studi</th>
                        <!--th>T.A</th>
                        <th>Status</th-->
                        <th width="100" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($personil_pendidikan as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $personil['pegnama']; ?></td>
                          <td><?= $row['pdklulus']; ?></td>
                          <td><?= $row['pdkjenjang']; ?></td>
                          <td><?= $row['pdksekolah']; ?></td>
                          <td><?= $row['pdkkota']; ?></td>
                          <!--td><?= $row['pdknegara']; ?></td-->
                          <td><?= $row['pdkbidstudi']; ?></td>
                          <!--td><?= $row['pdktugasakhir']; ?></td>
                          <td><input class='tgl tgl-ios tgl_checkbox' 
                            data-id="<?php echo $row['idpdk']; ?>" 
                            id='cb_<?=$row['idpdk']?>' 
                            type='checkbox' <?php echo ($row['is_active']==1)? "checked" : ""; ?> />
                            <label class='tgl-btn' for='cb_<?=$row['idpdk']?>'></label>
                          </td-->
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/personil_pendidikan/edit/'.$row['idpdk']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url("admin/personil_pendidikan/delete/".$row['idpdk']."/".$personil['pegnip']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/personil_pendidikan/add?pegnip=".$personil['pegnip']); ?>" name="addPdk" class="btn btn-info pull-right">Tambah Pendidikan</a>
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
                        <!--th>Nama</th-->
                        <th>No Sert</th>
                        <th>Nama Sert</th>
                        <th>Pemberi Sert</th>
                        <th>Lingkup Sert</th>
                        <th>Tanggal Sert</th> 
                        <th>Tanggal Akhir</th>
                        <!--th>Ttd</th-->
                        <th width="150" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($personil_sertifikat as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <!--td><?= $personil['pegnama']; ?></td-->
                          <td><?= $row['sertpsno']; ?></td>
                          <td><?= $row['sertpsnama']; ?></td>
                          <td><?= $row['sertpspemberi']; ?></td>
                          <td><?= $row['sertpslingkup']; ?></td>
                          <td><?= date('d M Y',strtotime($row['sertpstglsert'])); ?></td>
                          <td><?= date('d M Y',strtotime($row['sertpstglakr'])); ?></td>
                          <!--td><?= $row['sertpsttd']; ?></td-->
                          <td class="text-center"><?php echo '<a title="View" class="btn btn-sm btn-primary" href="'.base_url('admin/sert_personil/view/'.$row['idsertps']).'"> <i class="fa fa-file-pdf-o"></i></a>
                          <a title="Edit" class="btn btn-sm btn-warning" href="'.base_url('admin/sert_personil/edit/'.$row['idsertps']).'"> <i class="fa fa-pencil-square-o"></i></a>
                          <a title="Delete" class="btn btn-sm btn-danger" data-href="'.base_url("admin/sert_personil/delete/".$row['idsertps']."/".$personil['pegnip']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>';?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/sert_personil/add?pegnip=".$personil['pegnip']); ?>" name="addSert" class="btn btn-info pull-right">Tambah Sertifikat</a>
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
                        <th>Training</th>
                        <th>No Sert</th>
                        <th>Tgl Selesai</th>
                        <th>Lembaga</th>
                        <th>Kota</th>
                        <th>Negara</th>
                        <th width="100" class="text-center">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach($personil_training as $row): ?>
                        <tr>
                          <td><?= ++$i; ?></td>
                          <td><?= $row['tranmtraining']; ?></td>
                          <td><?= $row['tranosertkesertaan']; ?></td>
                          <td><?= date('d M Y',strtotime($row['traselesai'])); ?></td>
                          <td><?= $row['tralembaga']; ?></td>
                          <td><?= $row['trakota']; ?></td>
                          <td><?= $row['tranegara']; ?></td>
                          <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/personil_training/edit/'.$row['idtra']).'"> <i class="fa fa-pencil-square-o"></i></a>
                                 <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url("admin/personil_training/delete/".$row['idtra']."/".$personil['pegnip']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    <a href="<?= base_url("admin/personil_training/add?pegnip=".$personil['pegnip']); ?>" name="addTra" class="btn btn-info pull-right">Tambah Training</a>
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
    $("#<?=$page;?>").addClass('active');
  </script>
