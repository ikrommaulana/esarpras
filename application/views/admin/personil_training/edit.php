<?php
$pegnip = $personil_training['pegnip'];
$peg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
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
          <h4><i class="fa fa-plus"></i> &nbsp; Update Training</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/personil/edit/'.$peg['id_personil']); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data <?=$peg['pegnama'];?></a>
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
           
            <!--?php echo form_open(base_url('admin/personil_training/add'), 'class="form-horizontal"');  ?--> 
            <?php echo form_open(base_url('admin/personil_training/edit/'.$personil_training['idtra']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="<?=$peg['pegnip'];?>" <?=$pegnip==$peg['pegnip']?'selected':'';?>><?=$peg['pegnama'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="TraSelesai" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="TraSelesai" class="datepicker form-control" id="TraSelesai" value="<?= date('m/d/Y',strtotime($personil_training['traselesai']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TraLembaga" class="col-sm-2 control-label">Nama Lembaga</label>
                <div class="col-sm-9">
                  <input type="text" name="TraLembaga" class="form-control" id="TraLembaga" value="<?=$personil_training['tralembaga'];?>" onkeyup="this.value = this.value.toUpperCase();">
                  <!--select name="TraLembaga" class="form-control">
                    <option value="SD" <?=$personil_training['tralembaga']=='SD'?'selected':'';?>>SD</option>
                    <option value="SLTP" <?=$personil_training['tralembaga']=='SLTP'?'selected':'';?>>SLTP</option>
                    <option value="SLTA" <?=$personil_training['tralembaga']=='SLTA'?'selected':'';?>>SLTA</option>
                    <option value="S0" <?=$personil_training['tralembaga']=='S0'?'selected':'';?>>S0</option>
                    <option value="S1" <?=$personil_training['tralembaga']=='S1'?'selected':'';?>>S1</option>
                    <option value="S2" <?=$personil_training['tralembaga']=='S2'?'selected':'';?>>S2</option>
                    <option value="S3" <?=$personil_training['tralembaga']=='S3'?'selected':'';?>>S3</option>
                  </select-->
                </div>
              </div>
              <div class="form-group">
                <label for="TraKota" class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-9">
                  <input type="text" name="TraKota" class="form-control" id="TraKota" onkeyup="this.value = this.value.toUpperCase();"value="<?=$personil_training['trakota'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TraNegara" class="col-sm-2 control-label">Negara</label>
                <div class="col-sm-9">
                  <input type="text" name="TraNegara" class="form-control" id="TraNegara" onkeyup="this.value = this.value.toUpperCase();" value="<?=$personil_training['tranegara'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TraNmTraining" class="col-sm-2 control-label">Nama Training</label>
                <div class="col-sm-9">
                  <input type="text" name="TraNmTraining" class="form-control" id="TraNmTraining" value="<?=$personil_training['tranmtraining'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TraNoSertKesertaan" class="col-sm-2 control-label">No Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="TraNoSertKesertaan" class="form-control" id="TraNoSertKesertaan" value="<?=$personil_training['tranosertkesertaan'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update" class="btn btn-info pull-right">
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
    $("#daftar_pegawai").addClass('active');
  </script>