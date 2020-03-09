<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body with-border">
        <div class="col-md-6">
          <h4><i class="fa fa-plus"></i> &nbsp; Add New Menu</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/menu'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Menu List</a>
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
           
            <?php echo form_open(base_url('admin/menu/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="menu_name" class="col-sm-2 control-label">Menu Name</label>
                <div class="col-sm-9">
                  <input type="text" name="menu_name" class="form-control" id="menu_name" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="parent" class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-9">
                  <select name="parent" class="form-control">
                    <option value="_">Parent Menu</option>
                    <?php 
                    $parent = $this->db->query("SELECT * FROM module WHERE parent_name='_' ORDER BY module_name ASC")->result();
                    foreach($parent as $row){?>
                    <option value="<?=$row->controller_name;?>"><?=$row->module_name;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="controller" class="col-sm-2 control-label">Controller</label>
                <div class="col-sm-9">
                  <input type="text" name="controller" class="form-control" id="controller" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="fa_icon" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-9">
                  <input type="text" name="fa_icon" class="form-control" id="fa_icon" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="operation" class="col-sm-2 control-label">Operation</label>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="view">View</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="add">Add</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="edit">Edit</label></div>
                </div>
                <label for="operation" class="col-sm-2 control-label"></label>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="delete">Delete</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="change_status">Change Status</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="access">Access</label></div>
                </div>
              </div>
              <div class="form-group">
                <label for="sort_order" class="col-sm-2 control-label">Order</label>
                <div class="col-sm-9">
                  <input type="number" name="sort_order" class="form-control" id="sort_order" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Add Menu" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
<script>
    $("#menu").addClass('active');
  </script>