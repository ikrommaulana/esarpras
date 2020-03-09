<?php
$lanjasid = $data['lanjasid'];
$lanjas = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
$lay = $this->master_model->get_master('tb_layanan_lab_eks');
$peg = $this->master_model->get_master('m_personil');
$pend = $this->master_model->get_master('tb_personil_pendidikan');
$tra = $this->master_model->get_master('tb_personil_training');
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
          <h4><i class="fa fa-plus"></i> &nbsp; Add <?=$title;?></h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/'.$page); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data <?=$title;?></a>
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
           
            <!--?php echo form_open(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?--> 
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['tnaid']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="LanJasId" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <select name="LanJasId" class="form-control">
                    <option value="<?=$lanjas['lanjasidpermohonan'];?>" ><?=$lanjas['lanjasketlay'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Nama Personil</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="">Pilih Personil</option>
                    <?php foreach($peg as $row){?>
                    <option value="<?=$row->pegnip;?>" <?=$data['pegnip']==$row->pegnip?'selected':'';?>><?=$row->pegnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PdkJenjang" class="col-sm-2 control-label">Komp Pendidikan</label>
                <div class="col-sm-9">
                  <select name="PdkJenjang" class="form-control">
                    <option value="SD" <?=$data['pdkjenjang']=='SD'?'selected':'';?>>SD</option>
                    <option value="SLTP" <?=$data['pdkjenjang']=='SLTP'?'selected':'';?>>SLTP</option>
                    <option value="SLTA" <?=$data['pdkjenjang']=='SLTA'?'selected':'';?>>SLTA</option>
                    <option value="S0" <?=$data['pdkjenjang']=='S0'?'selected':'';?>>S0</option>
                    <option value="S1" <?=$data['pdkjenjang']=='S1'?'selected':'';?>>S1</option>
                    <option value="S2" <?=$data['pdkjenjang']=='S2'?'selected':'';?>>S2</option>
                    <option value="S3" <?=$data['pdkjenjang']=='S3'?'selected':'';?>>S3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="TraNmTraining" class="col-sm-2 control-label">Komp Training</label>
                <div class="col-sm-9">
                  <select name="TraNmTraining" class="form-control">
                    <option value="">Pilih Training</option>
                    <?php foreach($tra as $row){?>
                    <option value="<?=$row->tranmtraining;?>" <?=$data['tranmtraining']==$row->tranmtraining?'selected':'';?>><?=$row->tranmtraining;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="TnaKomLain" class="col-sm-2 control-label">Komp Lainnya</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaKomLain" class="form-control" id="TnaKomLain" value="<?= $data['tnakomlain'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaPeran" class="col-sm-2 control-label">Peran Tugas</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaPeran" class="form-control" id="TnaPeran" value="<?= $data['tnaperan'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaTglMul" class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaTglMul" class="form-control datepicker" id="TnaTglMul" value="<?= date('m/d/Y',strtotime($data['tnatglmul']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaTglSel" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaTglSel" class="form-control datepicker" id="TnaTglSel" value="<?= date('m/d/Y',strtotime($data['tnatglsel']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaJamMul" class="col-sm-2 control-label">Jam Mulai</label>
                <div class="col-sm-9">
                  <input type="time" name="TnaJamMul" class="form-control" id="TnaJamMul" value="<?= date('H:i',strtotime($data['tnajammul']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaJamSel" class="col-sm-2 control-label">Jam Selesai</label>
                <div class="col-sm-9">
                  <input type="time" name="TnaJamSel" class="form-control" id="TnaJamSel" value="<?= date('H:i',strtotime($data['tnajamsel']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaCatatan" class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaCatatan" class="form-control" id="TnaCatatan" value="<?= $data['tnacatatan'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan Perubahan"  class="btn btn-info pull-right">
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
    $("#layanan_lab_eks").addClass('active');
  </script>