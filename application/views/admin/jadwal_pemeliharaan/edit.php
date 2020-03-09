<?php
$sarpras = $this->master_model->get_master('tb_sarpras_lab');
$mitra   = $this->master_model->get_master('m_mitra');
$peg   = $this->master_model->get_master('m_personil');
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
          <h4><i class="fa fa-plus"></i> &nbsp; Update <?=$title;?></h4>
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
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['id_jadpem']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="SarId" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <select name="SarId" class="form-control">
                    <?php foreach($sarpras as $row){?>
                    <option value="<?=$row->sarid;?>" <?=$data['sarid']==$row->sarid?'selected':'';?>><?=$row->sarnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="JadPemSifat" class="col-sm-2 control-label">Sifat</label>
                <div class="col-sm-9">
                  <input type="text" name="JadPemSifat" class="form-control" id="JadPemSifat" value="<?=$data['jadpemsifat'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraId" class="col-sm-2 control-label">Nama Mitra</label>
                <div class="col-sm-9">
                  <select name="MitraId" class="form-control">
                    <?php foreach($mitra as $row){?>
                    <option value="<?=$row->mitra_id;?>" <?=$data['mitraid']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="JadPemTglMul" class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                  <input type="text" name="JadPemTglMul" class="form-control datepicker" id="JadPemTglMul" value="<?= date('m/d/Y',strtotime($data['jadpemtglmul']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="JadPemTglSel" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="JadPemTglSel" class="form-control datepicker" id="JadPemTglSel" value="<?= date('m/d/Y',strtotime($data['jadpemtglsel']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="JadPemCatatan" class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <input type="text" name="JadPemCatatan" class="form-control" id="JadPemCatatan" value="<?=$data['jadpemcatatan'];?>"  onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="JadPemPIC" class="col-sm-2 control-label">PIC</label>
                <div class="col-sm-9">
                  <select name="JadPemPIC" class="form-control">
                    <?php foreach($peg as $row){?>
                    <option value="<?=$row->pegnip;?>" <?=$data['jadpempic']==$row->pegnip?'selected':'';?>><?=$row->pegnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add New" class="btn btn-info pull-right">
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
    $("#<?=$page;?>").addClass('active');
  </script>