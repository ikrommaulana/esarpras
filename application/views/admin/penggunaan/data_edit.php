<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Mitra</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/penggunaan'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Penggunaan</a>
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
           
            <?php echo form_open(base_url('admin/penggunaan/edit/'.$data['id']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-9">
                  <input type="text" name="type" class="form-control" id="type" placeholder="" value="<?=$data['type'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="item" class="col-sm-2 control-label">Item</label>
                <div class="col-sm-9">
                  <input type="text" name="item" class="form-control" id="item" placeholder="" value="<?=$data['item'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="fungsi" class="col-sm-2 control-label">Fungsi</label>
                <div class="col-sm-9">
                  <input type="text" name="fungsi" class="form-control" id="fungsi" placeholder="" value="<?=$data['fungsi'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-9">
                  <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="" value="<?=$data['jumlah'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="tujuan" class="col-sm-2 control-label">Tujuan</label>
                <div class="col-sm-9">
                  <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="" value="<?=$data['tujuan'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
                <div class="col-sm-9">
                  <select name="lokasi" id="lokasi" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach ($lokasi as $l) { ?>
                        <option value="<?php echo $l['kode_lokasi']; ?>" <?= ($data['lokasi'] == $l['kode_lokasi'])?'selected': '' ?>><?php echo $l['kode_lokasi']; ?></option>
                    <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="waktu" class="col-sm-2 control-label">Waktu</label>
                <div class="col-sm-9">
                  <input type="text" name="waktu" class="form-control" id="waktu" placeholder="" value="<?=$data['waktu'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="tempo" class="col-sm-2 control-label">Tempo</label>
                <div class="col-sm-9">
                  <input type="text" name="tempo" class="form-control" id="tempo" placeholder="" value="<?=$data['tempo'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="biaya" class="col-sm-2 control-label">Biaya</label>
                <div class="col-sm-9">
                  <input type="number" name="biaya" class="form-control" id="biaya" placeholder="" value="<?=$data['biaya'];?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 