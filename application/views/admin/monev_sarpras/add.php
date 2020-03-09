<?php
$sarpras = $this->master_model->get_master('tb_sarpras_lab');
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
           
            <?php echo form_open_multipart(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?> 
            <!--?php echo form_open_multipart(base_url('admin/'.$page.'/edit/'.$data['id_monev']), 'class="form-horizontal"' )?--> 
              <div class="form-group">
                <label for="SarId" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <select name="SarId" class="form-control">
                    <option value="">Pilih Sarpras</option>
                    <?php foreach($sarpras as $row){?>
                    <option value="<?=$row->sarid;?>"><?=$row->sarnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="MonevSifat" class="col-sm-2 control-label">Sifat</label>
                <div class="col-sm-9">
                  <select name="MonevSifat" class="form-control">
                    <option value="">Pilih Sifat</option>
                    <option value="INTERNAL">Internal</option>
                    <option value="EKSTERNAL">Eksternal</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="MonevPelak" class="col-sm-2 control-label">Pelaksana</label>
                <div class="col-sm-9">
                  <select name="MonevPelak" class="form-control">
                    <option value="">Pilih PIC</option>
                    <?php foreach($peg as $row){?>
                    <option value="<?=$row->pegnip;?>"><?=$row->pegnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="MonevTglMul" class="col-sm-2 control-label">Tanggal Mulai</label>
                <div class="col-sm-9">
                  <input type="text" name="MonevTglMul" class="form-control datepicker" id="MonevTglMul">
                </div>
              </div>
              <div class="form-group">
                <label for="MonevTglSel" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="MonevTglSel" class="form-control datepicker" id="MonevTglSel">
                </div>
              </div>
              <div class="form-group">
                <label for="MonevCatatan" class="col-sm-2 control-label">Catatan</label>
                <div class="col-sm-9">
                  <input type="text" name="MonevCatatan" class="form-control" id="MonevCatatan">
                </div>
              </div>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">PIC</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="">Pilih PIC</option>
                    <?php foreach($peg as $row){?>
                    <option value="<?=$row->pegnip;?>"><?=$row->pegnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="MonevFoto" class="col-sm-2 control-label">Foto Monev</label>
                <div class="col-sm-9">
                  <input type="file" name="MonevFoto[]" class="form-control" id="MonevFoto" multiple>
                </div>
              </div>
              <div class="form-group">
                <label for="MonevStatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-9">
                <select name="MonevStatus" class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="BAIK">BAIK</option>
                    <option value="RUSAK RINGAN">RUSAK RINGAN</option>
                    <option value="RUSAK BERAT">RUSAK BERAT</option>
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