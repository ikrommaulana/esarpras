 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; <?=$title;?></h4>
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
          <th>Asal</th>
          <th>Photo</th>
          <th>Laboratorium</th>
          <th>Pendidikan Terakhir</th>
          <th width="50" class="text-center">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($all_personil as $row): 
          $labnama = $this->db->query('SELECT * FROM m_lab WHERE idlab="'.$row['idlab'].'"')->result()[0]->labnama;
          $getpdk = $this->db->query('SELECT * FROM tb_personil_pendidikan WHERE pegnip="'.$row['pegnip'].'" ORDER BY pdklulus DESC')->result();
          $pdknama = (isset($getpdk[0]->pdkjenjang))? $getpdk[0]->pdkjenjang : set_value('pdkjenjang');
          $pdksekolah = (isset($getpdk[0]->pdksekolah))? $getpdk[0]->pdksekolah : set_value('pdksekolah');
          ?>
          <tr>
            <td><?= ++$i; ?></td>
            <td><?= $row['pegnip']; ?></td>
            <td><?= $row['pegnama']; ?></td>
            <td><?= $row['pegasal']; ?></td>
            <td><img src="<?=base_url();?>uploads/images/personil/<?= $row['pegphoto']; ?>" style="width:100px"></td>
            <td><?= $labnama; ?></td>
            <td><?= $pdknama.' '.$pdksekolah; ?></td>
            <td class="text-center"><?php echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/'.$page.'/edit/'.$row['id_personil']).'"> <i class="fa fa-pencil-square-o"></i></a>
                   <a title="View" class="btn btn-sm btn-success" href="'.base_url('admin/'.$page.'/view/'.$row['id_personil']).'"> <i class="fa fa-eye"></i></a>' ;?>

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
    $.post('<?=base_url("admin/<?=$page;?>/change_status")?>',
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
