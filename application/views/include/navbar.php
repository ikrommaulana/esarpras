<?php
$this->load->library('session');
$myphoto = ($this->session->userdata('myphoto'))?'uploads/images/personil/'.$this->session->userdata('myphoto'):'public/dist/img/user2-160x160.jpg';
$admin_role = ($this->session->userdata('admin_role'))?$this->session->userdata('admin_role'):'Admin Role not set';
$nama_priviledge = ($this->session->userdata('nama_priviledge'))?$this->session->userdata('nama_priviledge'):'Priviledge not set';
$labnamasingkat = ($this->session->userdata('labnamasingkat'))?$this->session->userdata('labnamasingkat'):'Laboratorium not set';
?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('admin');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b> SARPRAS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E</b> SARPRAS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--img src="<?= base_url().$myphoto; ?>" class="user-image" alt="User Image"-->
              <span class="hidden-xs"><?= $this->session->userdata('username'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url().$myphoto ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $admin_role; ?>
                <br/>
                  <span style="font-weight:bold;"><?= $nama_priviledge; ?></span>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="#" title="<?= $this->session->userdata('labnama'); ?>"><i class="fa fa-flask" aria-hidden="true"></i> <?=$labnamasingkat;?></a>
                  </div>
                </div>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign out </a>
                </div>
                <div class="pull-left">
                  <a href="<?= base_url('admin/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li-->
        </ul>
      </div>
    </nav>
  </header>
 