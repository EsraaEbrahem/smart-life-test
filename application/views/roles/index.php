<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li> 
  <li class="active">Manage Roles</li>
</ol>

<div class="panel panel-primary">
  <div class="panel-heading">
    Manage Roles
  </div>
  <div class="panel-body">  	    
      <div id="messages"></div>
      <div class="pull pull-right">
          <a href="<?=base_url('roles/createForm')?>"  class="btn btn-info" >
              <i class="glyphicon glyphicon-plus-sign"></i> Add Role
          </a>
      </div>
    	<br /> <br /> <br />
    	<table id="manageRoleTable" class="table table-bordered">
    		<thead class="bg-primary">
    			<tr>
    				<th>#</th>
    				<th>Role Name</th>
    				<th>Action</th>
    			</tr>
    		</thead>
    	</table>	
    
  </div>
</div>
<!-- remove role -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeRoleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Role</h4>
      </div>

      <div class="modal-body">
        <div id="remove-messages"></div>
        <p> Do you really want to remove</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="removeRoleBtn">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?php echo base_url('custom/js/role.js'); ?>"></script>