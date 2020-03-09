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
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Kontrak</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/mitra/'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Mitra</a>
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
                <label for="MitraId" class="col-sm-2 control-label">Mitra</label>
                <div class="col-sm-9">
                  <select name="MitraId" class="form-control">
                    <option value="">Pilih Mitra</option>
                    <?php foreach($all_mitra as $row){?>
                    <option value="<?=$row->mitra_id;?>" <?=$mitra_id==$row->mitra_id?'selected':'';?>><?=$row->mitrainst;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitKode" class="col-sm-2 control-label">Kode Kontrak</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitKode" class="form-control" id="KonMitKode" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitPerihal" class="col-sm-2 control-label">Perihal Kontrak</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitPerihal" class="form-control" id="KonMitPerihal" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitTgl" class="col-sm-2 control-label">Tanggal Kontrak</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitTgl" class="form-control datepicker" id="KonMitTgl" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitNilai" class="col-sm-2 control-label">Nilai Kontrak</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitNilai" class="form-control" id="KonMitNilai" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitValid" class="col-sm-2 control-label">Masa Berlaku</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitValid" class="form-control datepicker" id="KonMitValid" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitGaransi" class="col-sm-2 control-label">Garansi</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitGaransi" class="form-control datepicker" id="KonMitGaransi" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitSLA" class="col-sm-2 control-label">SLA</label>
                <div class="col-sm-9">
                  <textarea name="KonMitSLA" class="form-control" id="KonMitSLA" onkeyup="this.value = this.value.toUpperCase();"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitTtd" class="col-sm-2 control-label">Ttd Kontrak</label>
                <div class="col-sm-9">
                  <input type="text" name="KonMitTtd" class="form-control" id="KonMitTtd" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="KonMitFile" class="col-sm-2 control-label">File Kontrak</label>
                <div class="col-sm-9">
                  <input type="file" name="KonMitFile" class="form-control" id="KonMitFile" accept=".pdf">
                  <span style="color:red;font-style: italic;">*PDF</span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Kontrak" class="btn btn-info pull-right">
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
    $("#mitra").addClass('active');
  </script>