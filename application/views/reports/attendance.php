<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li> 
 <li class="active">Attendance Report</li>
</ol>

<div class="panel panel-default">
  <div class="panel-heading">
    Attendance Report
  </div>
  <div class="panel-body">
  	 <div id="messages"></div>
        <form class="form-horizontal" method="post" id="getAttendanceReport" action="attendance/report">
		  <div class="form-group">
		    <label for="type" class="col-sm-2 control-label">Select Type</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="type" id="type">
		      	<option value="">Select</option>
		      	<option value="1">Student</option>
		      	<option value="2">Teacher</option>
		      </select>
		    </div>
		  </div>
		  <div class="form-group">
		  	<label for="type" class="col-sm-2 control-label">Date</label>
		    <div class="col-sm-10">
		      <input type="text" name="reportDate" id="reportDate" autocomplete="off" class="form-control" placeholder="Date"/>
		    </div>
		  </div>
		  <div id="student-form"></div>

		  <div class="form-group">		  	
		    <div class="col-sm-10 col-sm-offset-2">
		    	<input type="hidden" name="num_of_days" id="num_of_days" autocomplete="off" />
		      	<button type="submit" class="btn btn-primary">Generate Report</button>		  
		    </div>
		  </div>		 
		</form>
		<div id="report-div"></div>
  </div>
  <!-- /panle-bdy -->
</div>
<!-- /.panel -->

<script type="text/javascript" src="<?php echo base_url('custom/js/attendance.js') ?>"></script>