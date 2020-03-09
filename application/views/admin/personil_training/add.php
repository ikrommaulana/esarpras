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
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Training</h4>
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
           
            <?php echo form_open(base_url('admin/personil_training/add'), 'class="form-horizontal"');  ?>  
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
                <label for="TraSelesai" class="col-sm-2 control-label">Tanggal Selesai</label>
                <div class="col-sm-9">
                  <input type="text" name="TraSelesai" class="datepicker form-control" id="TraSelesai">
                </div>
              </div>
              <div class="form-group">
                <label for="TraLembaga" class="col-sm-2 control-label">Nama Lembaga</label>
                <div class="col-sm-9">
                  <input type="text" name="TraLembaga" class="form-control" id="TraLembaga"onkeyup="this.value = this.value.toUpperCase();">
                  <!--select name="TraLembaga" class="form-control">
                    <option value="">Pilih Jenjang</option>
                    <option value="SD">SD</option>
                    <option value="SLTP">SLTP</option>
                    <option value="SLTA">SLTA</option>
                    <option value="S0">S0</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select-->
                </div>
              </div>
              <div class="form-group">
                <label for="TraKota" class="col-sm-2 control-label">Kota</label>
                <div class="col-sm-9">
                  <input type="text" name="TraKota" class="form-control" id="TraKota" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TraNegara" class="col-sm-2 control-label">Negara</label>
                <div class="col-sm-9">
                  <input type="text" name="TraNegara" class="form-control" id="TraNegara" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TraNmTraining" class="col-sm-2 control-label">Nama Training</label>
                <div class="col-sm-9">
                  <input type="text" name="TraNmTraining" class="form-control" id="TraNmTraining" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="TraNoSertKesertaan" class="col-sm-2 control-label">No Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="TraNoSertKesertaan" class="form-control" id="TraNoSertKesertaan" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Training" class="btn btn-info pull-right">
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