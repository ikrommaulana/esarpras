<style type="text/css">
  .datepicker{
    padding:6px 12px;
  }
</style>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Layanan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/identitas_lab/'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Laboratorium</a>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <option value="">Pilih Laboratorium</option>
                    <?php foreach($all_lab as $row){?>
                    <option value="<?=$row->idlab;?>" <?=$idlab==$row->idlab?'selected':'';?>><?=$row->labnama;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayNama" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayNama" class="form-control" id="DaflayNama" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayKapas" class="col-sm-2 control-label">Kapasitas Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayKapas" class="form-control" id="DaflayKapas" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayDesk" class="col-sm-2 control-label">Deskripsi Layanan</label>
                <div class="col-sm-9">
                  <textarea name="DaflayDesk" class="form-control" row="2" id="DaflayDesk" onkeyup="this.value = this.value.toUpperCase();"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayTarif" class="col-sm-2 control-label">Dasar Tarif</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayTarif" class="form-control" id="DaflayTarif" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayDittpkn" class="col-sm-2 control-label">Tanggal Ditetapkan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayDittpkn" class="form-control datepicker" id="DaflayDittpkn">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayHarga" class="col-sm-2 control-label">Harga Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayHarga" class="form-control" id="DaflayHarga">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayDurasi" class="col-sm-2 control-label">Durasi Layanan</label>
                <div class="col-sm-6">
                  <input type="number" name="DaflayDurasi" class="form-control" id="DaflayDurasi">
                </div>
                <div class="col-sm-3">
                  <select name="DaflayDurasiWaktu" class="form-control" id="DaflayDurasiWaktu">
                    <option value="">Pilih Durasi</option>
                    <option value="Jam">JAM</option>
                    <option value="Hari">HARI</option>
                    <option value="Bulan">BULAN</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="DaflaySyaPddk" class="col-sm-2 control-label">Syarat Pendidikan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflaySyaPddk" class="form-control" id="DaflaySyaPddk" onkeyup="this.value = this.value.toUpperCase();" >
                </div>
              </div>
              <div class="form-group">
                <label for="DaflaySyaSert" class="col-sm-2 control-label">Syarat Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflaySyaSert" class="form-control" id="DaflaySyaSert" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Layanan" class="btn btn-info pull-right">
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