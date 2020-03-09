<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Sarpras</h4>
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
                <label for="SarJenis" class="col-sm-2 control-label">Jenis Sarpras</label>
                <div class="col-sm-9">
                  <select name="SarJenis" class="form-control">
                    <option value="">Pilih Jenis</option>
                    <option value="Ruangan">Ruangan</option>
                    <option value="Alat">Alat</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="SarNama" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarNama" class="form-control" id="SarNama" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarSpek" class="col-sm-2 control-label">Spesifikasi</label>
                <div class="col-sm-9">
                  <input type="text" name="SarSpek" class="form-control" id="SarSpek" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarModel" class="col-sm-2 control-label">Model</label>
                <div class="col-sm-9">
                  <input type="text" name="SarModel" class="form-control" id="SarModel" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarMerk" class="col-sm-2 control-label">Merk</label>
                <div class="col-sm-9">
                  <input type="text" name="SarMerk" class="form-control" id="SarMerk" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarGuna" class="col-sm-2 control-label">Kegunaan</label>
                <div class="col-sm-9">
                  <input type="text" name="SarGuna" class="form-control" id="SarGuna" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarKodeBrg" class="col-sm-2 control-label">Kode Barang</label>
                <div class="col-sm-9">
                  <input type="text" name="SarKodeBrg" class="form-control" id="SarKodeBrg" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarNUP" class="col-sm-2 control-label">NUP Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarNUP" class="form-control" id="SarNUP" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarPerolehan" class="col-sm-2 control-label">Tahun Perolehan</label>
                <div class="col-sm-9">
                  <input type="number" name="SarPerolehan" class="form-control" id="SarPerolehan">
                </div>
              </div>
              <div class="form-group">
                <label for="SarPenyedia" class="col-sm-2 control-label">Nama Penyedia</label>
                <div class="col-sm-9">
                  <input type="text" name="SarPenyedia" class="form-control" id="SarPenyedia" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarNilai" class="col-sm-2 control-label">Nilai Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarNilai" class="form-control" id="SarNilai" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarLokasi" class="col-sm-2 control-label">Lokasi Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarLokasi" class="form-control" id="SarLokasi" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Sarpras" class="btn btn-info pull-right">
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