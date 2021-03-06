<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Sertifikat</h4>
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
           
            <?php echo form_open_multipart(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?> 
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
                <label for="SertLbNo" class="col-sm-2 control-label">No Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbNo" class="form-control" id="SertLbNo" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbNama" class="col-sm-2 control-label">Nama Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbNama" class="form-control" id="SertLbNama" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbPemberi" class="col-sm-2 control-label">Pemberi Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbPemberi" class="form-control" id="SertLbPemberi" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbLingkup" class="col-sm-2 control-label">Lingkup Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbLingkup" class="form-control" id="SertLbLingkup" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbTglSert" class="col-sm-2 control-label">Tanggal Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbTglSert" class="form-control datepicker" id="SertLbTglSert">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbTglAkr" class="col-sm-2 control-label">Tanggal Akhir</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbTglAkr" class="form-control datepicker" id="SertLbTglAkr">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbTtd" class="col-sm-2 control-label">Ttd Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="SertLbTtd" class="form-control" id="SertLbTtd" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SertLbScan" class="col-sm-2 control-label">Scan Sertifikat</label>
                <div class="col-sm-9">
                  <input type="file" name="SertLbScan" class="form-control" id="SertLbScan" accept=".pdf">
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
    $("#identitas_lab").addClass('active');
  </script>