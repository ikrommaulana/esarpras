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
           
            <?php echo form_open(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?> 
            <!--?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['mitra_id']), 'class="form-horizontal"' )?--> 
              <div class="form-group">
                <label for="MitraInst" class="col-sm-2 control-label">Nama Institusi</label>
                <div class="col-sm-9">
                  <input type="text" name="MitraInst" class="form-control" id="MitraInst" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraKat" class="col-sm-2 control-label">Kategori</label>
                <div class="col-sm-9">
                  <input type="checkbox" name="MitraKat[]" class="minimal" value="PENGADAAN"> Pengadaan &nbsp;
                  <input type="checkbox" name="MitraKat[]"  class="minimal" value="PEMELIHARAAN"> Pemeliharaan &nbsp;
                  <input type="checkbox" name="MitraKat[]"  class="minimal" value="MITRA LAYANAN"> Mitra Layanan
                </div>
              </div>
              <div class="form-group">
                <label for="MitraBid" class="col-sm-2 control-label">Bidang/Spec Teknis</label>
                <div class="col-sm-9">
                  <input type="text" name="MitraBid" class="form-control" id="MitraBid" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraPIC" class="col-sm-2 control-label">Nama PIC</label>
                <div class="col-sm-9">
                  <input type="text" name="MitraPIC" class="form-control" id="MitraPIC" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraAlamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" name="MitraAlamat" class="form-control" id="MitraAlamat" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraTelp" class="col-sm-2 control-label">Telepon</label>
                <div class="col-sm-9">
                  <input type="text" name="MitraTelp" class="form-control" id="MitraTelp" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" name="MitraEmail" class="form-control" id="MitraEmail" onkeyup="this.value = this.value.toUpperCase();">
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