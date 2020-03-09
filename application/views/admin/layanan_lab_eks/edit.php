<?php
$lay = $this->master_model->get_master('tb_layanan_lab');
$mitra = $this->master_model->get_master('m_mitra');
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Update <?=$title;?></h4>
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
           
            <!--?php echo form_open(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?--> 
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['lanjasidpermohonan']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="DaflayId" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <select name="DaflayId" class="form-control">
                    <option value="">Pilih Layanan</option>
                    <?php foreach($lay as $row){?>
                    <option value="<?=$row->daflayid;?>"<?=$data['daflayid']==$row->daflayid?'selected':'';?>><?=$row->daflaynama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasKetLay" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-9">
                  <input type="text" name="LanjasKetLay" class="form-control" id="LanjasKetLay" value="<?=$data['lanjasketlay'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasPemohon" class="col-sm-2 control-label">Pemohon</label>
                <div class="col-sm-9">
                  <input type="text" name="LanjasPemohon" class="form-control" id="LanjasPemohon" value="<?=$data['lanjaspemohon'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasInstansi" class="col-sm-2 control-label">Instansi</label>
                <div class="col-sm-9">
                  <input type="text" name="LanjasInstansi" class="form-control" id="LanjasInstansi" value="<?=$data['lanjasinstansi'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasPIC" class="col-sm-2 control-label">PIC</label>
                <div class="col-sm-9">
                  <input type="text" name="LanjasPIC" class="form-control" id="LanjasPIC" value="<?=$data['lanjaspic'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasAlamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" name="LanjasAlamat" class="form-control" id="LanjasAlamat" value="<?=$data['lanjasalamat'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasTelepon" class="col-sm-2 control-label">Telepon</label>
                <div class="col-sm-9">
                  <input type="number" name="LanjasTelepon" class="form-control" id="LanjasTelepon" value="<?=$data['lanjastelepon'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LanjasEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" name="LanjasEmail" class="form-control" id="LanjasEmail" value="<?=$data['lanjasemail'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="MitraSatu" class="col-sm-2 control-label">Mitra 1</label>
                <div class="col-sm-9">
                  <select name="MitraSatu" class="form-control">
                    <?php foreach($mitra as $row){?>
                    <option value="<?=$row->mitra_id;?>" <?=$data['mitra1']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="MitraDua" class="col-sm-2 control-label">Mitra 2</label>
                <div class="col-sm-9">
                  <select name="MitraDua" class="form-control">
                    <?php foreach($mitra as $row){?>
                    <option value="<?=$row->mitra_id;?>" <?=$data['mitra2']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="MitraTiga" class="col-sm-2 control-label">Mitra 3</label>
                <div class="col-sm-9">
                  <select name="MitraTiga" class="form-control">
                    <?php foreach($mitra as $row){?>
                    <option value="<?=$row->mitra_id;?>" <?=$data['mitra3']==$row->mitra_id?'selected':'';?>><?=$row->mitrainst;?></option>
                    <?php } ?>
                  </select>
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
<script>
    $("#<?=$page;?>").addClass('active');
  </script>