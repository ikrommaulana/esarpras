 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Data Sertifikat Sarpras</h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/sert_sarpras/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Sertifikat Sarpras</a>
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
          <th>Nama Sarpras</th>
          <th>Kode Sertifikat</th>
          <th>Masa Berlaku</th>
          <th>Status</th>
          <th width="100" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($all_sertifikat as $row):
          $sarpras = $this->db->query("SELECT * FROM tb_sarpras WHERE nup_sarpras='".$row['sertifikat_user']."'")->result()[0]->nama_sarpras;
          $sertifikat = $this->db->query("SELECT * FROM m_sertifikat WHERE id_sertifikat=".$row['id_sertifikat'])->result()[0]->kode_sertifikat;
          ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $sarpras; ?></td>
            <td><?= $sertifikat; ?></td>
            <td><?=date("d-m-Y", strtotime($row['masa_berlaku']));?></td>
            <td><input class='tgl tgl-ios tgl_checkbox' 
              data-id="<?php echo $row['id_sert_detail']; ?>" 
              id='cb_<?=$row['id_sert_detail']?>' 
              type='checkbox' <?php echo ($row['is_active']==1)? "checked" : ""; ?> />
              <label class='tgl-btn' for='cb_<?=$row['id_sert_detail']?>'></label>
            </td>
            <td class="text-center"><?php echo '<a title="View" class="view btn btn-sm btn-success" href="'.base_url('admin/sert_sarpras/view/'.$row['id_sert_detail']).'"> <i class="fa fa-eye"></i></a>
            <a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/sert_sarpras/edit/'.$row['id_sert_detail']).'"> <i class="fa fa-pencil-square-o"></i></a>
                   <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/sert_sarpras/delete/'.$row['id_sert_detail']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

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
  $("body").on("change",".tgl_checkbox",function(){
    $.post('<?=base_url("admin/sert_sarpras/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',  
      id : $(this).data('id'),
      status : $(this).is(':checked') == true ? 1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });
</script>

<script>
    $("#sert_sarpras").addClass('active');
  </script>
