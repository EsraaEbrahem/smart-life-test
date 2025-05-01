<div id="request" class="div-hide"><?php echo $this->input->get('opt'); ?></div>

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li> 
<li class="active">Manage Marks</li>
</ol>

<div class="panel panel-default">
  	<!-- Default panel contents -->
	<div class="panel-heading">Manage Marks</div>
	  
	<div class="panel-body">		  
		<form method="post" action="marksheet/fetchStudentMarksheet" class="form-horizontal" id="fetchStudentMarksheet">
		  	<div class="form-group">
		    	<label for="className" class="col-sm-2 control-label">Class</label>
		    	<div class="col-sm-10">
		    	  	<select class="form-control" name="className" id="className">
		      			<option value="">Select</option>
		      			<?php  
		      			foreach ($classData as $key => $value) {
		      				echo "<option value='".$value['class_id']."'>".$value['class_name']."</option>";
		      			} // /.foreach for class data
		      			?>
		      		</select>
		    	</div>
		  	</div>		  	
		  	<div class="form-group">
		    	<label for="marksheetName" class="col-sm-2 control-label">Marksheet</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="marksheetName" id="marksheetName">
		      			<option value="">Select Class</option>
		      		</select>
		    	</div>
		  	</div>		  	
		  	<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-primary">Submit</button>
		    	</div>
		  	</div>
		</form>
	</div>			  
</div>

<div id="marks-result"></div>



<!-- mark the stuent marks of the markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editMarksModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Marksheet</h4>
      </div>
      <div class="modal-body">
      	<div id="edit-mark-message"></div>
        <div id="edit-mark-result"></div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- view the stuent's marks of the markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewMarksModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Marksheet</h4>
      </div>
      <div class="modal-body">      	
        <div id="view-mark-result"></div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?php echo base_url('custom/js/marks.js') ?>"></script>
