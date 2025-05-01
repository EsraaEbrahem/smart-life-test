<div id="request" class="div-hide"><?php echo $this->input->get('opt'); ?></div>

<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Manage Student</li>
</ol>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                Class
            </div>

            <div class="list-group">
                <?php
                if ($classData) {
                    $x = 1;
                    foreach ($classData as $value) {
                        ?>
                        <a class="list-group-item classSideBar <?php if ($x == 1) {
                            echo 'active';
                        } ?>" onclick="getClassSection(<?php echo $value['class_id'] ?>)"
                           id="classId<?php echo $value['class_id'] ?>">
                            <?php echo $value['class_name']; ?>(<?php echo $value['numeric_name']; ?>)
                        </a>
                        <?php
                        $x++;
                    }
                } else {
                    ?>
                    <a class="list-group-item">No Data</a>
                    <?php
                }
                ?>
            </div>

        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-md-4 -->
    <div class="col-md-8">

        <div class="panel panel-default">
            <div class="panel-heading">Manage Student</div>
            <div class="panel-body">
                <div id="result"></div>

            </div>
            <!-- /panel-body -->
        </div>
        <!-- /panel -->
    </div>
    <!-- /.col-md-08 -->
</div>
<!-- /.row -->

<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStudentModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Student</h4>
            </div>

            <div class="modal-body edit-modal">

                <div id="edit-teacher-messages"></div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Photo</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Personal
                            Detail</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <br/>

                        <form class="form-horizontal" method="post" id="updateStudentPhotoForm"
                              action="student/updatePhoto" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="edit-upload-image-message"></div>

                                    <div class="col-md-6">
                                        <center>
                                            <img src="" id="student_photo" alt="Student Photo"
                                                 class="img-thumbnail upload-photo"/>
                                        </center>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editPhoto" class="col-sm-4 control-label">Photo: </label>
                                            <div class="col-sm-8">
                                                <!-- the avatar markup -->
                                                <div id="kv-avatar-errors-1" class="center-block"
                                                     style="max-width:500px;display:none"></div>
                                                <div class="kv-avatar center-block" style="width:100%">
                                                    <input type="file" id="editPhoto" name="editPhoto"
                                                           class="file-loading"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <center>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </center>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /col-md-6 -->
                                </div>
                                <!-- /col-md-12 -->
                            </div>
                            <!-- /row -->

                        </form>
                    </div>
                    <!-- /tab panel of image -->

                    <div role="tabpanel" class="tab-pane" id="profile">

                        <br/>
                        <form class="form-horizontal" method="post" action="student/updateInfo"
                              id="updateStudentInfoForm">
                            <div class="row">

                                <div class="col-md-12">
                                    <div id="edit-personal-student-message"></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editFname" class="col-sm-4 control-label">First Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editFname" name="editFname"
                                                       placeholder="First Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editLname" class="col-sm-4 control-label">Last Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editLname" name="editLname"
                                                       placeholder="Last Name"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDob" class="col-sm-4 control-label">DOB: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editDob" name="editDob"
                                                       placeholder="Date of Birth"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editAge" class="col-sm-4 control-label">Age: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editAge" name="editAge"
                                                       placeholder="Age"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editContact" class="col-sm-4 control-label">Contact: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editContact"
                                                       name="editContact" placeholder="Contact"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editEmail" class="col-sm-4 control-label">Email: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editEmail" name="editEmail"
                                                       placeholder="Email"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editAddress" class="col-sm-4 control-label">Address: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editAddress"
                                                       name="editAddress" placeholder="Address"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCity" class="col-sm-4 control-label">City: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editCity" name="editCity"
                                                       placeholder="City"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCountry" class="col-sm-4 control-label">Country: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editCountry"
                                                       name="editCountry" placeholder="Country"/>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="editRegisterDate" class="col-sm-4 control-label">Register Date
                                                : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editRegisterDate"
                                                       name="editRegisterDate" placeholder="Register Date"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editClassName" class="col-sm-4 control-label">Class</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="editClassName" id="editClassName">
                                                    <option value="">Select</option>
                                                    <?php foreach ($classData as $key => $value) { ?>
                                                        <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                                                    <?php } // /forwach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editSectionName" class="col-sm-4 control-label">Section</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="editSectionName"
                                                        id="editSectionName">
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /col-md-4 -->

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <center>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col-md-12 -->

                            </div>
                            <!-- /row -->
                        </form>

                    </div>
                    <!-- /tab-panel of teacher information -->
                </div>


            </div>
            <!-- /modal-body -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="moveStudentModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Move Student</h4>
            </div>

            <div class="modal-body">
                <!-- Tab panes -->
                <div class="tab-content">
                        <br/>
                        <form class="form-horizontal" method="post" action="student/applyMove"
                              id="moveStudentForm">
                            <div class="row">

                                <div class="col-md-12">
                                    <div id="move-student-message"></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="moveDate" class="col-sm-4 control-label">Move Date
                                                : </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="moveDate"
                                                       name="moveDate" placeholder="Move Date"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="moveClassName" class="col-sm-4 control-label">Class</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="moveClassName" id="moveClassName">
                                                    <option value="">Select</option>
                                                    <?php foreach ($classData as $key => $value) { ?>
                                                        <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                                                    <?php } // /forwach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="moveSectionName" class="col-sm-4 control-label">Section</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="moveSectionName"
                                                        id="moveSectionName">
                                                    <option value="">Select Class</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reason" class="col-sm-4 control-label">Reason</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="reason" name="reason"
                                                       placeholder="Reason"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /col-md-4 -->

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <center>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col-md-12 -->

                            </div>
                            <!-- /row -->
                        </form>

                    </div>
                    <!-- /tab-panel of teacher information -->
                </div>


            </div>
            <!-- /modal-body -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- student moves list modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="studentMovesModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Student Moves</h4>
            </div>
            <div class="modal-body ">
                <table id="manageStudentMovesTable" class="table table-bordered" style="width: 100%">
                    <thead class="bg-primary">
                    <tr>
                        <th>Student Name</th>
                        <th>Class Name</th>
                        <th>Section Name</th>
                        <th>Move Date</th>
                        <th>Reason</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove studet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeStudentModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Remove Student</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="removeStudentBtn">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url('custom/js/student-shared.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('custom/js/student.js') ?>"></script>
