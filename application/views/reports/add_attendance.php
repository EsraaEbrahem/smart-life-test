<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Take Attendance</li>
</ol>

<div class="panel panel-default">
    <div class="panel-heading">
        Take Attendance
    </div>
    <div class="panel-body">
        <div id="messages"></div>
        <form class="form-horizontal" method="post" id="getAttendanceForm">
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
            <div class="result"></div>
        </form>

        <div id="attendance-result"></div>
    </div>
    <!-- /panle-bdy -->
</div>
<!-- /.panel -->
<script type="text/javascript" src="<?php echo base_url('custom/js/attendance-form.js') ?>"></script>
