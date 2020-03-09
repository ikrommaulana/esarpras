<?php
// $lay = $this->master_model->get_master('tb_layanan_lab_eks');
// $sar = $this->master_model->get_master('tb_sarpras_lab');

if($this->session->userdata('admin_role')=='superadmin'){
  $lay = $this->master_model->get_master('tb_layanan_lab_eks');
  $sar = $this->master_model->get_master('tb_sarpras_lab');
}else{
  $get_personil = $this->db->query('select * from m_personil
          where admin_id='.$this->session->userdata('admin_id'))->result();
  $priviledge = (isset($get_personil[0]->priviledge))? $get_personil[0]->priviledge : set_value('priviledge');
  if($priviledge==3){
    $lay = $this->master_model->get_master('tb_layanan_lab_eks');
    $sar = $this->master_model->get_master('tb_sarpras_lab');
  }else{
    $pegnip = (isset($get_personil[0]->pegnip))? $get_personil[0]->pegnip : set_value('pegnip');
    $get_lab = $this->db->query('select * from tb_personil_daftar
            where pegnip="'.$pegnip.'"')->result();
    $idlab = (isset($get_lab[0]->idlab))? $get_lab[0]->idlab : set_value('idlab');
    $lay =  $this->master_model->get_simple_master_by_id('tb_layanan_lab','idlab',$idlab);
    $sar =  $this->master_model->get_simple_master_by_id('tb_sarpras_lab','idlab',$idlab);
  }
}
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
              <div class="form-group">
                <label for="LanJasId" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <select name="LanJasId" class="form-control">
                    <option value="">Pilih Layanan</option>
                    <?php foreach($all_lanjas  as $row){?>
                    <option value="<?=$row->lanjasidpermohonan;?>" <?=$lanjasid==$row->lanjasidpermohonan?'selected':'';?>><?=$row->lanjasketlay;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="SarId" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <select name="SarId" class="form-control">
                    <option value="">Pilih Sarpras</option>
                    <?php foreach($sar as $row){?>
                    <option value="<?=$row->sarid;?>"><?=$row->sarnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PrtPemesan" class="col-sm-2 control-label">Pemesan</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtPemesan" class="form-control" id="PrtPemesan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtKegiatan" class="col-sm-2 control-label">Kegiatan</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtKegiatan" class="form-control" id="PrtKegiatan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtTglMul" class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtTglMul" class="form-control datepicker" id="PrtTglMul">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtTglSel" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtTglSel" class="form-control datepicker" id="PrtTglSel">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtJamMul" class="col-sm-2 control-label">Jam Mulai</label>
                <div class="col-sm-9">
                  <input type="time" name="PrtJamMul" class="form-control" id="PrtJamMul">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtJamSel" class="col-sm-2 control-label">Jam Selesai</label>
                <div class="col-sm-9">
                  <input type="time" name="PrtJamSel" class="form-control" id="PrtJamSel">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtPmkInt" class="col-sm-2 control-label">Pengguna Internal</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtPmkInt" class="form-control" id="PrtPmkInt" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtPmkEkt" class="col-sm-2 control-label">Pengguna Eksternal</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtPmkEkt" class="form-control" id="PrtPmkEkt" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PrtCatatan" class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <input type="text" name="PrtCatatan" class="form-control" id="PrtCatatan" onkeyup="this.value = this.value.toUpperCase();">
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