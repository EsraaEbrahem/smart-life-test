var base_url = $("#base_url").val();

$(document).ready(function() {
	$("#topAttendanceMainNav").addClass('active');

	var request = $("#request").text();

		$("#takeAttendNav").addClass('active');

		// select on the attendance type 
		$("#type").unbind('change').bind('change', function() {
			var id = $(this).val();			
			
			$('.result').load(base_url + 'attendance/fetchAttendaceType/'+id, function() {
				$("#attendance-result").html('');

				$('#date').calendarsPicker({
					dateFormat: 'yyyy-mm-dd'
				});

				$("#className").unbind('change').bind('change', function() {
					var classId = $(this).val();
					$("#sectionName").load( base_url + 'attendance/fetchClassSection/'+classId);
				});

				
				$("#getAttendanceForm").unbind('submit').bind('submit', function() {						
					if(id == 1) {

						var className = $("#className").val();			
						var sectionName = $("#sectionName").val();
						var date = $("#date").val();


						if(className == "") {
							$("#className").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#className").after('<p class="text-danger">The Class field is required</p>');
						} 
						else {
							$("#className").closest('.form-group').removeClass('has-error').addClass('has-success');	
							$(".text-danger").remove();
						}

						if(sectionName == "") {
							$("#sectionName").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#sectionName").after('<p class="text-danger">The Section field is required</p>');
						} 
						else {
							$("#sectionName").closest('.form-group').removeClass('has-error').addClass('has-success');	
							$(".text-danger").remove();
						}

						if(date == "") {
							$("#date").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#date").after('<p class="text-danger">The Date field is required</p>');
						} 
						else {
							$("#date").closest('.form-group').removeClass('has-error').addClass('has-success');	
							$(".text-danger").remove();
						}

						if(className && sectionName && date) {
							$(".form-group").removeClass('has-error').removeClass('has-success');

							$("#attendance-result").load( base_url + 'attendance/getAttendanceTable/'+className+'/'+sectionName + '/' + date + '/' + id, function() {
								// submit the attendance form
								$("#createAttendanceForm").unbind('submit').bind('submit', function() {
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
												$("#attendance-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
												  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
												  response.messages + 
												'</div>');
											}
											else {
												$("#attendance-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
												  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
												  response.messages + 
												'</div>');
											}
										} // /success
									}); // /ajax
									return false;
								});
							});
						}	

					} // /student
					else if(id == 2) {
						var date = $("#date").val();

						if(date == "") {
							$("#date").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#date").after('<p class="text-danger">The Date field is required</p>');
						} 
						else {
							$("#date").closest('.form-group').removeClass('has-error').removeClass('has-success');	
							$(".text-danger").remove();

							$("#attendance-result").load( base_url +'attendance/getAttendanceTable/'+'teacher'+'/'+'teacher' + '/' + date + '/' + id, function() {
								// submit the attendance form
								$("#createAttendanceForm").unbind('submit').bind('submit', function() {
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
												$("#attendance-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
												  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
												  response.messages + 
												'</div>');
											}
											else {
												$("#attendance-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
												  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
												  response.messages + 
												'</div>');
											}
										} // /success
									}); // /ajax
									return false;
								});
							});
						} // /eles

					} // /teahcer			

					return false;
				});	 // /get student for attendance form				
				
			}); 
		}); // /select on the attendance type

});
