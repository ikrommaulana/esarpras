<?php
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
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Personil</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/identitas_lab/'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Laboratorium</a>
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
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <option value="">Pilih Laboratorium</option>
                    <?php foreach($all_lab as $row){?>
                    <option value="<?=$row->idlab;?>" <?=$idlab==$row->idlab?'selected':'';?>><?=$row->labnama;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Personil</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="">Pilih Personil</option>
                    <?php foreach($peg as $row){ ?>
                    <option value="<?=$row['pegnip'];?>"><?=$row['pegnama'];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegAsal" class="col-sm-2 control-label">Asal Personil</label>
                <div class="col-sm-9">
                  <select name="PegAsal" class="form-control" id="PegAsal">
                    <option value="">Pilih Asal Personil</option>
                    <option value="Internal">INTERNAL</option>
                    <option value="Eksternal">EKSTERNAL</option>
                  </select>
                </div>
              </div>
              <!--div class="form-group">
                <label for="PegJabatan" class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-9">
                  <select name="PegJabatan" class="form-control">
                    <option value="">Pilih Jabatan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PegKewenang" class="col-sm-2 control-label">Kewenangan</label>
                <div class="col-sm-9">
                  <select name="PegKewenang" class="form-control">
                    <option value="">Pilih Kewenangan</option>
                  </select>
                </div>
              </div-->
              <div class="form-group">
                <label for="PegStatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-9">
                  <select name="PegStatus" class="form-control" id="PegStatus">
                    <option value="">Pilih Status</option>
                    <option value="1">AKTIF</option>
                    <option value="0">TIDAK AKTIF</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Personil" class="btn btn-info pull-right">
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