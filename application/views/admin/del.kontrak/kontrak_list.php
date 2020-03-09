 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Data Kontrak</h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/kontrak/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Kontrak</a>
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
      <table id="menu_table" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>#ID</th>
          <th>Kode Kontrak</th>
          <th>Kode Mitra</th>
          <th>Perihal</th>
          <th>Tanggal</th>
          <th>Nilai</th>
          <th>Masa Berlaku</th>
          <th>Masa Garansi</th>
          <th width="100" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($all_kontrak as $row):
              $mitra = $this->db->query("SELECT * FROM m_mitra WHERE id_mitra=".$row['id_mitra'])->result()[0]->kode_mitra; ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['kode_kontrak']; ?></td>
            <td><?= $mitra; ?></td>
            <td><?= $row['perihal_kontrak']; ?></td>
            <td><?=date("d-m-Y", strtotime($row['tgl_kontrak']));?></td>
            <td>Rp. <?= number_format($row['nilai_kontrak'], 0, '', '.'); ?></td>
            <td><?=date("d-m-Y", strtotime($row['masa_berlaku']));?></td>
            <td><?=date("d-m-Y", strtotime($row['masa_garansi']));?></td>
            <td class="text-center"><?php echo '<a title="View" class="view btn btn-sm btn-success" href="'.base_url('admin/kontrak/view/'.$row['id_kontrak']).'"> <i class="fa fa-eye"></i></a>
              <a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/kontrak/edit/'.$row['id_kontrak']).'"> <i class="fa fa-pencil-square-o"></i></a>
                   <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/kontrak/delete/'.$row['id_kontrak']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
       
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
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
    $("#kontrak").addClass('active');
  </script>
