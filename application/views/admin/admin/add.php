<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Admin</h4>
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
           
            <?php echo form_open(base_url('admin/admin/add'), 'class="form-horizontal"');  ?> 
              <!--div class="form-group">
                <label for="username" class="col-sm-2 control-label">User Name</label>

                <div class="col-sm-9">
                  <input type="text" name="username" class="form-control" id="username" placeholder="" onkeyup="this.value = this.value.toUpperCase();">
                </div>
              </div>
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>

                <div class="col-sm-9">
                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">Last Name</label>

                <div class="col-sm-9">
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-9">
                  <input type="email" name="email" class="form-control" id="email" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                <div class="col-sm-9">
                  <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div-->
        
              <div class="form-group">
                <label for="pegnip" class="col-sm-2 control-label">User*</label>
                <div class="col-sm-9">
                  <select name="pegnip" class="form-control" onchange="addEmail(this.value)">
                    <option value="">Select Personil</option>
                    <?php foreach($personil as $peg): 
                      $get_personil = $this->db->query("select * from ci_admin where pegnip=".$peg['pegnip'])->result();
                      $username = (isset($get_personil[0]->username))? '['.$get_personil[0]->username.']' : set_value('username');
                      ?>
                      <option value="<?= $peg['pegnip']; ?>"><?= $peg['pegnama'].' '.$username; ?></option>
                    <?php  endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" name="email" class="form-control" id="email" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-9">
                  <input type="text" name="password" class="form-control" id="password" placeholder="">
                </div>
              </div>
        
              <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Admin Role*</label>
                <div class="col-sm-9">
                  <select name="role" class="form-control">
                    <option value="">Select Role</option>
                    <?php foreach($admin_roles as $role): ?>
                      <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
        
              <div class="form-group">
                <label for="priviledge" class="col-sm-2 control-label">Priviledge*</label>
                <div class="col-sm-9">
                  <select name="priviledge" class="form-control">
                    <option value="">Select Priviledge</option>
                      <option value="1">Staff</option>
                      <option value="2">L1</option>
                      <option value="3">L2</option>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add New Admin" class="btn btn-info pull-right">
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