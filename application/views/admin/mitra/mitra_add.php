<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Mitra</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/mitra'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Mitra</a>
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
           
            <?php echo form_open(base_url('admin/mitra/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="kode_mitra" class="col-sm-2 control-label">Kode Mitra</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_mitra" class="form-control" id="kode_mitra" placeholder=""  onkeyup="this.value = this.value.toUpperCase()" >
                </div>
              </div>
              <div class="form-group">
                <label for="nama_mitra" class="col-sm-2 control-label">Nama Mitra</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_mitra" class="form-control" id="nama_mitra" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="contact_person" class="col-sm-2 control-label">Kontak</label>
                <div class="col-sm-9">
                  <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-9">
                  <textarea name="alamat" class="form-control" id="alamat" placeholder=""></textarea>
                </div>
              </div>
              <!--div class="form-group">
                <label for="jenis_layanan" class="col-sm-2 control-label">Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="jenis_layanan" class="form-control" id="jenis_layanan" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="harga_layanan" class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-9">
                  <input type="number" name="harga_layanan" class="form-control" id="harga_layanan" placeholder="">
                </div>
              </div-->
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Menu" class="btn btn-info pull-right">
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
    $("#mitra").addClass('active');
  </script>