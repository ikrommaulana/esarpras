 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="20">ID</th>
                <th>Personil</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Priviledge</th>
                <th width="50">Status</th>
                <th width="80">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($info as $row): 
                if($row['priviledge']==1){
                    $priviledge = 'Staff';
                }elseif($row['priviledge']==2){
                    $priviledge = 'L1';
                }elseif($row['priviledge']==3){
                    $priviledge = 'L2';
                }else{
                    $priviledge = 'Staff';
                }

                $get_personil = $this->db->query("select * from m_personil where pegnip='".$row['pegnip']."'")->result();
                $nama = (isset($get_personil[0]->pegnama))? $get_personil[0]->pegnama : set_value('nama');


                ?>
            <tr>
            	<td>
					<?=$row['admin_id']?>
                </td>
                <td>
                    <h4 class="m0 mb5"><?=$nama?></h4>
					<!--h4 class="m0 mb5"><?=$row['firstname']?> <?=$row['lastname']?></h4>
                    <small class="text-muted"><?=$row['admin_role_title']?></small-->
                </td>
                <td>
                    <?=$row['username']?>
                </td> 
                <td>
					<?=$row['email']?>
                </td>
                <td>
                    <button class="btn btn-xs btn-success"><?=$row['admin_role_title']?></button>
                </td> 
                <td>
                    <button class="btn btn-xs btn-default"><?=$priviledge?></button>
                </td>
                <td><input class='tgl tgl-ios tgl_checkbox' 
                    data-id="<?=$row['admin_id']?>" 
                    id='cb_<?=$row['admin_id']?>' 
                    type='checkbox' <?php echo ($row['is_active'] == 1)? "checked" : ""; ?> />
                    <label class='tgl-btn' for='cb_<?=$row['admin_id']?>'></label>
                </td>
                <td class="text-center">
                    <a href="<?php echo site_url("admin/admin/edit/".$row['admin_id']); ?>" class="btn btn-warning btn-sm mr5" >
                    <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?php echo site_url("admin/admin/delete/".$row['admin_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script> 
<script>
    $("#admin").addClass('active');
  </script>