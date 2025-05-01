var managePaymentTable;
var manageStudentPayTable;
var manageExpeneseTable;
var manageIncomeTable;

var base_url = $("#base_url").val();

$(document).ready(function() {
	$("#topAccountMainNav").addClass('active');

		$("#expNav").addClass('active');

		manageExpeneseTable = $("#manageExpeneseTable").DataTable({
			'ajax' : base_url + 'accounting/fetchExpensesData',
			'order' : []			
		});
		$("#totalAmount").attr('disabled', true);
		$("#expensesDate").calendarsPicker({
			dateFormat: 'yyyy-mm-dd'
		});
}); // /.document

/*
*-------------------------------
* ADD EXPENSES FUNCTION
*-------------------------------
*/
function addExpenses() 
{
	$("#createEpxensesForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url: url,
			type: type,
			data: form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {						
						$("#add-expenses-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');		
						
						$('.form-group').removeClass('has-error').removeClass('has-success');
						$('.text-danger').remove();		

						manageExpeneseTable.ajax.reload(null, false);

						$("#createEpxensesForm")[0].reset();				
						$(".appended-exp-row").remove();
					}	
					else {									
						
						$.each(response.messages, function(index, value) {
							var key = $("#" + index);

							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.text-danger').remove();							

							key.after(value);
						});
												
					} // /else
			} // /.success
		}); // /.ajax funciton
		return false;
	});
}

/*
*-------------------------------
* ADD EXPENSES ROW FUNCTION
*-------------------------------
*/
function addExpensesRow()
{
	var tableLength = $("#addSubExpensesTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#addSubExpensesTable tbody tr:last").attr('id');
		arrayNumber = $("#addSubExpensesTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	var tr = '<tr id="row'+count+'" class="'+arrayNumber+' appended-exp-row">'+			  						
		'<td class="form-group">'+
			'<input type="text" class="form-control"  name="subExpensesName['+count+']" id="subExpensesName'+count+'" placeholder="Expenses Name" />'+						
		'</td>'+
		'<td class="form-group">'+			
			'<input type="text" class="form-control"  name="subExpensesAmount['+count+']" id="subExpensesAmount'+count+'" onkeyup="calculateTotalAmount()" placeholder="Expenses Amount" />'+									
		'</td>'+		
		'<td class="form-group">'+
			'<button type="button" class="btn btn-default" onclick="removeExpensesRow('+count+')"><i class="glyphicon glyphicon-remove"></i></button>'+
		'</td>'+
	'</tr>';
	
	if(tableLength > 0) {							
		$("#addSubExpensesTable tbody tr:last").after(tr);
	} else {				
		$("#addSubExpensesTable tbody").append(tr);
	}				
}

/*
*-------------------------------
* ADD EXPENSES ROW FUNCTION
*-------------------------------
*/
function addEditExpensesRow()
{
	var tableLength = $("#editSubExpensesTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#editSubExpensesTable tbody tr:last").attr('id');
		arrayNumber = $("#editSubExpensesTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	var tr = '<tr id="row'+count+'" class="'+arrayNumber+' appended-exp-row">'+			  						
		'<td class="form-group">'+
			'<input type="text" class="form-control"  name="editSubExpensesName['+count+']" id="editSubExpensesName'+count+'" placeholder="Expenses Name" />'+						
		'</td>'+
		'<td class="form-group">'+			
			'<input type="text" class="form-control"  name="editSubExpensesAmount['+count+']" id="editSubExpensesAmount'+count+'" onkeyup="editCalculateTotalAmount()" placeholder="Expenses Amount" />'+									
		'</td>'+		
		'<td class="form-group">'+
			'<button type="button" class="btn btn-default" onclick="removeEditExpensesRow('+count+')"><i class="glyphicon glyphicon-remove"></i></button>'+
		'</td>'+
	'</tr>';
	
	if(tableLength > 0) {							
		$("#editSubExpensesTable tbody tr:last").after(tr);
	} else {				
		$("#editSubExpensesTable tbody").append(tr);
	}				
}

/*
*-------------------------------
* REMOVE EXPENSES ROW FUNCTION
*-------------------------------
*/
function removeExpensesRow(row = null)
{
	if(row) {
		$("#addSubExpensesTable #row"+row).remove();	
		calculateTotalAmount();
	}
}



/*
*-------------------------------
* CALCULATES THE SUB AMOUNT OF 
* THE EXPENSES AND EVALUATE THE 
* TOTAL AMOUNT OF THE EXPENSES
*-------------------------------
*/
function calculateTotalAmount()
{
	var tableProductLength = $("#addSubExpensesTable tbody tr").length;
	var totalAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#addSubExpensesTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);
					
		totalAmount = Number(totalAmount) + Number($("#subExpensesAmount"+count).val());


	} // /for

	totalAmount = totalAmount.toFixed(2);

	// sub total
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);
	
}



