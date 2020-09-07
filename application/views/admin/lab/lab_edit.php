<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Update Laboratorium</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/lab'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Laboratorium</a>
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
           
            <?php echo form_open(base_url('admin/lab/edit/'.$lab['id_lab']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="nama_lab" class="col-sm-2 control-label">Nama Lab</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_lab" class="form-control" id="nama_lab" value="<?=$lab['nama_lab'];?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="id_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
                <div class="col-sm-9">
                  <select name="id_unitkerja" class="form-control">
                    <option value="">Select Unit Kerja</option>
                    <?php foreach($unitkerja as $row){?>
                    <option value="<?=$row->id_unitkerja;?>" <?= $row->id_unitkerja==$lab['id_unitkerja']? 'selected':'' ?>><?='['.$row->kode_unitkerja.'] '.$row->nama_unitkerja;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="id_lokasi" class="col-sm-2 control-label">Lokasi</label>
                <div class="col-sm-9">
                  <select name="id_lokasi" class="form-control">
                    <option value="">Select Lokasi</option>
                    <?php foreach($lokasi as $row){?>
                    <option value="<?=$row->id_lokasi;?>" <?= $row->id_lokasi==$lab['id_lokasi']? 'selected':'' ?>><?= '['.$row->kode_lokasi.']'.$row->nama_lokasi; ?></option>
                    <?php } ?>
                  </select>
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
    $("#lab").addClass('active');
  </script>