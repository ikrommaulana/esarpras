<?php
$idlab = $data['idlab'];
$lab = $this->master_model->get_master_by_id('m_lab','idlab',$idlab);
$all_lab = $this->master_model->get_master('m_lab');
?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Uodate Sarpras</h4>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/edit/'.$data['sarid']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="IdLab" class="col-sm-2 control-label">Laboratorium</label>
                <div class="col-sm-9">
                  <select name="IdLab" class="form-control">
                    <option value="">Pilih Laboratorium</option>
                    <?php foreach($all_lab as $row){?>
                    <option value="<?=$row->idlab;?>" <?=$data['idlab']==$row->idlab?'selected':'';?>><?=$row->labnama;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="SarJenis" class="col-sm-2 control-label">Jenis Sarpras</label>
                <div class="col-sm-9">
                  <select name="SarJenis" class="form-control">
                    <option value="Ruangan" <?=$data['sarjenis']=='Ruangan'?'selected':'';?>>Ruangan</option>
                    <option value="Alat" <?=$data['sarjenis']=='Alat'?'selected':'';?>>Alat</option>
                    <option value="Lainnya" <?=$data['sarjenis']=='Lainnya'?'selected':'';?>>Lainnya</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="SarNama" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarNama" class="form-control" id="SarNama" value="<?=$data['sarnama'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarSpek" class="col-sm-2 control-label">Spesifikasi</label>
                <div class="col-sm-9">
                  <input type="text" name="SarSpek" class="form-control" id="SarSpek" value="<?=$data['sarspek'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarModel" class="col-sm-2 control-label">Model</label>
                <div class="col-sm-9">
                  <input type="text" name="SarModel" class="form-control" id="SarModel" value="<?=$data['sarmodel'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarMerk" class="col-sm-2 control-label">Merk</label>
                <div class="col-sm-9">
                  <input type="text" name="SarMerk" class="form-control" id="SarMerk" value="<?=$data['sarmerk'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarGuna" class="col-sm-2 control-label">Kegunaan</label>
                <div class="col-sm-9">
                  <input type="text" name="SarGuna" class="form-control" id="SarGuna" value="<?=$data['sarguna'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarKodeBrg" class="col-sm-2 control-label">Kode Barang</label>
                <div class="col-sm-9">
                  <input type="text" name="SarKodeBrg" class="form-control" id="SarKodeBrg" onkeyup="this.value = this.value.toUpperCase();" value="<?=$data['sarkodebrg'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="SarNUP" class="col-sm-2 control-label">NUP Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarNUP" class="form-control" id="SarNUP" onkeyup="this.value = this.value.toUpperCase();" value="<?=$data['sarnup'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="SarPerolehan" class="col-sm-2 control-label">Tahun Perolehan</label>
                <div class="col-sm-9">
                  <input type="number" name="SarPerolehan" class="form-control" id="SarPerolehan" value="<?=$data['sarperolehan'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="SarPenyedia" class="col-sm-2 control-label">Nama Penyedia</label>
                <div class="col-sm-9">
                  <input type="text" name="SarPenyedia" class="form-control" id="SarPenyedia" value="<?=$data['sarpenyedia'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarNilai" class="col-sm-2 control-label">Nilai Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarNilai" class="form-control" id="SarNilai" value="<?=$data['sarnilai'];?>" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="SarLokasi" class="col-sm-2 control-label">Lokasi Sarpras</label>
                <div class="col-sm-9">
                  <input type="text" name="SarLokasi" class="form-control" id="SarLokasi" onkeyup="this.value = this.value.toUpperCase();"  value="<?=$data['sarlokasi'];?>">
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
    $("#<?=$page;?>").addClass('active');
  </script>