/*
*--------------------------------------------------------------
* UPDATE EXPESNSE FROM DATABASE
* fetches the expenses data from the expenses and 
* display the expenses data into the edit expenses field
* after that updates the expenses data into the database
*--------------------------------------------------------------
*/
function updateExpenses(id = null) 
{
	if(id) {
		$("#editSubExpensesTable tbody tr").remove();

		$.ajax({
			url: base_url + 'accounting/fetchExpensesDataForUpdate/'+id,
			type: 'post',			
			success:function(response) {
				$("#show-edit-expenses-result").html(response);					

				$("#editTotalAmount").attr('disabled', true);
				$("#editExpensesDate").calendarsPicker({
					dateFormat: 'yyyy-mm-dd'
				});		

				/*SUBMIT FORM*/
				$("#editEpxensesForm").unbind('submit').bind('submit', function() {					
					var form = $(this);
					var url = form.attr('action');
					var type = form.attr('method');

					$.ajax({
						url: url + '/' + id,
						type: type,
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								$("#edit-expenses-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  response.messages + 
								'</div>');		
								
								$('.form-group').removeClass('has-error').removeClass('has-success');
								$('.text-danger').remove();		

								manageExpeneseTable.ajax.reload(null, false);
																
							}	
							else {									
								
								$.each(response.messages, function(index, value) {
									var key = $("#" + index);

									key.closest('.form-group')
									.removeClass('has-error')
									.removeClass('has-success')
									.addClass(value.length > 0 ? 'has-error' : 'has-success')
									.find('.text-danger').remove();							

									key.after(value);
								});
														
							} // /else
							
						} // /.success
					}); // /.ajax
					return false;
				}); // /.submit edit expenses form
				
			} // /success
		}); // /.ajax
	} // /.if
} // /.update epxense function

/*
*-------------------------------------
* REMOVE EXPESNSE ROW FROM THE TABLE
*-------------------------------------
*/
function removeEditExpensesRow(row = null)
{
	if(row) {		
		$("#editSubExpensesTable #row"+row).remove();	
		editCalculateTotalAmount();
	}
}

/*
*-------------------------------
* CALCULATE THE TOTAL AMOUNT
*-------------------------------
*/
function editCalculateTotalAmount()
{
	var tableProductLength = $("#editSubExpensesTable tbody tr").length;
	var totalAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#editSubExpensesTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);
					
		totalAmount = Number(totalAmount) + Number($("#editSubExpensesAmount"+count).val());
	} // /for

	totalAmount = totalAmount.toFixed(2);

	// sub total
	$("#editTotalAmount").val(totalAmount);
	$("#editTotalAmountValue").val(totalAmount);
	
}


/*
*-------------------------------
* REMOVE EXPESNSE FROM DATABASE
*-------------------------------
*/
function removeExpenses(id = null)
{
	if(id) {
		$("#removeExpensesBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: base_url + 'accounting/removeExpenses/'+id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#removeExpensesModal").modal('hide');

					if(response.success == true) {						
						$("#remove-expenses-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');												

						manageExpeneseTable.ajax.reload(null, false);											
					}	
					else {									
						
						$("#remove-expenses-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');		
												
					} // /else
				}
			});
		});
	}
}

/*
* -------------------------------------------
* view the income 
* -------------------------------------------
*/
function viewIncome(paymentId = null)
{
	if(paymentId) {
		$('#incomeResult').load(base_url + 'accounting/viewIncomeDetail/'+paymentId);
	}
}