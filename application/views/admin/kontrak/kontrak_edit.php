<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Kontrak</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/kontrak'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Kontrak List</a>
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
           
            <?php echo form_open_multipart(base_url('admin/kontrak/edit/'.$kontrak['id_kontrak']), 'class="form-horizontal"' )?>
              <div class="form-group">
                <label for="kode_kontrak" class="col-sm-2 control-label">Kode Kontrak</label>
                <div class="col-sm-9">
                  <input type="text" name="kode_kontrak" class="form-control" id="kode_kontrak"  value="<?=$kontrak['kode_kontrak'];?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="id_mitra" class="col-sm-2 control-label">Kode Mitra</label>
                <div class="col-sm-9">
                  <?php
                  $kode_mitra = $this->db->query("SELECT * FROM m_mitra WHERE id_mitra=".$kontrak['id_mitra'])->result()[0]->kode_mitra;
                  ?>
                  <input type="text" name="id_mitra" class="form-control" id="id_mitra"  value="<?=$kode_mitra;?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="perihal_kontrak" class="col-sm-2 control-label">Perihal</label>
                <div class="col-sm-9">
                  <input type="text" name="perihal_kontrak" class="form-control" id="perihal_kontrak"  value="<?=$kontrak['perihal_kontrak'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="tgl_kontrak" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-9">
                  <input type="text" name="tgl_kontrak" class="form-control datepicker" id="tgl_kontrak"  value="<?=date("m/d/Y", strtotime($kontrak['tgl_kontrak']));?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="nilai_kontrak" class="col-sm-2 control-label">Nilai</label>
                <div class="col-sm-9">
                  <input type="text" name="nilai_kontrak" class="form-control" id="nilai_kontrak" value="<?=$kontrak['nilai_kontrak'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="masa_berlaku" class="col-sm-2 control-label">Masa Berlaku</label>
                <div class="col-sm-9">
                  <input type="text" name="masa_berlaku" class="form-control datepicker" id="masa_berlaku"  value="<?=date("m/d/Y", strtotime($kontrak['masa_berlaku']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="masa_garansi" class="col-sm-2 control-label">Masa Garansi</label>
                <div class="col-sm-9">
                  <input type="text" name="masa_garansi" class="form-control datepicker" id="masa_garansi"  value="<?=date("m/d/Y", strtotime($kontrak['masa_garansi']));?>">
                </div>
              </div>
              <div class="form-group">
                <label for="sla_kontrak" class="col-sm-2 control-label">SLA Kontrak</label>
                <div class="col-sm-9">
                  <textarea name="sla_kontrak" class="form-control" id="sla_kontrak"><?=$kontrak['sla_kontrak'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="penandatanganan" class="col-sm-2 control-label">Ttd</label>
                <div class="col-sm-9">
                  <input type="text" name="penandatanganan" class="form-control" id="penandatanganan"  value="<?=$kontrak['penandatanganan'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="file_kontrak" class="col-sm-2 control-label">File Kontrak</label>
                <div class="col-sm-9">
                  <input type="file" name="file_kontrak" class="form-control" id="file_kontrak" placeholder="" accept=".pdf,.doc,.docx"/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Kontrak" class="btn btn-info pull-right">
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
    $("#kontrak").addClass('active');
  </script>