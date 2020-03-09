<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Edit Jabatan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/jabatan'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Jabatan</a>
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
           
            <?php echo form_open(base_url('admin/jabatan/edit/'.$jabatan['id_jabatan']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="kode_jabatan" class="col-sm-2 control-label">Kode Jabatan</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_jabatan" class="form-control" id="kode_jabatan" value="<?=$jabatan['kode_jabatan'];?>" onkeyup="this.value = this.value.toUpperCase()" >
                </div>
              </div>
              <div class="form-group">
                <label for="kode_kewenangan" class="col-sm-2 control-label">Kode Kewenangan</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_kewenangan" class="form-control" id="kode_kewenangan" value="<?=$jabatan['kode_kewenangan'];?>" onkeyup="this.value = this.value.toUpperCase()" >
                </div>
              </div>
              <div class="form-group">
                <label for="fungsi_kewenangan" class="col-sm-2 control-label">Fungsi Kewenangan</label>
                <div class="col-sm-9">
                  <input type="text" name="fungsi_kewenangan" class="form-control" id="fungsi_kewenangan" value="<?=$jabatan['fungsi_kewenangan'];?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Jabatan" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> <script>
    $("#jabatan").addClass('active');
  </script>