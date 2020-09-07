<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Lokasi Unit Kerja</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/lokasi_unitkerja'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Lokasi Unit Kerja</a>
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
           
            <?php echo form_open(base_url('admin/lokasi_unitkerja/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="id_unitkerja" class="col-sm-2 control-label">Nama Unit Kerja</label>
                <div class="col-sm-9">
                  <select name="id_unitkerja" class="form-control">
                    <option value="">Select Unit Kerja</option>
                    <?php foreach($unitkerja as $row){?>
                    <option value="<?=$row->id_unitkerja;?>"><?=$row->nama_unitkerja;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="id_lokasi" class="col-sm-2 control-label">Nama Lokasi</label>
                <div class="col-sm-9">
                  <select name="id_lokasi" class="form-control">
                    <option value="">Select Lokasi</option>
                    <?php foreach($lokasi as $row){?>
                    <option value="<?=$row->id_lokasi;?>"><?=$row->nama_lokasi;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">No.Telp</label>
                <div class="col-sm-9">
                  <input type="text" name="telp" class="form-control" id="telp" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Lokasi Unit Kerja" class="btn btn-info pull-right">
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
    $("#lokasi_unitkerja").addClass('active');
  </script>