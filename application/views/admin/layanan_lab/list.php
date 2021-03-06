 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; <?=$title;?></h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/'.$page.'/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
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
          <th>Nama</th>
          <th>Kapasitas</th>
          <th>Deskripsi</th>
          <th>Tarif</th>
          <th>Ditetapkan</th>
          <th>Harga</th>
          <th>Durasi</th>
          <!--th>Syarat</th-->
          <th>Status</th>
          <th width="50" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($all_data as $row): ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['daflaynama']; ?></td>
            <td><?= $row['daflaykapas']; ?></td>
            <td><?= $row['daflaydesk']; ?></td>
            <td><?= number_format($row['daflaytarif'],0,',','.'); ?></td>
            <td><?= date('d M Y',strtotime($row['daflaydittpkn'])); ?></td>
            <td><?= number_format($row['daflayharga'],0,',','.'); ?></td>
            <td><?= $row['daflaydurasi']; ?> <?= $row['daflaydurasiwkt']; ?></td>
            <!--td>Pendidikan : <?= $row['daflaysyapddk']; ?><br/>Sertifikat: <?= $row['daflaysyasert']; ?></td-->
            <td><input class='tgl tgl-ios tgl_checkbox' 
              data-id="<?php echo $row['daflayid']; ?>" 
              id='cb_<?=$row['daflayid']?>' 
              type='checkbox' <?php echo ($row['is_active']==1)? "checked" : ""; ?> />
              <label class='tgl-btn' for='cb_<?=$row['daflayid']?>'></label>
            </td>
            <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/'.$page.'/edit/'.$row['daflayid']).'"> <i class="fa fa-pencil-square-o"></i></a>
                   <a title="Delete" class="delete btn btn-sm btn-danger" data-href="'.base_url('admin/'.$page.'/delete/'.$row['daflayid']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="fa fa-trash-o"></i></a>' ;?>

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
    $.post('<?=base_url("admin/".$page."/change_status")?>',
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
    $("#<?=$page;?>").addClass('active');
  </script>
