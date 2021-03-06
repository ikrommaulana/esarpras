 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Master Laboratorium</h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/lab/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Laboratorium</a>
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
          <th>Nama Lab</th>
          <th>Lokasi</th>
          <th>Unit Kerja</th>
          <th width="100" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($all_lab as $row):
            $lokasi = $this->db->query("SELECT * FROM m_lokasi WHERE id_lokasi=".$row['id_lokasi'])->result();
            $unitkerja = $this->db->query("SELECT * FROM m_unitkerja WHERE id_unitkerja=".$row['id_unitkerja'])->result();  ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['nama_lab']; ?></td>
            <td><?= '['.$lokasi[0]->kode_lokasi.']'.$lokasi[0]->nama_lokasi.'' ?></td>
            <td><?= '['.$unitkerja[0]->kode_unitkerja.']'.$unitkerja[0]->nama_unitkerja.'' ?></td>
            <td class="text-center"><?php echo '<a title="Detail" class="update btn btn-sm btn-primary" href="'.base_url('admin/report/report_lab/detail/'.$row['id_lab']).'"> <i class="fa fa-eye"></i></a>' ;?>

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


<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
