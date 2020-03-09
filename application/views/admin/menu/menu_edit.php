<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-body">
        <div class="col-md-6">
          <h4><i class="fa fa-pencil"></i> &nbsp; Edit Menu</h4>
        </div>
        <div class="col-md-6 text-right">
          <a href="<?= base_url('admin/menu'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Menu List</a>
          <a href="<?= base_url('admin/menu/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Menu</a>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Menu</h3>
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
           
            <?php echo form_open(base_url('admin/menu/edit/'.$menu['module_id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="menu_name" class="col-sm-2 control-label">Menu Name</label>
                <div class="col-sm-9">
                  <input type="text" name="menu_name" class="form-control" id="menu_name" value="<?=$menu['module_name'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="parent" class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-9">
                  <select name="parent" class="form-control">
                    <option value="_">Parent Menu</option>
                    <?php 
                    $parent = $this->db->query("SELECT * FROM module WHERE parent_name='_' ORDER BY module_name ASC")->result();
                    $parent_menu = $menu['parent_name'];
                    foreach($parent as $row){?>
                    <option value="<?=$row->controller_name;?>" <?php if($parent_menu==$row->controller_name){ echo "selected";}?>><?=$row->module_name;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="controller" class="col-sm-2 control-label">Controller</label>
                <div class="col-sm-9">
                  <input type="text" name="controller" class="form-control" id="controller" value="<?=$menu['controller_name'];?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="fa_icon" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-9">
                  <input type="text" name="fa_icon" class="form-control" id="fa_icon" value="<?=$menu['fa_icon'];?>">
                </div>
              </div>
              <?php $operation = explode('|',$menu['operation']); ?>
              <div class="form-group">
                <label for="operation" class="col-sm-2 control-label">Operation</label>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="view" <?php if(in_array('view',$operation)){echo "checked";}?>>View</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="add" <?php if(in_array('add',$operation)){echo "checked";}?>>Add</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="edit" <?php if(in_array('edit',$operation)){echo "checked";}?>>Edit</label></div>
                </div>
                <label for="operation" class="col-sm-2 control-label"></label>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="delete" <?php if(in_array('delete',$operation)){echo "checked";}?>>Delete</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="change_status" <?php if(in_array('change_status',$operation)){echo "checked";}?>>Change Status</label></div>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox"><label><input type="checkbox" name="operation[]" value="access" <?php if(in_array('access',$operation)){echo "checked";}?>>Access</label></div>
                </div>
              </div>
              <div class="form-group">
                <label for="sort_order" class="col-sm-2 control-label">Order</label>
                <div class="col-sm-9">
                  <input type="number" name="sort_order" class="form-control" id="sort_order" value="<?=$menu['sort_order'];?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="Update Menu" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 
<script>
    $("#menu").addClass('active');
  </script>