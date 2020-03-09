<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Sertifikat</h4>
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
           
            <?php echo form_open_multipart(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?>  
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
                <label for="SertPsNo" class="col-sm-2 control-label">No Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsNo" class="form-control" id="SertPsNo" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsNama" class="col-sm-2 control-label">Nama Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsNama" class="form-control" id="SertPsNama" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsPemberi" class="col-sm-2 control-label">Pemberi Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsPemberi" class="form-control" id="SertPsPemberi" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsLingkup" class="col-sm-2 control-label">Lingkup Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsLingkup" class="form-control" id="SertPsLingkup" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsTglSert" class="col-sm-2 control-label">Tanggal Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsTglSert" class="form-control datepicker" id="SertPsTglSert">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsTglAkr" class="col-sm-2 control-label">Tanggal Akhir</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsTglAkr" class="form-control datepicker" id="SertPsTglAkr">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsTtd" class="col-sm-2 control-label">Ttd Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertPsTtd" class="form-control" id="SertPsTtd" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertPsScan" class="col-sm-2 control-label">Scan Sertifikat</label>
                <div class="col-sm-9">
                  <input type="file" name="SertPsScan" class="form-control" id="SertPsScan" accept=".pdf">
                  <span style="color:red;font-style: italic;">*PDF</span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Sertifikat" class="btn btn-info pull-right">
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