<?php 
$uri_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);
if($uri_tab!='dashboard'){
  $cur_tab = $this->db->query("select * from module where controller_name='$uri_tab'")->result()[0]->parent_name;
}else{
  $cur_tab = 'dashboard';
}

$get_admin = $this->db->query('select * from ci_admin
          where admin_id='.$this->session->userdata('admin_id'))->result();
$priviledge = (isset($get_admin[0]->priviledge))? $get_admin[0]->priviledge : set_value('priviledge');
if($priviledge==1){
  $nama_priviledge = 'Staff';
}elseif($priviledge==2){
  $nama_priviledge = 'L1';
}elseif($priviledge==3){
  $nama_priviledge = 'L2';
}else{
  $nama_priviledge = '';
}
$get_personil = $this->db->query('select * from m_personil where admin_id='.$this->session->userdata('admin_id'))->result();
$pegnip = (isset($get_personil[0]->pegnip))? $get_personil[0]->pegnip : set_value('pegnip');
$id_personil = (isset($get_personil[0]->id_personil))? $get_personil[0]->id_personil : set_value('id_personil');
$get_personil_daftar = $this->db->query('select * from tb_personil_daftar
          where pegnip="'.$pegnip.'"')->result();
$idlab = (isset($get_personil_daftar[0]->idlab))? $get_personil_daftar[0]->idlab : set_value('idlab');
$get_lab = ($idlab!='')? $this->db->query('select * from m_lab where idlab='.$idlab)->result(): set_value('get_lab');
$labnama = (isset($get_lab[0]->labnama))? $get_lab[0]->labnama : set_value('labnama');
$labnamasingkat = (isset($get_lab[0]->labnamasingkat))? $get_lab[0]->labnamasingkat : set_value('labnamasingkat');
$myphoto = (isset($get_personil[0]->pegphoto))? $get_personil[0]->pegphoto : set_value('pegphoto');
$this->load->library('session');
$this->session->set_userdata(array(
  'id_personil'=>$id_personil,
  'pegnip'=>$pegnip,
  'priviledge'=>$priviledge,
  'nama_priviledge' => $nama_priviledge,
  'myphoto'=>$myphoto,
  'idlab' => $idlab,
  'labnama' => $labnama,
  'labnamasingkat'=>$labnamasingkat,
));
$myphoto = ($this->session->userdata('myphoto'))?'uploads/images/personil/'.$myphoto:'public/dist/img/user2-160x160.jpg';

$ceklab = $this->db->query('SELECT * FROM tb_pengadaan a left join tb_lokasi_lab b on a.loklabid=b.loklabid WHERE b.idlab="'.$idlab.'"')->result();

if($ceklab){
  if($this->session->userdata('priviledge')==2){
    $get_notif_pengadaan = $this->db->query('select * from tb_pengadaan where respon_L1="P"')->num_rows();
  }elseif($this->session->userdata('priviledge')==3){
    $get_notif_pengadaan = $this->db->query('select * from tb_pengadaan where respon_L1="Y" and respon_L2="P"')->num_rows();
  }else{
    $get_notif_pengadaan = 0;
  }

  $sum_notif_pengadaan = (($get_notif_pengadaan)!='0')? '<span class="badge">'.$get_notif_pengadaan.'</span>' : set_value('sum_notif_pengadaan');
}

$notif_pengadaan = (isset($sum_notif_pengadaan))? $sum_notif_pengadaan : set_value('notif_pengadaan');

$notif = array(
  'pengadaan' => $notif_pengadaan,
)
?>  

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url().$myphoto; ?>" class="img-circle" alt="User Image" style="height:45px;">
        </div>
        <div class="pull-left info">
          <p><?= ucwords($this->session->userdata('name')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="dashboard" class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id="dashboard"><a href="<?= base_url('admin/dashboard'); ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
          </ul>
        </li>
      </ul>
        
      <?php 
      $module = $this->db->query('SELECT * FROM module WHERE parent_name="_"  AND is_active=1 ORDER BY sort_order ASC')->result();
      foreach($module as $row){
            $sub_module = $this->db->query('SELECT * FROM module WHERE parent_name="'.$row->controller_name.'" AND is_active=1 ORDER BY sort_order ASC')->result();      
      if($this->rbac->check_module_permission($row->controller_name)):

      $notifications = (isset($notif[$row->controller_name]))? $notif[$row->controller_name] : set_value('notifications');
      ?>  
       <ul class="sidebar-menu">
        <li id="<?=$row->controller_name;?>" class="treeview">
          <a href="#">
            <i class="<?=$row->fa_icon?>"></i>
            <span><?=$row->module_name?></span>  <?=$notifications;?>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
            foreach ($sub_module as $row2){
              if($this->rbac->check_module_permission($row2->controller_name)){
              ?>
            <li id="<?=$row2->controller_name?>"><a href="<?= base_url('admin/'.$row2->controller_name); ?>"><i class="fa fa-circle-o"></i> <?=$row2->module_name?></a></li>
          <?php }
            } ?>
          </ul>
        </li>
      </ul>
      <?php endif;
      } ?>


    </section>
    <!-- /.sidebar -->
  </aside>

  
<script>
  $("#<?= $cur_tab ?>").addClass('active');
</script>
