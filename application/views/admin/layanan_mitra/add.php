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
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Layanan</h4>
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
           
            <?php echo form_open(base_url('admin/'.$page.'/add'), 'class="form-horizontal"');  ?> 
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
                <label for="LayMitNama" class="col-sm-2 control-label">Nama Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="LayMitNama" class="form-control" id="LayMitNama" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="LayMitHarga" class="col-sm-2 control-label">Harga Layanan</label>
                <div class="col-sm-9">
                  <input type="text" name="LayMitHarga" class="form-control" id="LayMitHarga" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Tambah Layanan" class="btn btn-info pull-right">
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