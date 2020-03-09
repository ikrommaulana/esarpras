<?php
$idlab = $pegdaftar['idlab'];
$lab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
$peg = $this->master_model->get_available_personil_daftar();
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
          <h4><i class="fa fa-plus"></i> &nbsp; Update Personil</h4>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$pegdaftar['idpegdaftar']), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <option value="<?=$lab['idlab'];?>"><?=$lab['labnama'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Personil</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <?php 
                      $pegawai = $this->master_model->get_master_by_id('m_personil','pegnip',$pegdaftar['pegnip']);
                      echo '<option value="'.$pegawai['pegnip'].'" selected>'.$pegawai['pegnama'].'</option>';
                      foreach($peg as $row){
                     ?>
                    <option value="<?=$row['pegnip'];?>"><?=$row['pegnama'];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegAsal" class="col-sm-2 control-label">Asal Personil</label>
                <div class="col-sm-9">
                  <select name="PegAsal" class="form-control" id="PegAsal">
                    <option value="Internal" <?=$pegdaftar['pegasal']=='Internal'?'selected':'';?>>INTERNAL</option>
                    <option value="Eksternal" <?=$pegdaftar['pegasal']=='Eksternal'?'selected':'';?>>EKSTERNAL</option>
                  </select>
                </div>
              </div>
              <!--div class="form-group">
                <label for="PegJabatan" class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-9">
                  <select name="PegJabatan" class="form-control">
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegKewenang" class="col-sm-2 control-label">Kewenangan</label>
                <div class="col-sm-9">
                  <select name="PegKewenang" class="form-control">
                  </select>
                </div>
              </div-->
              <div class="form-group">
                <label for="PegStatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-9">
                  <select name="PegStatus" class="form-control" id="PegStatus">
                    <option value="1" <?=$pegdaftar['pegstatus']==1?'selected':'';?>>AKTIF</option>
                    <option value="0" <?=$pegdaftar['pegstatus']==0?'selected':'';?>>TIDAK AKTIF</option>
                  </select>
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