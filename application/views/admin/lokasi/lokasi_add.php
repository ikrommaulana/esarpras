<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Lokasi</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/lokasi'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Lokasi</a>
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
           
            <?php echo form_open(base_url('admin/lokasi/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="kode_lokasi" class="col-sm-2 control-label">Kode Lokasi</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_lokasi" class="form-control" id="kode_lokasi" placeholder=""  onkeyup="this.value = this.value.toUpperCase()">
                </div>
              </div>
              <div class="form-group">
                <label for="nama_lokasi" class="col-sm-2 control-label">Nama Lokasi</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_lokasi" class="form-control" id="nama_lokasi" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="nama_jalan" class="col-sm-2 control-label">Nama Jalan</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_jalan" class="form-control" id="nama_jalan" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="provinsi" class="col-sm-2 control-label">Provinsi</label>
                <div class="col-sm-9">
                  <input type="text" name="provinsi" class="form-control" id="provinsi" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="kabupaten" class="col-sm-2 control-label">Kabupaten</label>
                <div class="col-sm-9">
                  <input type="text" name="kabupaten" class="form-control" id="kabupaten" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="kecamatan" class="col-sm-2 control-label">Kecamatan</label>
                <div class="col-sm-9">
                  <input type="text" name="kecamatan" class="form-control" id="kecamatan" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Sertifikat" class="btn btn-info pull-right">
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
    $("#lokasi").addClass('active');
  </script>