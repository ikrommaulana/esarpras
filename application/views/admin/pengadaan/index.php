 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-list"></i> &nbsp; Data Pengadaan</h4>
        </div>
        <div class="col-md-6 text-right">
         <?php if($this->rbac->check_operation_permission('add')): ?>
          <a href="<?= base_url('admin/pengadaan/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Buat Pengadaan Baru</a>
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
      <!--a href="<?= base_url('admin/pengadaan/export_data'); ?>" class="btn btn-success btn-xs pull-right" role="button" ><i class="fa fa-download"></i> Unduh Data</a><br><br-->
      <table id="menu_table" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th style=" white-space:nowrap;">No</th>
          <th style=" white-space:nowrap;">Pemohon</th>
          <th style=" white-space:nowrap;">Lab</th>
          <th style=" white-space:nowrap;">Nama Sarpras</th>          <th style=" white-space:nowrap;">Waktu</th>
          <th style=" white-space:nowrap;">Respon L1</th>
          <th style=" white-space:nowrap;">Respon L2</th>
          <th width="100" class="text-center" style=" white-space:nowrap;">Action</th>
          
        </tr>
        </thead>
        <tbody>
          <?php $i=0; foreach($pengadaan as $row):

            $get_admin_personil = $this->db->query("SELECT ci_admin.* ,m_personil.pegnama,m_personil.pegstatus FROM ci_admin LEFT JOIN m_personil ON ci_admin.pegnip=m_personil.pegnip WHERE ci_admin.admin_id=".$row['id_pemohon'])->result();
            $pegnama = (isset($get_admin_personil[0]->pegnama))? $get_admin_personil[0]->pegnama : set_value('pegnama');
            $pegnip = (isset($get_admin_personil[0]->pegnip))? $get_admin_personil[0]->pegnip : set_value('pegnip');
            $pegstatus = (($get_admin_personil[0]->pegstatus)==1)? '' : '<span class="label label-danger">Personil is not active</span>';

            if($pegnip){
              $get_lab = $this->db->query("SELECT tb_personil_daftar.* ,m_lab.labnamasingkat,m_lab.labnama,m_lab.is_active FROM tb_personil_daftar LEFT JOIN m_lab ON tb_personil_daftar.idlab=m_lab.idlab WHERE tb_personil_daftar.pegnip=".$pegnip)->result();
              $labnamasingkat = (isset($get_lab[0]->labnamasingkat))? $get_lab[0]->labnamasingkat : set_value('labnamasingkat');
              $labnama = (isset($get_lab[0]->labnama))? $get_lab[0]->labnama : set_value('labnama');
              $labstatus = (($get_lab[0]->is_active)==1)? '' : '<span class="label label-danger">Lab is not active</span>';
            }else{
              $labnama = '';
              $labstatus = '';
              $pegstatus = '';
            }

            $get_lokasi_lab = $this->db->query("SELECT* FROM tb_lokasi_lab WHERE loklabid=".$row['loklabid'])->result();
            $loklabkota = (isset($get_lokasi_lab[0]->loklabkota))? $get_lokasi_lab[0]->loklabkota : set_value('loklabkota');

            if($row['respon_L1']=='Y') {
              $respon1 = "<span class='label label-success' data-toggle='tooltip' data-placement='top' title='".$row['note_L1']."'>Approved</span>";
            } else if($row['respon_L1']=='N') {
              $respon1 = "<span class='label label-danger' data-toggle='tooltip' data-placement='top' title='".$row['note_L1']."'>Revised</span>";
            } else {
              $respon1 = "<span class='label label-warning'>Process</span>";
            }

             if($row['respon_L2']=='Y') {
              $respon2 = "<span class='label label-success' data-toggle='tooltip' data-placement='top' title='".$row['note_L2']."'>Approved</span>";
            } else if($row['respon_L2']=='N') {
              $respon2 = "<span class='label label-danger' data-toggle='tooltip' data-placement='top' title='".$row['note_L2']."'>Revised</span>";
            } else {
              $respon2 = "<span class='label label-warning'>Process</span>";
            }

          ?>
          <tr>
            <td style=" white-space:nowrap;"><?= ++$i; ?></td>
            <td style=" white-space:nowrap;"><?= $pegnama.' '.$pegstatus; ?></td>
            <td style=" white-space:nowrap;" title="<?=$labnama;?>"><?= $labnamasingkat.' '.$labstatus; ?></td>
            <td style=" white-space:nowrap;"><?= $row['pengsarnama']; ?></td>
            <td style=" white-space:nowrap;"><?=date("d-m-Y", strtotime($row['loklabwak']));?></td>
            <td style=" white-space:nowrap;"><?= $respon1; ?></td>
            <td style=" white-space:nowrap;"><?= $respon2; ?></td>
            <td class="text-center" style=" white-space:nowrap;">
              <a title="View" class="update btn btn-sm btn-default" id="<?=$row['id'];?>"onClick="viewPengadaan(this);"> <i class="fa fa-eye"></i></a>
              <?php 
              if(($this->session->userdata('priviledge')==2) and ($row['respon_L1']=='P')) {
                echo '<a title="Action" class="update btn btn-sm btn-primary" id="'.$row['id'].'"onClick="makeapprove(this);"> <i class="fa fa-hand-stop-o"></i></a>';
              }elseif(($this->session->userdata('priviledge')==3) and ($row['respon_L1']=='Y') and ($row['respon_L2']=='P')){
                echo '<a title="Action" class="update btn btn-sm btn-primary" id="'.$row['id'].'"onClick="makeapprove(this);"> <i class="fa fa-hand-stop-o"></i></a>';
              }
              if(($this->session->userdata('admin_id')==$row['id_pemohon']) and ($row['respon_L1']=='P')) {
                echo '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/pengadaan/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
                <a title="Delete" class="update btn btn-sm btn-danger" href="'.base_url('admin/pengadaan/delete/'.$row['id']).'"> <i class="fa fa-trash-o"></i></a>';
              }elseif($this->session->userdata('admin_role')=='superadmin'){
                echo '<a title="Delete" class="update btn btn-sm btn-danger" href="'.base_url('admin/pengadaan/delete/'.$row['id']).'"> <i class="fa fa-trash-o"></i></a>';
              }
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

  <div class="modal modal-default fade" id="ubahapp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Persetujuan Pengadaan</h4>
            </div>
            <?php echo form_open(base_url('admin/pengadaan/makeapprove/'), 'class="form-horizontal"' )?>
            <div class="modal-body">
              <input class="text-green" type="text" name="p_id" id ="p_id" style="display: none;">
              <div class="row">
                <div class="col-sm-12">
                   <div class="form-group row">
                        <label class="col-sm-3 control-label">Status Pengadaan</label>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          <?php echo form_close( ); ?>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


  <div class="modal modal-default fade" id="viewPengadaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i>&nbsp;&nbsp;Detail Pengadaan</h4>
            </div>
            <div class="modal-body" id="detail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>
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
  function makeapprove(a){
  var id = a.id;
   $("#p_id").val(id);
   $('#ubahapp').modal('show');
}
</script>
<script>
  function viewPengadaan(a){
  var id = a.id;
   $.ajax({
     type: 'POST',
     url: '<?=base_url();?>admin/pengadaan/viewpengadaan/'+id,
     success: function(response) { 
        $('#detail').html(response);
        $('#viewPengadaan').modal('show');
     }
   });
}
</script>
<script>
    $("#pengadaan").addClass('active');
</script>
