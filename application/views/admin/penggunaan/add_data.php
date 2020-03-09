<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Input Penggunaan</h4>
        </div>
        <div class="col-md-12">
          <h5></i> &nbsp; Data Pemeliharaan</h5>
           <table id="menu_table" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>Tipe Item</th>
          <th>Item</th>
          <th>Spesifikasi</th>
          <th>Fungsi</th>
          <th>Jumlah</th>
          <th>Waktu Pemeliharaan</th>
          <th>Tempo</th>
          <th>Biaya</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($data as $row): ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['type']; ?></td>
            <td><?= $row['nama_sarpras']; ?></td>
            <td><?= $row['spesifikasi']; ?></td>
            <td><?= $row['fungsi']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['waktu']; ?></td>
            <td><?= $row['tempo']; ?></td>
            <td>Rp. <?= number_format($row['biaya'], 0, '', '.'); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <h5></i> &nbsp; Data Pegawai</h5>
           <table id="menu_table" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama Layanan</th>
          <th>Fungsi Layanan</th>
          <th>Durasi</th>
          <th>Biaya</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($layanan as $row): ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['nama_layanan']; ?></td>
            <td><?= $row['fungsi_layanan']; ?></td>
            <td><?= $row['durasi_menit']; ?> Menit</td>
            <td>Rp. <?= number_format($row['biaya'], 0, '', '.'); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <h5></i> &nbsp; Data Layanan</h5>
      <table id="menu_table" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>No</th>
          <th>Tipe Item</th>
          <th>Item</th>
          <th>Spesifikasi</th>
          <th>Fungsi</th>
          <th>Jumlah</th>
          <th>Waktu Pemeliharaan</th>
          <th>Tempo</th>
          <th>Biaya</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($data as $row): ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['type']; ?></td>
            <td><?= $row['nama_sarpras']; ?></td>
            <td><?= $row['spesifikasi']; ?></td>
            <td><?= $row['fungsi']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= $row['waktu']; ?></td>
            <td><?= $row['tempo']; ?></td>
            <td>Rp. <?= number_format($row['biaya'], 0, '', '.'); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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
           
            <?php echo form_open(base_url('admin/penggunaan/add'), 'class="form-horizontal"');  ?> 
              <!-- <div class="form-group">
                <label for="id_pengadaan" class="col-sm-2 control-label">ID Pengadaan</label>
                <div class="col-sm-9">
                  <input type="text" name="id_pengadaan" class="form-control" id="id_pengadaan" placeholder=""  onkeyup="this.value = this.value.toUpperCase()" >
                </div>
              </div> -->
              <div class="form-group">
                <label for="tanggal" class="col-sm-2 control-label">Tanggal Penggunaan</label>
                <div class="col-sm-9">
                  <input type="text" name="tanggal" class="form-control" id="tanggal" placeholder="">
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="lokasi" class="col-sm-2 control-label">Lokasi</label>
                <div class="col-sm-9">
                  <select name="lokasi" id="lokasi" class="form-control">
                    <option value="">Pilih</option>
                    <?php foreach ($all_lokasi as $l) { ?>
                        <option value="<?php echo $l['id_lokasi']; ?>"><?php echo $l['kode_lokasi']; ?></option>
                    <?php } ?> 
                  </select>
                </div>
              </div> -->
              <div class="form-group">
                <label for="tujuan" class="col-sm-2 control-label">Tujuan</label>
                <div class="col-sm-9">
                  <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="">
                  <input type="hidden" name="id_pm" class="form-control" id="id_pm" placeholder="" value="<?=$id_sarpras;?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Data" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  
<script>
  $(function () {
    $("#menu_table").DataTable();
  });

  $(document).ready(function(){
    $('#waktu').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
  });
</script>
</section> 