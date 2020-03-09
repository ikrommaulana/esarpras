<?php
$idlab = $all_data['idlab'];
$lab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
$all_lab = $this->master_model->get_master('m_lab');
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
          <h4><i class="fa fa-plus"></i> &nbsp; Update Layanan</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/identitas_lab/edit/'.$lab['idlab']); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data <?=$lab['labnama'];?></a>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$all_data['daflayid']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <option value="">Pilih Laboratorium</option>
                    <?php foreach($all_lab as $row){?>
                    <option value="<?=$row->idlab;?>" <?=$all_data['idlab']==$row->idlab?'selected':'';?>><?=$row->labnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayNama" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayNama" class="form-control" id="DaflayNama" value="<?=$all_data['daflaynama'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayKapas" class="col-sm-2 control-label">Kapasitas Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayKapas" class="form-control" id="DaflayKapas" value="<?=$all_data['daflaykapas'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayDesk" class="col-sm-2 control-label">Deskripsi Layanan</label>
                <div class="col-sm-9">
                  <textarea name="DaflayDesk" class="form-control" row="2" id="DaflayDesk" onkeyup="this.value = this.value.toUpperCase();"><?=$all_data['daflaydesk'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayTarif" class="col-sm-2 control-label">Dasar Tarif</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayTarif" class="form-control" id="DaflayTarif" value="<?=$all_data['daflaytarif'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayDittpkn" class="col-sm-2 control-label">Tanggal Ditetapkan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayDittpkn" class="form-control datepicker" id="DaflayDittpkn" value="<?= date('m/d/Y',strtotime($all_data['daflaydittpkn']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayHarga" class="col-sm-2 control-label">Harga Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflayHarga" class="form-control" id="DaflayHarga" value="<?=$all_data['daflayharga'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="DaflayDurasi" class="col-sm-2 control-label">Durasi Layanan</label>
                <div class="col-sm-6">
                  <input type="number" name="DaflayDurasi" class="form-control" id="DaflayDurasi" value="<?=$all_data['daflaydurasi'];?>">
                </div>
                <div class="col-sm-3">
                  <select name="DaflayDurasiWaktu" class="form-control" id="DaflayDurasiWaktu">
                    <option value="Jam" <?=$all_data['daflaydurasiwkt']=='Jam'?'selected':'';?>>JAM</option>
                    <option value="Hari" <?=$all_data['daflaydurasiwkt']=='Hari'?'selected':'';?>>HARI</option>
                    <option value="Bulan" <?=$all_data['daflaydurasiwkt']=='Bulan'?'selected':'';?>>BULAN</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="DaflaySyaPddk" class="col-sm-2 control-label">Syarat Pendidikan</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflaySyaPddk" class="form-control" id="DaflaySyaPddk" value="<?=$all_data['daflaysyapddk'];?>"  onkeyup="this.value = this.value.toUpperCase();" >
                </div>
              </div>
              <div class="form-group">
                <label for="DaflaySyaSert" class="col-sm-2 control-label">Syarat Sertifikat</label>
                <div class="col-sm-9">
                  <input type="text" name="DaflaySyaSert" class="form-control" id="DaflaySyaSert" value="<?=$all_data['daflaysyasert'];?>"  onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Simpan" class="btn btn-info pull-right">
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