<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Edit Unit Kerja</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/unitkerja'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Unit Kerja</a>
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
           
            <?php echo form_open(base_url('admin/unitkerja/edit/'.$unitkerja['kode_unitkerja']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="kode_unitkerja" class="col-sm-2 control-label">Kode Unit Kerja</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_unitkerja" class="form-control" id="kode_unitkerja" value="<?=$unitkerja['kode_unitkerja'];?>" readonly placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama_unitkerja" class="col-sm-2 control-label">Nama Unit Kerja</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_unitkerja" class="form-control" id="nama_unitkerja" value="<?=$unitkerja['nama_unitkerja'];?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Unit Kerja" class="btn btn-info pull-right">
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
    $("#unitkerja").addClass('active');
  </script>