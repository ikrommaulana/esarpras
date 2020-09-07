 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Personil</h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/personil/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add Personil</a>
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
          <th>NIP</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Jabatan</th>
          <th>Status</th>
          <th width="100" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($all_personil as $row):  
              $get_admin = $this->db->query("select * from ci_admin where pegnip='".$row['pegnip']."'")->result();
              $get_priviledge = (!($get_admin))?'':$get_admin[0]->priviledge;
              if($get_priviledge==1){
                $priviledge = 'Staff';
              }elseif($get_priviledge==2){
                $priviledge = 'L1';
              }elseif($get_priviledge==3){
                $priviledge = 'L2';
              }else{
                $priviledge = '';
              }
            ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['pegnip']; ?></td>
            <td><?= $row['pegnama']; ?></td>
            <td><?= $row['pegemail']; ?></td>
            <td><?=strtoupper($priviledge); ?></td>
            <!--td><a href="<?=base_url();?>uploads/images/personil/<?= $row['pegphoto']; ?>" target="_blank"><i class="fa fa-phto-o"></i></td-->
            <td><input class='tgl tgl-ios tgl_checkbox' 
              data-id="<?php echo $row['id_personil']; ?>" 
              id='cb_<?=$row['id_personil']?>' 
              type='checkbox' <?php echo ($row['pegstatus']==1)? "checked" : ""; ?> />
              <label class='tgl-btn' for='cb_<?=$row['id_personil']?>'></label>
            </td>
            <td class="text-center"><?php echo '<a title="View" class="btn btn-sm btn-success" href="'.base_url('admin/personil/view/'.$row['id_personil']).'"> <i class="fa fa-eye"></i></a>&nbsp;';
              if($this->rbac->check_operation_permission('edit')):
                   echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/personil/edit/'.$row['id_personil']).'"> <i class="fa fa-pencil-square-o"></i></a>&nbsp;';
              elseif($this->session->userdata('pegnip')==$row['pegnip']):
                 echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/personil/edit/'.$row['id_personil']).'"> <i class="fa fa-pencil-square-o"></i></a>&nbsp;' ;
              endif;
              if($this->rbac->check_operation_permission('delete')):
                   echo '<a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/personil/delete/'.$row['id_personil']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;
              endif;
                   ?>

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
        <p>Are you sure you want to delete.</p>
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
    $.post('<?=base_url("admin/personil/change_status")?>',
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
    $("#personil").addClass('active');
  </script>
