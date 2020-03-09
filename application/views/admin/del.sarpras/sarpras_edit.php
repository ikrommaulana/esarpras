<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Sarpras</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/sarpras'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Sarpras List</a>
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
           
            <?php echo form_open_multipart(base_url('admin/sarpras/edit/'.$sarpras['nup_sarpras']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="nup_sarpras" class="col-sm-2 control-label">NUP Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="nup_sarpras" class="form-control" id="nup_sarpras" value="<?=$sarpras['nup_sarpras'];?>" placeholder="" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="nama_sarpras" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_sarpras" class="form-control" id="nama_sarpras" value="<?=$sarpras['nama_sarpras'];?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="spesifikasi" class="col-sm-2 control-label">Spesifikasi</label>
                <div class="col-sm-9">
                  <input type="text" name="spesifikasi" class="form-control" id="spesifikasi" value="<?=$sarpras['spesifikasi'];?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="fungsi" class="col-sm-2 control-label">Fungsi</label>
                <div class="col-sm-9">
                  <input type="text" name="fungsi" class="form-control" id="fungsi" value="<?=$sarpras['fungsi'];?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="id_kontrak" class="col-sm-2 control-label">Kontrak</label>
                <div class="col-sm-9">
                  <select name="id_kontrak" class="form-control">
                    <option value="">Select Kontrak</option>
                    <?php foreach($kontrak as $row){?>
                    <option value="<?=$row->id_kontrak;?>" <?= $row->id_kontrak==$sarpras['id_kontrak']? 'selected':'' ?>><?=$row->kode_kontrak;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="image_sarpras" class="col-sm-2 control-label">Foto Sarpras</label>
                <div class="col-sm-9">
                  <input type="file" name="image_sarpras" class="form-control" id="image_sarpras" placeholder="" accept=".jpg,.jpeg,.png,.gif"/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Sapras" class="btn btn-info pull-right">
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
    $("#sarpras").addClass('active');
  </script>