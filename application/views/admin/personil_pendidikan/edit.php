<?php
$pegnip = $personil_pendidikan['pegnip'];
$peg = $this->master_model->get_master_by_id('m_personil','pegnip',$pegnip);
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Update Pendidikan</h4>
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
           
            <!--?php echo form_open(base_url('admin/personil_pendidikan/add'), 'class="form-horizontal"');  ?--> 
            <?php echo form_open(base_url('admin/personil_pendidikan/edit/'.$personil_pendidikan['idpdk']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="<?=$peg['pegnip'];?>" <?=$pegnip==$peg['pegnip']?'selected':'';?>><?=$peg['pegnama'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PdkLulus" class="col-sm-2 control-label">Tahun Lulus</label>
                <div class="col-sm-9">
                  <input type="number" name="PdkLulus" class="form-control" id="PdkLulus" value="<?=$personil_pendidikan['pdklulus'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkJenjang" class="col-sm-2 control-label">Jenjang</label>
                <div class="col-sm-9">
                  <select name="PdkJenjang" class="form-control">
                    <option value="SD" <?=$personil_pendidikan['pdkjenjang']=='SD'?'selected':'';?>>SD</option>
                    <option value="SLTP" <?=$personil_pendidikan['pdkjenjang']=='SLTP'?'selected':'';?>>SLTP</option>
                    <option value="SLTA" <?=$personil_pendidikan['pdkjenjang']=='SLTA'?'selected':'';?>>SLTA</option>
                    <option value="S0" <?=$personil_pendidikan['pdkjenjang']=='S0'?'selected':'';?>>S0</option>
                    <option value="S1" <?=$personil_pendidikan['pdkjenjang']=='S1'?'selected':'';?>>S1</option>
                    <option value="S2" <?=$personil_pendidikan['pdkjenjang']=='S2'?'selected':'';?>>S2</option>
                    <option value="S3" <?=$personil_pendidikan['pdkjenjang']=='S3'?'selected':'';?>>S3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PdkKota" class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkKota" class="form-control" id="PdkKota" onkeyup="this.value = this.value.toUpperCase();" value="<?=$personil_pendidikan['pdkkota'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkNegara" class="col-sm-2 control-label">Negara</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkNegara" class="form-control" id="PdkNegara" onkeyup="this.value = this.value.toUpperCase();"  value="<?=$personil_pendidikan['pdknegara'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkSekolah" class="col-sm-2 control-label">Nama Sekolah</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkSekolah" class="form-control" id="PdkSekolah" value="<?=$personil_pendidikan['pdksekolah'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkBidStudi" class="col-sm-2 control-label">Bidang Studi</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkBidStudi" class="form-control" id="PdkBidStudi" value="<?=$personil_pendidikan['pdkbidstudi'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkTugasAkhir" class="col-sm-2 control-label">Tugas Akhir</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkTugasAkhir" class="form-control" id="PdkTugasAkhir" value="<?=$personil_pendidikan['pdktugasakhir'];?>" onkeyup="this.value = this.value.toUpperCase();">
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
    $("#personil").addClass('active');
  </script>