<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Layanan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/layanan_lab'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Layanan</a>
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
           
            <?php echo form_open(base_url('admin/layanan_lab/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="id_lab" class="col-sm-2 control-label">Nama Laboratorium</label>
                <div class="col-sm-9">
                  <select name="id_lab" class="form-control">
                    <option value="">Select Laboratorium</option>
                    <?php foreach($lab as $row){?>
                    <option value="<?=$row->id_lab;?>"><?=$row->nama_lab;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nama_layanan" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_layanan" class="form-control" id="nama_layanan" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="fungsi_layanan" class="col-sm-2 control-label">Fungsi Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="fungsi_layanan" class="form-control" id="fungsi_layanan" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="durasi_menit" class="col-sm-2 control-label">Durasi (Menit)</label>
                <div class="col-sm-9">
                  <input type="number" name="durasi_menit" class="form-control" id="durasi_menit" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="biaya" class="col-sm-2 control-label">Biaya</label>
                <div class="col-sm-9">
                  <input type="number" name="biaya" class="form-control" id="biaya" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Layanan" class="btn btn-info pull-right">
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
    $("#layanan_lab").addClass('active');
  </script>