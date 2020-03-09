<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Input Pemeliharaan Baru</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/pemeliharaan'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Pemeliharaan</a>
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
           
            <?php echo form_open(base_url('admin/pemeliharaan/add'), 'class="form-horizontal"');  ?> 
              <!-- <div class="form-group">
                <label for="id_pengadaan" class="col-sm-2 control-label">ID Pengadaan</label>
                <div class="col-sm-9">
                  <input type="text" name="id_pengadaan" class="form-control" id="id_pengadaan" placeholder=""  onkeyup="this.value = this.value.toUpperCase()" >
                </div>
              </div> -->
              <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Tipe Item</label>
                <div class="col-sm-9">
                  <input type="text" name="type" class="form-control" id="type" placeholder="">
                </div>
              </div>
             <div class="form-group">
                <label for="sarpras" class="col-sm-2 control-label">Sarpras</label>
                <div class="col-sm-9">
                   <select name="sarpras" id="sarpras" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach ($sarpras as $s) { ?>
                        <option value="<?php echo $s['id']; ?>"><?php echo $s['nama_sarpras']; ?></option>
                    <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-9">
                  <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="tujuan" class="col-sm-2 control-label">Tujuan</label>
                <div class="col-sm-9">
                  <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
                <div class="col-sm-9">
                  <select name="lokasi" id="lokasi" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach ($lokasi as $l) { ?>
                        <option value="<?php echo $l['id_lokasi']; ?>"><?php echo $l['kode_lokasi']; ?></option>
                    <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="waktu" class="col-sm-2 control-label">Waktu</label>
                <div class="col-sm-9">
                  <input type="text" name="waktu" class="form-control datepicker" id="waktu" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="tempo" class="col-sm-2 control-label">Tempo Pemeliharaan Berkala</label>
                <div class="col-sm-9">
                  <input type="text" name="tempo" class="form-control" id="tempo" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="biaya" class="col-sm-2 control-label">Perkiraan Biaya</label>
                <div class="col-sm-9">
                  <input type="number" name="biaya" class="form-control" id="biaya" placeholder="">
                </div>
              </div>
               <div class="form-group">
                <label for="mitra" class="col-sm-2 control-label">Mitra</label>
                <div class="col-sm-9">
                  <select name="mitra" id="lokasi" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach ($mitra as $m) { ?>
                        <option value="<?php echo $m['id_mitra']; ?>"><?php echo $m['nama_mitra']; ?></option>
                    <?php } ?> 
                  </select>
                </div>
              </div>
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