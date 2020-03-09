<style>
  .datepicker{
    padding:6px 12px;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Update Pengadaan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/pengadaan'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Pengadaan</a>
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
           
            <?php echo form_open(base_url('admin/pengadaan/edit/'.$pengadaan['id']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="sarpras" class="col-sm-2 control-label">Sarpras</label>
                <div class="col-sm-9">
                   <input type="text" name="sarpras" class="form-control" id="sarpras" placeholder="" value="<?=$pengadaan['pengsarnama'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="sarpras" class="col-sm-2 control-label">Spesifikasi</label>
                <div class="col-sm-9">
                   <textarea name="spesifikasi" id="spesifikasi" rows="3" cols="30" class="form-control" onkeyup="this.value = this.value.toUpperCase();"><?=$pengadaan['pengsarspes'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="nama_mitra" class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-9">
                  <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?=$pengadaan['pengsarjum'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="contact_person" class="col-sm-2 control-label">Tujuan</label>
                <div class="col-sm-9">
                  <input type="text" name="tujuan" class="form-control" id="tujuan" value="<?=$pengadaan['pengsartuj'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
                <div class="col-sm-9">
                  <select name="lokasi" id="lokasi" class="form-control">
                    <?php foreach ($lokasi as $l) { ?>
                        <option value="<?php echo $l['loklabid']; ?>" <?= ($pengadaan['loklabid'] == $l['loklabid'])?'selected': '' ?> ><?php echo $l['loklabkota']; ?></option>
                    <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="jenis_layanan" class="col-sm-2 control-label">Waktu</label>
                <div class="col-sm-9">
                  <input type="text" name="waktu" class="form-control datepicker" id="waktu" value="<?=date("m/d/Y", strtotime($pengadaan['loklabwak']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="harga_layanan" class="col-sm-2 control-label">Biaya</label>
                <div class="col-sm-9">
                  <input type="number" name="biaya" class="form-control" id="biaya" value="<?=$pengadaan['loklabbia'];?>">
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