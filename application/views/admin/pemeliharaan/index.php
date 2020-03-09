 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Data Pemeliharaan</h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/pemeliharaan/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Buat Pemeliharaan Baru</a>
         <?php endif; ?>
        </div>
        
      </div>
    </div>
  </div>


   <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <a href="<?= base_url('admin/pemeliharaan/export_data'); ?>" class="btn btn-success btn-xs pull-right" role="button" ><i class="fa fa-download"></i> Unduh Data</a><br><br>
      <table id="menu_table" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th style=" white-space:nowrap;">No</th>
          <th style=" white-space:nowrap;">Pemohon</th>
          <th style=" white-space:nowrap;">Unit Kerja</th>
          <th style=" white-space:nowrap;">Tipe Item</th>
          <th style=" white-space:nowrap;">Nama Item</th>
          <th style=" white-space:nowrap;">Fungsi Item</th>
          <th style=" white-space:nowrap;">Jumlah</th>
          <th style=" white-space:nowrap;">Tujuan</th>
          <th style=" white-space:nowrap;">Lokasi</th>
          <th style=" white-space:nowrap;">Waktu</th>
          <th style=" white-space:nowrap;">Perkiraan Biaya</th>
          <th style=" white-space:nowrap;">Mitra</th>
          <th style=" white-space:nowrap;">Respon L1</th>
          <th style=" white-space:nowrap;">Note L1</th>
          <th style=" white-space:nowrap;" width="100" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($pemeliharaan as $row): 
          $lokasi = $row['nama_jalan'].' '.$row['kecamatan'].' '.$row['kabupaten'].' '.$row['provinsi'];
           if($row['respon']=='Y') {
              $respon = "<span class='label label-success' data-toggle='tooltip' data-placement='top' title='".$row['note']."'>Approved</span>";
            } else if($row['respon']=='N') {
              $respon = "<span class='label label-danger' data-toggle='tooltip' data-placement='top' title='".$row['note']."'>Revised</span>";
            } else {
              $respon = "<span class='label label-warning'>Processs</span>";
            }
            ?>
          <tr>
            <td style=" white-space:nowrap;"><?= ++$i; ?></td>
            <td style=" white-space:nowrap;"><?= $row['nama_pegawai']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['nama_unitkerja']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['type']; ?></td>
            <td style=" white-space:nowrap;" ><?= $row['nama_sarpras']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['fungsi']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['jumlah']; ?></td>
            <td style=" white-space:nowrap;"><?= $row['tujuan']; ?></td>
            <td style=" white-space:nowrap;"><?= $lokasi; ?></td>
            <td style=" white-space:nowrap;"><?= $row['waktu']; ?></td>
            <td style=" white-space:nowrap;">Rp. <?= number_format($row['biaya'], 0, '', '.'); ?></td>
            <td style=" white-space:nowrap;"><?= $row['nama_mitra']; ?></td>
            <td style=" white-space:nowrap;"><?= $respon; ?></td>
            <td style=" white-space:nowrap;"><?= $row['note']; ?></td>
            <td style=" white-space:nowrap;" class="text-center"><?php 
             if(($this->session->userdata('priviledge')==2) or ($this->session->userdata('priviledge')==3)) {
                echo '<a title="Edit" class="update btn btn-sm btn-primary" id="'.$row['id'].'"onClick="makeapprove(this);"> <i class="fa fa-hand-stop-o"></i></a>';
              }
            echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/pemeliharaan/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
            <a title="Edit" class="update btn btn-sm btn-danger" href="'.base_url('admin/pemeliharaan/delete/'.$row['id']).'"> <i class="fa fa-trash-o"></i></a>' ;?>

            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
       
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

  <div class="modal modal-default fade" id="ubahapp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Persetujuan Pemeliharaan</h4>
            </div>
            <?php echo form_open(base_url('admin/pemeliharaan/makeapprove/'), 'class="form-horizontal"' )?>
            <div class="modal-body">
              <input class="text-green" type="text" name="p_id" id ="p_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                   <div class="form-group row">
                        <label class="col-sm-3 control-label">Status Pemeliharaan</label>
                        <div class="col-sm-9 ">
                          <select class="form-control" name="respon" id="respon">
                            <option value="Y">Disetujui</option>
                            <option value="N">Ditolak</option>
                          </select>
                        </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-sm-3 control-label">Note</label>
                        <div class="col-sm-9 ">
                          <textarea class="form-control" name="note" id="note" rows="3" cols="30"l></textarea>
                        </div>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> Kembali</button>
                <button type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Simpan</button>
            </div>
          <?php echo form_close( ); ?>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
</section>  

<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
        <p>As you sure you want to delete.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>

  </div>
</div>

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#menu_table").DataTable();
  });
</script>
<script type="text/javascript">
      $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<script>
  $("body").on("change",".tgl_checkbox",function(){
    $.post('<?=base_url("admin/mitra/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',  
      id : $(this).data('id'),
      status : $(this).is(':checked') == true ? 1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });

   function makeapprove(a){
  var id = a.id;
   $("#p_id").val(id);
   $('#ubahapp').modal('show');
}
</script>
