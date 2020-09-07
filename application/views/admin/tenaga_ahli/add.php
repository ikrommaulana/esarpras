<?php
$lay = $this->master_model->get_master('tb_layanan_lab_eks');
$peg = $this->master_model->get_master('m_personil');
$pend = $this->master_model->get_master('tb_personil_pendidikan');
//$tra = $this->master_model->get_master('tb_personil_training');
$tra = $this->db->query('select tranmtraining from tb_personil_training group by tranmtraining order by tranmtraining asc')->result();
$lanjas = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
$daflayid = (isset($lanjas['daflayid']))? $lanjas['daflayid'] : set_value('daflayid');
$layanan_lab = $this->db->query('select * from tb_layanan_lab where daflayid="'.$daflayid.'"')->result_array();
$idlab = (isset($layanan_lab[0]['idlab']))? $layanan_lab[0]['idlab'] : set_value('idlab');
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
          <a href="<?= base_url('admin/layanan_lab_eks/'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Layanan</a>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?> 
            <!--?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['prtid']), 'class="form-horizontal"' )?--> 
              <div class="form-group">
                <label for="LanJasId" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <select name="LanJasId" class="form-control">
                    <option value="<?=$lanjas['lanjasidpermohonan'];?>" <?=$lanjasid==$lanjas['lanjasidpermohonan']?'selected':'';?>><?=$layanan_lab[0]['daflaynama'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Nama Personil</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="">Pilih Personil</option>
                    <?php foreach($peg as $row){?>
                    <option value="<?=$row->pegnip;?>"><?=$row->pegnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PdkJenjang" class="col-sm-2 control-label">Komp Pendidikan</label>
                <div class="col-sm-9">
                  <select name="PdkJenjang" class="form-control">
                    <option value="">Pilih Jenjang</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SLTA">SLTA</option>
                    <option value="S0">S0</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="TraNmTraining" class="col-sm-2 control-label">Komp Training</label>
                <div class="col-sm-9">
                  <select name="TraNmTraining" class="form-control">
                    <option value="">Pilih Training</option>
                    <?php foreach($tra as $row){?>
                    <option value="<?=$row->tranmtraining;?>"><?=$row->tranmtraining;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="TnaKomLain" class="col-sm-2 control-label">Komp Lainnya</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaKomLain" class="form-control" id="TnaKomLain" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TnaPeran" class="col-sm-2 control-label">Peran Tugas</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaPeran" class="form-control" id="TnaPeran" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtTglMul" class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaTglMul" class="form-control datepicker" id="TnaTglMul">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtTglSel" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaTglSel" class="form-control datepicker" id="TnaTglSel">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtJamMul" class="col-sm-2 control-label">Jam Mulai</label>
                <div class="col-sm-9">
                  <input type="time" name="TnaJamMul" class="form-control" id="TnaJamMul">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtJamSel" class="col-sm-2 control-label">Jam Selesai</label>
                <div class="col-sm-9">
                  <input type="time" name="TnaJamSel" class="form-control" id="TnaJamSel">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtCatatan" class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <input type="text" name="TnaCatatan" class="form-control" id="TnaCatatan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Tenaga Ahli" class="btn btn-info pull-right">
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