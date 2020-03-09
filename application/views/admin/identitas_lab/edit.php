<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Laboratorium</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/identitas_lab'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Laboratorium</a>
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
           
            <?php echo form_open(base_url('admin/identitas_lab/edit/'.$identitas_lab['idlab']), 'class="form-horizontal"' )?>  
              <div class="form-group">
                <label for="LabNama" class="col-sm-2 control-label">Nama Laboratorium</label>
                <div class="col-sm-9">
                  <input type="text" name="LabNama" class="form-control" id="LabNama" value="<?=$identitas_lab['labnama'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabNamaSingkat" class="col-sm-2 control-label">Nama Singkat</label>
                <div class="col-sm-9">
                  <input type="text" name="LabNamaSingkat" class="form-control" id="LabNamaSingkat" value="<?=$identitas_lab['labnamasingkat'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabAlamat" class="col-sm-2 control-label">Alamat Lab</label>
                <div class="col-sm-9">
                  <input type="text" name="LabAlamat" class="form-control" id="LabAlamat" value="<?=$identitas_lab['labalamat'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabKota" class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-9">
                  <input type="text" name="LabKota" class="form-control" id="LabKota" value="<?=$identitas_lab['labkota'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabProvinsi" class="col-sm-2 control-label">Provinsi</label>
                <div class="col-sm-9">
                  <input type="text" name="LabProvinsi" class="form-control" id="LabProvinsi" value="<?=$identitas_lab['labprovinsi'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabTelp" class="col-sm-2 control-label">Telp</label>
                <div class="col-sm-9">
                  <input type="text" name="LabTelp" class="form-control" id="LabTelp" value="<?=$identitas_lab['labtelp'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" name="LabEmail" class="form-control" id="LabEmail" value="<?=$identitas_lab['labemail'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="LabWeb" class="col-sm-2 control-label">Web</label>
                <div class="col-sm-9">
                  <input type="text" name="LabWeb" class="form-control" id="LabWeb" value="<?=$identitas_lab['labweb'];?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Laboratorium" class="btn btn-info pull-right">
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