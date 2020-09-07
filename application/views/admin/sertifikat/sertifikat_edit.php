<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Edit Sertifikat</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/sertifikat'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Sertifikat</a>
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
           
            <?php echo form_open(base_url('admin/sertifikat/edit/'.$sertifikat['id_sertifikat']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="kode_sertifikat" class="col-sm-2 control-label">Kode Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_sertifikat" class="form-control" id="kode_sertifikat" value="<?=$sertifikat['kode_sertifikat'];?>" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="fungsi_sertifikat" class="col-sm-2 control-label">Fungsi Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="fungsi_sertifikat" class="form-control" id="fungsi_sertifikat" placeholder="" value="<?=$sertifikat['fungsi_sertifikat'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="penerbit" class="col-sm-2 control-label">Penerbit Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="" value="<?=$sertifikat['penerbit'];?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Sertifikat" class="btn btn-info pull-right">
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
    $("#sertifikat").addClass('active');
  </script>