<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li> 
  <li class="active">Manage Users</li>
</ol>

<div class="panel panel-primary">
  <div class="panel-heading">
    Manage Users
  </div>
  <div class="panel-body">  	    
      <div id="messages"></div>
      <div class="pull pull-right">
          <a href="<?=base_url('users/createForm')?>"  class="btn btn-info" >
              <i class="glyphicon glyphicon-plus-sign"></i> Add User
          </a>
      </div>
    	<br /> <br /> <br />
    	<table id="manageUserTable" class="table table-bordered">
    		<thead class="bg-primary">
    			<tr>
    				<th>#</th>
    				<th>User Name</th>
    				<th>First Name</th>
    				<th>Last Name</th>
    				<th>Action</th>
    			</tr>
    		</thead>
    	</table>	
    
  </div>
</div>
<!-- remove role -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove User</h4>
      </div>

      <div class="modal-body">
        <div id="remove-messages"></div>
        <p> Do you really want to remove</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="removeUserBtn">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?php echo base_url('custom/js/user.js'); ?>"></script>