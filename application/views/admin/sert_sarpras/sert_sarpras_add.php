<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Sertifikat</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/sert_sarpras'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Sertifikat Sarpras</a>
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
           
            <?php echo form_open_multipart(base_url('admin/sert_sarpras/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="nup_sarpras" class="col-sm-2 control-label">Nama Sarpras</label>
                <div class="col-sm-9">
                  <select name="nup_sarpras" class="form-control">
                    <option value="">Select Sarpras</option>
                    <?php foreach($sarpras as $row){?>
                    <option value="<?=$row->nup_sarpras;?>"><?=$row->nama_sarpras;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="id_sertifikat" class="col-sm-2 control-label">Kode Sertifikat</label>
                <div class="col-sm-9">
                  <select name="id_sertifikat" class="form-control">
                    <option value="">Select Sertifikat</option>
                    <?php foreach($sertifikat as $row){?>
                    <option value="<?=$row->id_sertifikat;?>"><?=$row->kode_sertifikat;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="masa_berlaku" class="col-sm-2 control-label">Masa Berlaku</label>
                <div class="col-sm-9">
                  <input type="text" name="masa_berlaku" class="form-control datepicker" id="masa_berlaku" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="file_sert" class="col-sm-2 control-label">File Sertifikat</label>
                <div class="col-sm-9">
                  <input type="file" name="file_sert" class="form-control" id="file_sert" placeholder="" accept=".pdf,.doc,.docx"/>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Sertifikat Sarpras" class="btn btn-info pull-right">
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
    $("#sert_sarpras").addClass('active');
  </script>