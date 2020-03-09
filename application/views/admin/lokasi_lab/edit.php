<?php
$idlab = $all_data['idlab'];
$lab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
$all_lab = $this->master_model->get_master('m_lab');
?>
<style type="text/css">
  .datepicker{
    padding:6px 12px;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Update Lokasi</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/identitas_lab/edit/'.$lab['idlab']); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data <?=$lab['labnama'];?></a>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$all_data['loklabid']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <option value="">Pilih Laboratorium</option>
                    <?php foreach($all_lab as $row){?>
                    <option value="<?=$row->idlab;?>" <?=$all_data['idlab']==$row->idlab?'selected':'';?>><?=$row->labnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!--div class="form-group">
                <label for="DaflayNama" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayNama" class="form-control" id="DaflayNama" value="<?=$all_data['daflaynama'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div-->
              
              <div class="form-group">
                <label for="LokLabAlamat" class="col-sm-2 control-label">Alamat Lab</label>
                <div class="col-sm-9">
                  <textarea name="LokLabAlamat" class="form-control" row="2" id="LokLabAlamat" value="<?=$all_data['loklabalamat'];?>" onkeyup="this.value = this.value.toUpperCase();"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="LokLabKota" class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-9">
                  <input type="text" name="LokLabKota" class="form-control" id="LokLabKota" value="<?=$all_data['loklabkota'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LokLabProvinsi" class="col-sm-2 control-label">Provinsi</label>
                <div class="col-sm-9">
                  <input type="text" name="LokLabProvinsi" class="form-control" id="LokLabProvinsi" value="<?=$all_data['loklabprovinsi'];?>" onkeyup="this.value = this.value.toUpperCase();">
                  
                </div>
              </div>
              <div class="form-group">
                <label for="LokLabTelp" class="col-sm-2 control-label">No Telp</label>
                <div class="col-sm-9">
                  <input type="text" name="LokLabTelp" class="form-control" id="LokLabTelp" value="<?=$all_data['loklabtelp'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-info pull-right">
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
    $("#identitas_lab").addClass('active');
  </script>