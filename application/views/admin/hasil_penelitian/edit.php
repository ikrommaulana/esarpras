<?php
$lanjasid = $data['lanjasid'];
$lanjas = $this->master_model->get_master_by_id('tb_layanan_lab_eks','lanjasidpermohonan',$lanjasid);
?>
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
          <h4><i class="fa fa-plus"></i> &nbsp; Add <?=$title;?></h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/'.$page); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data <?=$title;?></a>
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
           
            <!--?php echo form_open_multipart(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');?--> 
            <?php echo form_open_multipart(base_url('admin/'.$page.'/edit/'.$data['hasil_id']), 'class="form-horizontal"' )?> 
               <div class="form-group">
                <label for="LanJasId" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <select name="LanJasId" class="form-control">
                    <option value="<?=$lanjas['lanjasidpermohonan'];?>" ><?=$lanjas['lanjasketlay'];?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="HasilAbstrak" class="col-sm-2 control-label">Hasil Abstrak</label>
                <div class="col-sm-9">
                  <input type="text" name="HasilAbstrak" class="form-control" id="HasilAbstrak" value="<?=$data['hasilabstrak'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="HasilKunci" class="col-sm-2 control-label">Hasil Kunci</label>
                <div class="col-sm-9">
                  <input type="text" name="HasilKunci" class="form-control" id="HasilKunci" value="<?=$data['hasilkunci'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="HasilPenulis" class="col-sm-2 control-label">Hasil Penulis</label>
                <div class="col-sm-9">
                  <input type="text" name="HasilPenulis" class="form-control" id="HasilPenulis" value="<?=$data['hasilpenulis'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="HasilTglLap" class="col-sm-2 control-label">Tanggal Laporan</label>
                <div class="col-sm-9">
                  <input type="text" name="HasilTglLap" class="form-control datepicker" id="HasilTglLap" value="<?= date('m/d/Y',strtotime($data['hasiltgllap']));?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="HasilVersi" class="col-sm-2 control-label">Hasil Versi</label>
                <div class="col-sm-9">
                  <input type="text" name="HasilVersi" class="form-control" id="HasilVersi" value="<?=$data['hasilversi'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="HasilFile" class="col-sm-2 control-label">Hasil File</label>
                <div class="col-sm-9">
                  <input type="file" name="HasilFile" class="form-control" id="HasilFile" accept="application/pdf,application/msword"/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan Perubahan"  class="btn btn-info pull-right">
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
    $("#layanan_lab_eks").addClass('active');
  </script>