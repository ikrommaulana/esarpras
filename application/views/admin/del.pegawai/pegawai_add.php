<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Pegawai</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/pegawai'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Pegawai</a>
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
           
            <?php echo form_open(base_url('admin/pegawai/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="nip" class="col-sm-2 control-label">NIP</label>
                <div class="col-sm-9">
                  <input type="text" name="nip" class="form-control" id="nip" placeholder=""  onkeyup="this.value = this.value.toUpperCase()">
                </div>
              </div>
              <div class="form-group">
                <label for="fungsi_kewenangan" class="col-sm-2 control-label">User Esarpras</label>
                <div class="col-sm-9">
                  <select name="user_admin" class="form-control">
                    <option value="">Select User</option>
                    <?php foreach($user_admin as $row){?>
                    <option value="<?=$row->admin_id;?>"><?=$row->username;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nama_pegawai" class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="user_name_ldap" class="col-sm-2 control-label">Username LDAP</label>
                <div class="col-sm-9">
                  <input type="text" name="user_name_ldap" class="form-control" id="user_name_ldap" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="password_ldap" class="col-sm-2 control-label">Password LDAP</label>
                <div class="col-sm-9">
                  <input type="text" name="password_ldap" class="form-control" id="password_ldap" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="id_jabatan" class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-9">
                  <select name="id_jabatan" class="form-control">
                    <option value="">Select Jabatan</option>
                    <?php foreach($jabatan as $row){?>
                    <option value="<?=$row->id_jabatan;?>"><?=$row->kode_jabatan;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="id_lab" class="col-sm-2 control-label">Lab</label>
                <div class="col-sm-9">
                  <select name="id_lab" class="form-control">
                    <option value="">Select Lab</option>
                    <?php foreach($lab as $row){?>
                    <option value="<?=$row->id_lab;?>"><?=$row->nama_lab;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="id_lokasi_unitkerja" class="col-sm-2 control-label">Lokasi Unit Kerja</label>
                <div class="col-sm-9">
                  <select name="id_lokasi_unitkerja" class="form-control">
                    <option value="">Select Lokasi Unit Kerja</option>
                    <?php foreach($lokasi_unitkerja as $row){
                      $lokasi = $this->db->query("SELECT * FROM m_lokasi WHERE id_lokasi=".$row->id_lokasi)->result()[0]->nama_lokasi;
                      $unitkerja = $this->db->query("SELECT * FROM m_unitkerja WHERE id_unitkerja=".$row->id_unitkerja)->result()[0]->kode_unitkerja;
                      ?>
                    <option value="<?=$row->id_lokasi_unitkerja;?>"><?= ' ['.$unitkerja.'] '.$lokasi; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Pegawai" class="btn btn-info pull-right">
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
    $("#pegawai").addClass('active');
  </script>