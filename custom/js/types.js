var manageTypeTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navType').addClass('active');	

	manageTypeTable = $('#manageTypeTable').DataTable({
		'ajax' : 'php_action/fetchType.php',
		'order': []
	}); // manage categories Data Table

	// on click on submit categories form modal
	$('#addTypeModalBtn').unbind('click').bind('click', function() {
		// reset the form text
		$("#submitTypeForm")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit categories form function
		$("#submitTypeForm").unbind('submit').bind('submit', function() {
			var typeName = $("#typeName").val();
			if(typeName == "") {
				$("#typeName").after('<p class="text-danger">Type field is required</p>');
				$('#typeName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#typeName").find('.text-danger').remove();
				// success out for form 
				$("#typeName").closest('.form-group').addClass('has-success');	  	
			}

			if(typeName) {
				var form = $(this);
				// button loading
				$("#createTypeBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#createTypeBtn").button('reset');

						if(response.success == true) {
							// reload the manage member table 
							manageTypeTable.ajax.reload(null, false);						

	  	  			// reset the form text
							$("#submitTypeForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-type-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}  // if

					} // /success
				}); // /ajax	
			} // if

			return false;
		}); // submit categories form function
	}); // /on click on submit categories form modal	

}); // /document

// edit categories function
function editType(typeId = null) {
	if(typeId) {
		// remove the added categories id 
		$('#editTypeId').remove();
		// reset the form text
		$("#editTypeForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-type-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-type-result').addClass('div-hide');
		//modal footer
		$(".editTypeFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedType.php',
			type: 'post',
			data: {typeId: typeId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-type-result').removeClass('div-hide');
				//modal footer
				$(".editTypeFooter").removeClass('div-hide');	

				// set the categories name
				$("#editTypeName").val(response.type_name);

				// add the categories id 
				$(".editTypeFooter").after('<input type="hidden" name="editTypeId" id="editTTypeId" value="'+response.type_id+'" />');


				// submit of edit categories form
				$("#editTypeForm").unbind('submit').bind('submit', function() {
					var typeName = $("#editTypeName").val();

					if(typeName == "") {
						$("#editTypeName").after('<p class="text-danger">Type field is required</p>');
						$('#editTypeName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editTypeName").find('.text-danger').remove();
						// success out for form 
						$("#editTypeName").closest('.form-group').addClass('has-success');	  	
					}


					if(typeName) {
						var form = $(this);
						// button loading
						$("#editTypeBtn").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editTypeBtn").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									manageTypeTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-type-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
					} // if


					return false;
				}); // /submit of edit categories form

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function

// remove categories function
function removeType(typeId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedType.php',
		type: 'post',
		data: {typeId: typeId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeTypeBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeTypeBtn").button('loading');

				$.ajax({
					url: 'php_action/removeType.php',
					type: 'post',
					data: {typeId:typeId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove categories btn
							$("#removeTypeBtn").button('reset');
							// close the modal 
							$("#removeTypeModal").modal('hide');
							// update the manage categories table
							manageTypeTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} else {
 							// close the modal 
							$("#removeTypeModal").modal('hide');

 							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						
						
					} // /success function
				}); // /ajax function request server to remove the categories data
			}); // /remove categories btn clicked to remove the categories function

		} // /response
	}); // /ajax function to fetch the categories data
} // remove categories function