<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Create Student Payment</li>
</ol>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Create Student Payment
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <div id="messages"></div>

                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="type">
                                <option value="">Select Type</option>
                                <option value="1">Individual</option>
                                <option value="2">Bulk</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="div-result"></div>
</div><!-- /div.row -->

<!-- 
MANAGE STUDENT PAYMENT  
-->

<!-- /.update student's payment -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStudentPay">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Student Payment</h4>
            </div>

            <div class="modal-body">
                <div id="edit-student-result"></div>
            </div>
            <!-- /.modal body -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /.remove student payment -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeStudentPay">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Remove Payment</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="removeStudentPayBtn">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- view payment income -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewIncomeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Income Information</h4>
            </div>
            <div class="modal-body">
                <div id="incomeResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url('custom/js/payment-form.js') ?>"></script>