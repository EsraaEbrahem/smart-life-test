var base_url = $("#base_url").val();

$(document).ready(function() {
	$("#topAccountMainNav").addClass('active');

		$("#createStudentNav").addClass('active');

		// fetching the payment type id
		$("#type").unbind('change').bind('change', function() {
			var id = $(this).val();

			$("#div-result").load(base_url + 'accountingFetchType/'+id, function() {

				$(".file-loading").fileinput({
					overwriteInitial: true,
					maxFileSize: 1500,
					showClose: false,
					showCaption: false,
					showBrowse: false,
					browseOnZoneClick: true,
					removeLabel: '',
					removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
					removeTitle: 'Cancel or reset changes',
					elErrorContainer: '#kv-avatar-errors-2',
					msgErrorClass: 'alert alert-block alert-danger',
					defaultPreviewContent: '<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="Image Or PDF" style="width:50px;height:50px;"><h6 class="text-muted">Click to select</h6>',
					layoutTemplates: {main2: '{preview} {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "JPG", "PNG", "PDF","pdf"]
				});

				// start and date calendar picker
				$('#startDate').calendarsPicker({
					dateFormat: 'yyyy-mm-dd'
				});
				$('#endDate').calendarsPicker({
					dateFormat: 'yyyy-mm-dd'
				});

				// selecting the class to fetch section data
				$("#className").unbind('change').bind('change', function() {					
					var classId = $(this).val();
					
					$("#sectionName").load(base_url + 'accounting/fetchClassSection/'+classId, function() {
						var sectionId = $(this).val();
						
						$("#studentName").load(base_url + 'accounting/fetchStudent/'+classId+'/'+sectionId+'/'+id);							


						
					}); // /.fetching the selected class's section date					

					// change in section
					$("#sectionName").unbind('change').bind('change', function() {
						var sectionId = $(this).val();
						$("#studentName").load(base_url + 'accounting/fetchStudent/'+classId+'/'+sectionId+'/'+id);
					}); // .change in section

				}); // /.selecting the class to fetch section data			

				/*
				* ----------------------------------------------------
				* submit the create individual form
				* ----------------------------------------------------
				*/
				$("#createIndividualForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					var url = form.attr('action');
					var type = form.attr('method');
					var formData = new FormData($(this)[0]);

					$.ajax({
						url: url,
						type: type,
						data: formData,
						dataType: 'json',
						cache: false,
						contentType: false,
						processData: false,
						async: false,
						success:function(response) {
							if(response.success == true) {
								$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  response.messages + 
								'</div>');		
								
								$('.form-group').removeClass('has-error').removeClass('has-success');
								$('.text-danger').remove();

								$('#createIndividualForm')[0].reset();
								$('#className').val('');
								$('#sectionName').html('<option value="">Select Class</option>');
								$('#studentName').html('<option value="">Select Class & Section</option>');

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
							}
						} // /.success
					}); // /.ajax

					return false;
				});
			
								
				/*
				* ----------------------------------------------------
				* submit the bulk form
				* ----------------------------------------------------
				*/
				$("#createBulkForm").unbind('submit').bind('submit', function() {						
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
								$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  response.messages + 
								'</div>');		
								
								$('.form-group').removeClass('has-error').removeClass('has-success');
								$('.text-danger').remove();

								$('#createBulkForm')[0].reset();
								$('#className').val('');
								$('#sectionName').html('<option value="">First Select Class</option>');

								$('#studentName').html('<thead><tr><th>#</th><th>Name</th></tr></thead><tbody><tr><td colspan="2"><center>First Select Class and Section</center></td></tr></tbody>');

							} 
							else {
								if(response.messages instanceof Object) {
									$.each(response.messages, function(index, value) {
										var key = $("#" + index);

										key.closest('.form-group')
										.removeClass('has-error')
										.removeClass('has-success')
										.addClass(value.length > 0 ? 'has-error' : 'has-success')
										.find('.text-danger').remove();							

										key.after(value);
									});
								} 
								else {
									$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  response.messages + 
									'</div>');										
								}
							}
						} // /.success
					}); // /.ajax

					return false;
				});													
			}); // /.fetching the type form 

		});
}); // /.document
