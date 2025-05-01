<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li> 
 <li class="active">Manage Marksheet</li>
</ol>

<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				Class
			</div>

			<div class="list-group">			
				<?php 
				if($classData) {
					$x = 1;
					foreach ($classData as $value) { 
					?>
						<a class="list-group-item classSideBar <?php if($x == 1) { echo 'active'; } ?>" onclick="getClassSection(<?php echo $value['class_id'] ?>)" id="classId<?php echo $value['class_id'] ?>">
				    		<?php echo $value['class_name']; ?>(<?php echo $value['numeric_name']; ?>)
					  	</a>	
					<?php 
					$x++;
					}
				} 
				else {
					?>
					<a class="list-group-item">No Data</a>
					<?php
				} // /else		
				?>
			</div>

		</div>		
	</div>
	<!-- /col-md-4 -->

	<div class="col-md-8">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Manage Marksheet</div>
		  
		  <div class="panel-body">		  
		  	<div id="remove-message"></div>

		  	<div class="result"></div>
		  </div>			  
		</div>
	</div>
	<!-- /col-md-8 -->
</div>

<!-- create marksheet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addMarksheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Marksheet</h4>
      </div>
      <form action="marksheet/create" method="post" id="addMarksheetForm">
      <div class="modal-body">
          <div id="add-marksheet-message"></div>

		  <div class="form-group">
		    <label for="marksheetName">Marksheet Name</label>
		    <input type="text" class="form-control" id="marksheetName" name="marksheetName" placeholder="Marksheet Name" autocomplete="off">
		  </div>
		  <div class="form-group">
		    <label for="date">Exam Date: </label>		    
		    <input type="text" class="form-control" id="date" name="date" autocomplete="off" placeholder="Date" >
		  </div>		  		 
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit marksheet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editMarksheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Marksheet</h4>
      </div>
      <form action="marksheet/update" method="post" id="editMarksheetForm">
      <div class="modal-body">
          <div id="edit-marksheet-message"></div>

		  <div class="form-group">
		    <label for="editMarksheetName">Marksheet Name</label>
		    <input type="text" class="form-control" id="editMarksheetName" name="editMarksheetName" placeholder="Marksheet Name" autocomplete="off">
		  </div>
		  <div class="form-group">
		    <label for="editDate">Exam Date: </label>		    
		    <input type="text" class="form-control" id="editDate" name="editDate" autocomplete="off" placeholder="Date" >
		  </div>		  		 
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMarksheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Marksheet</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="removeMarksheetBtn">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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


<script type="text/javascript" src="<?php echo base_url('custom/js/marksheet.js') ?>"></script>