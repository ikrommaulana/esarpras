<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Layanan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/layanan_mitra'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Layanan</a>
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
           
            <?php echo form_open(base_url('admin/layanan_mitra/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="id_mitra" class="col-sm-2 control-label">Kode Mitra</label>
                <div class="col-sm-9">
                  <select name="id_mitra" class="form-control">
                    <option value="">Select Mitra</option>
                    <?php foreach($mitra as $row){?>
                    <option value="<?=$row->id_mitra;?>"><?=$row->kode_mitra;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
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
    $("#layanan_mitra").addClass('active');
  </script>