<?php
//$lanjasid = $data['lanjasid'];
// $lay = $this->master_model->get_master('tb_layanan_lab_eks');
// $sar = $this->master_model->get_master('tb_sarpras_lab');
$lanjas = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
$daflayid = (isset($lanjas['daflayid']))? $lanjas['daflayid'] : set_value('daflayid');
$layanan_lab = $this->db->query('select * from tb_layanan_lab where daflayid="'.$daflayid.'"')->result_array();
$idlab = (isset($layanan_lab[0]['idlab']))? $layanan_lab[0]['idlab'] : set_value('idlab');

if($this->session->userdata('admin_role')=='superadmin'){
  // $lay = $this->master_model->get_simple_master('tb_layanan_lab_eks');
  // $sar = $this->master_model->get_simple_master('tb_sarpras_lab');
  $lay =  $this->master_model->get_simple_master_by_id('tb_layanan_lab','idlab',$idlab);
  $sar =  $this->master_model->get_simple_master_by_id('tb_sarpras_lab','idlab',$idlab);
}else{
  $get_personil = $this->db->query('select * from ci_admin
          where admin_id='.$this->session->userdata('admin_id'))->result();
  $priviledge = (isset($get_personil[0]->priviledge))? $get_personil[0]->priviledge : set_value('priviledge');
  if($priviledge==3){
    // $lay = $this->master_model->get_simple_master('tb_layanan_lab_eks');
    // $sar = $this->master_model->get_simple_master('tb_sarpras_lab');
    $lay =  $this->master_model->get_simple_master_by_id('tb_layanan_lab','idlab',$idlab);
    $sar =  $this->master_model->get_simple_master_by_id('tb_sarpras_lab','idlab',$idlab);
  }else{
    $pegnip = (isset($get_personil[0]->pegnip))? $get_personil[0]->pegnip : set_value('pegnip');
    $get_lab = $this->db->query('select * from tb_personil_daftar
            where pegnip="'.$pegnip.'"')->result();
    $idlab = (isset($get_lab[0]->idlab))? $get_lab[0]->idlab : set_value('idlab');
    $lay =  $this->master_model->get_simple_master_by_id('tb_layanan_lab','idlab',$idlab);
    $sar =  $this->master_model->get_simple_master_by_id('tb_sarpras_lab','idlab',$idlab);
  }
}
//print_r($sar);
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
            <!--?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['rgnid']), 'class="form-horizontal"' )?--> 
              <div class="form-group">
                <label for="LanJasId" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <select name="LanJasId" class="form-control">
                    <option value="<?=$lanjas['lanjasidpermohonan'];?>" <?=$lanjasid==$lanjas['lanjasidpermohonan']?'selected':'';?>><?=$layanan_lab[0]['daflaynama'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="SarId" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <select name="SarId" class="form-control">
                    <option value="">Pilih Sarpras</option>
                    <?php foreach($sar as $row){
                      if($row['sarjenis']=='Ruangan'){ ?>
                    <option value="<?=$row['sarid'];?>"><?=$row['sarnama'];?></option>
                    <?php } } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="RgnPemesan" class="col-sm-2 control-label">Pemesan</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnPemesan" class="form-control" id="RgnPemesan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnKegiatan" class="col-sm-2 control-label">Kegiatan</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnKegiatan" class="form-control" id="RgnKegiatan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnTglMul" class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnTglMul" class="form-control datepicker" id="RgnTglMul">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnTglSel" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnTglSel" class="form-control datepicker" id="RgnTglSel">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnJamMul" class="col-sm-2 control-label">Jam Mulai</label>
                <div class="col-sm-9">
                  <input type="time" name="RgnJamMul" class="form-control" id="RgnJamMul">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnJamSel" class="col-sm-2 control-label">Jam Selesai</label>
                <div class="col-sm-9">
                  <input type="time" name="RgnJamSel" class="form-control" id="RgnJamSel">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnPmkInt" class="col-sm-2 control-label">Pemakai Internal</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnPmkInt" class="form-control" id="RgnPmkInt" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnPmkEkt" class="col-sm-2 control-label">Pemakai Eksternal</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnPmkEkt" class="form-control" id="RgnPmkEkt" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="RgnCatatan" class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <input type="text" name="RgnCatatan" class="form-control" id="RgnCatatan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Penggunaan" class="btn btn-info pull-right">
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