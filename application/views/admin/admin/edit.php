<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Admin</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/admin'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Admin List</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <?php echo form_open(base_url('admin/admin/edit/'.$admin['admin_id']), 'class="form-horizontal"' )?> 
              <!--div class="form-group">
                <label for="username" class="col-sm-2 control-label">User Name</label>

                <div class="col-sm-9">
                  <input type="text" name="username" value="<?= $admin['username']; ?>" class="form-control" id="username" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>

                <div class="col-sm-9">
                  <input type="text" name="firstname" value="<?= $admin['firstname']; ?>" class="form-control" id="firstname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">Last Name</label>

                <div class="col-sm-9">
                  <input type="text" name="lastname" value="<?= $admin['lastname']; ?>" class="form-control" id="lastname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-9">
                  <input type="email" name="email" value="<?= $admin['email']; ?>" class="form-control" id="email" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                <div class="col-sm-9">
                  <input type="number" name="mobile_no" value="<?= $admin['mobile_no']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div-->
        
              <div class="form-group">
                <label for="pegnip" class="col-sm-2 control-label">Personil*</label>
                <div class="col-sm-9">
                  <select name="pegnip" class="form-control" onchange="addEmail(this.value)">
                    <?php
                      if($admin['pegnip']){
                        $getpeg = $this->db->query("select * from m_personil where pegnip=".$admin['pegnip'])->result(); 
                        echo '<option value="'.$admin['pegnip'].'">'.$getpeg[0]->pegnama.'</option>';
                      }else{
                        echo '<option value="">Pilih Personil</option>';
                      }
                    
                      foreach($personil as $peg): 
                        $get_personil = $this->db->query("select * from ci_admin where pegnip=".$peg['pegnip'])->result();
                        $username = (isset($get_personil[0]->username))? '['.$get_personil[0]->username.']' : set_value('username');
                    ?>
                        <option value="<?= $peg['pegnip']; ?>" <?= $admin['pegnip'] == $peg['pegnip']? 'selected':''; ?>><?= $peg['pegnama']; ?></option>
                    <?php  endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" name="email" value="<?= $admin['username']; ?>" class="form-control" id="email" readonly="">
                </div>
              </div>
             <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Admin Role*</label>

                <div class="col-sm-9">
                  <select name="role" class="form-control">
                    <?php foreach($admin_roles as $role): ?>
                      <?php if($role['admin_role_id'] == $admin['admin_role_id']): ?>
                      <option value="<?= $role['admin_role_id']; ?>" selected><?= $role['admin_role_title']; ?></option>
                      <?php else: ?>
                      <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>

              </div>
        
              <div class="form-group">
                <label for="priviledge" class="col-sm-2 control-label">Priviledge*</label>
                <div class="col-sm-9">
                  <select name="priviledge" class="form-control">
                      <option value="1" <?= $admin['priviledge'] == 1? 'selected':''; ?>>Staff</option>
                      <option value="2" <?= $admin['priviledge'] == 2? 'selected':''; ?>>L1</option>
                      <option value="3" <?= $admin['priviledge'] == 3? 'selected':''; ?>>L2</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Status</label>

                <div class="col-sm-9">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($admin['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($admin['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Admin" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
<script type="text/javascript">
  function addEmail(id) {
        $.ajax({
            url: "<?= base_url() ?>admin/admin/addEmail/"+id,
            success: function(data){
                $("#email").val(data);
            }
        });
    }
</script>


<script>
    $("#admin").addClass('active');
  </script>