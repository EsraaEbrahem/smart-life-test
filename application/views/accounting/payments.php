<div id="request" class="div-hide"><?php echo $this->input->get('opt'); ?></div>

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
    <li class="active">Manage Payment</li>
</ol>


<div class="row">
<div class="col-sm-3">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Manage Section
		</div>
		<div class="list-group">
		  	<a type="button" class="list-group-item" id="managePaymentInfo">Manage Payment</a>
		  	<a type="button" class="list-group-item" id="manageStudentPayInfo">Manage Student Payment</a>
		</div>
	</div>
</div><!-- /.col-sm-3 -->
<div class="col-sm-9">
	<div id="managePaymentDiv"></div>	
</div><!-- /.col-sm-9 -->

</div><!-- /div.row -->


<!-- /.update payment -->
<div class="modal fade" tabindex="-1" role="dialog" id="editPayment">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title">Edit Payment</h4>
      	</div>
      
      	<div class="modal-body">
          <div id="edit-student-messages"></div>
      		<div id="edit-result"></div>
    	</div>
      	<!-- /.modal body -->
	                
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- /.remove payment -->
<div class="modal fade" tabindex="-1" role="dialog" id="removePayment">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Payment</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="removePaymentBtn">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- 
MANAGE STUDENT PAYMENT  
-->

<!-- /.update student's payment -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStudentPay">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

<script type="text/javascript" src="<?php echo base_url('custom/js/payments.js') ?>"></script>