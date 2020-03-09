<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Pendidikan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/personil/'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Personil</a>
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
           
            <?php echo form_open(base_url('admin/personil_pendidikan/add'), 'class="form-horizontal"');  ?>
              <div class="form-group">
                <label for="PegNIP" class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-9">
                  <select name="PegNIP" class="form-control">
                    <option value="">Pilih Pegawai</option>
                    <?php foreach($all_peg as $row){?>
                    <option value="<?=$row->pegnip;?>" <?=$pegnip==$row->pegnip?'selected':'';?>><?=$row->pegnama;?></option>
                  <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PdkLulus" class="col-sm-2 control-label">Tahun Lulus</label>
                <div class="col-sm-9">
                  <input type="number" name="PdkLulus" class="form-control" id="PdkLulus">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkJenjang" class="col-sm-2 control-label">Jenjang</label>
                <div class="col-sm-9">
                  <select name="PdkJenjang" class="form-control">
                    <option value="">Pilih Jenjang</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SLTA">SLTA</option>
                    <option value="S0">S0</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="PdkKota" class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkKota" class="form-control" id="PdkKota" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkNegara" class="col-sm-2 control-label">Negara</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkNegara" class="form-control" id="PdkNegara" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkSekolah" class="col-sm-2 control-label">Nama Sekolah</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkSekolah" class="form-control" id="PdkSekolah" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkBidStudi" class="col-sm-2 control-label">Bidang Studi</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkBidStudi" class="form-control" id="PdkBidStudi" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="PdkTugasAkhir" class="col-sm-2 control-label">Tugas Akhir</label>
                <div class="col-sm-9">
                  <input type="text" name="PdkTugasAkhir" class="form-control" id="PdkTugasAkhir" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Pendidikan" class="btn btn-info pull-right">
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
    $("#personil").addClass('active');
  </script>