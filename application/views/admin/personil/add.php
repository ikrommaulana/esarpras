<?php
$addlab = (!$this->input->get('idlab'))?'':$this->input->get('idlab');
if($addlab){
  $lab = $this->master_model->get_master_by_id('m_lab','idlab',$addlab);
}else{
  $lab = $this->master_model->get_master('m_lab');
}
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Personil</h4>
        </div>
        <div class="col-md-6 text-right">
          <?php if($addlab){ ?>

          <?php }else{ ?>
          <a href="<?= base_url('admin/personil'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Personil</a>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <?php if($addlab){
              echo form_open_multipart(base_url('admin/personil/add?idlab='.$addlab), 'class="form-horizontal"');
            }else{
              echo form_open_multipart(base_url('admin/personil/add'), 'class="form-horizontal"');
            }?>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">NIP Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" name="PegNIP" class="form-control" id="PegNIP" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PegNama" class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" name="PegNama" class="form-control" id="PegNama" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PegEmail" class="col-sm-2 control-label">Email Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" name="PegEmail" class="form-control" id="PegEmail" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <!--div class="form-group">
                <label for="PegAsal" class="col-sm-2 control-label">Asal Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" name="PegAsal" class="form-control" id="PegAsal" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <?php if($addlab){ ?>
                      <option value="<?=$lab['idlab'];?>"><?=$lab['labnama'];?></option>
                    <?php }else{ ?>
                      <option value="">Pilih Laboratorium Mitra</option>
                      <?php foreach($lab as $row){?>
                      <option value="<?=$row->idlab;?>"><?=$row->labnama;?></option>
                      <?php }
                      } ?>
                  </select>
                </div>
              </div-->
              <div class="form-group">
                <label for="PegPhoto" class="col-sm-2 control-label">Foto Pegawai</label>
                <div class="col-sm-9">
                  <input type="file" name="PegPhoto" class="form-control" id="PegPhoto" accept=".jpg,.jpeg,.png">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Personil" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
<script>
    $("#personil").addClass('active');
  </script>