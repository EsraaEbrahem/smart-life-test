<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Move Bulk Students</li>
</ol>

<div class="panel panel-default">
    <div class="panel-heading">
        Move Bulk Students
    </div>
    <div class="panel-body">
        <div id="messages"></div>

        <form action="<?php echo base_url('student/moveBulk') ?>" method="post" id="moveStudentsForm">
            <div class="col-md-12">
                <fieldset>
                    <legend>Current Class/Section Info</legend>
                    <div class="form-group">
                        <label>Class: <?= ' ' . $className ?></label>
                    </div>
                    <div class="form-group">
                        <label>Section: <?= ' ' . $sectionName ?></label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Move to Class/Section</legend>
                    <div class="form-group">
                        <label for="className">Class</label>
                        <select class="form-control" name="className" id="className">
                            <option value="">Select</option>
                            <?php foreach ($classData as $key => $value) { ?>
                                <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sectionName">Section</label>
                        <select class="form-control" name="sectionName" id="sectionName">
                            <option value="">Select Class</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="moveDate">Move Date</label>
                        <input type="text" class="form-control" id="moveDate" name="moveDate"
                               placeholder="Move Date" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <input type="text" class="form-control" id="reason" name="reason"
                               placeholder="Reason" autocomplete="off">
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Select Students</legend>
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($studentsData as $key => $value) { ?>
                                <tr>
                                    <td><input type="checkbox" name="students[]" value="<?= $value['student_id'] ?>" class="form-control"/></td>
                                    <td><?= $value['fname'] . ' ' . $value['lname'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </fieldset>
            </div>
            <!-- /col-md-12 -->

            <div class="col-md-12">

                <br/> <br/>
                <center>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-default">Reset</button>
                </center>
            </div>
        </form>
    </div>
    <!-- /panle-bdy -->
</div>
<!-- /.panel -->
<script type="text/javascript" src="<?php echo base_url('custom/js/student-shared.js') ?>"></script>
