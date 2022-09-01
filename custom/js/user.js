var manageUserTable;

$(document).ready(function() {
	// top nav bar 
	$('#navUser').addClass('active');
	// manage product data table
	manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'php_action/fetchUser.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addUserModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitUserForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#productImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});   

		// submit product form
		$("#submitUserForm").unbind('submit').bind('submit', function() {
			// form validation
			var userName = $("#userName").val();
			var upassword = $("#upassword").val();
			var urole    = $("#urole").val();
			var uemail    = $("#uemail").val();
	
			if(userName == "") {
				$("#userName").after('<p class="text-danger">User name field is required</p>');
				$('#userName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#userName").find('.text-danger').remove();
				// success out for form 
				$("#userName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			

			if(upassword == "") {
				$("#upassword").after('<p class="text-danger">Password field is required</p>');
				$('#upassword').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#upassword").find('.text-danger').remove();
				// success out for form 
				$("#upassword").closest('.form-group').addClass('has-success');	  	
				
			}	// /else

			if(uemail == "") {
				$("#uemail").after('<p class="text-danger">Email field is required</p>');
				$('#uemaile').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#uemail").find('.text-danger').remove();
				// success out for form 
				$("#uemail").closest('.form-group').addClass('has-success');	  	
			}	// /else


			if(urole == "") {
				$("#urole").after('<p class="text-danger">role field is required</p>');
				$('#urole').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#urole").find('.text-danger').remove();
				// success out for form 
				$("#urole").closest('.form-group').addClass('has-success');	  	
			}	// /else

			
				// /else

			if(upassword && userName && urole && uemail) {
				// submit loading button
				$("#createUserBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							// submit loading button
							$("#createUserBtn").button('reset');
							
							$("#submitUserForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-user-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageUserTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit product form

	}); // /add product modal btn clicked
	

	// remove product 	

}); // document.ready fucntion

function editUser(userid = null) {

	if(userid) {
		$("#userid").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {"userid": userid},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				
				$("#editEmail").val(response.email);
				$(".editUserFooter").after('<input type="hidden" name="editUserID" id="editUserID" value="'+response.user_id+'" />');
				//$("#editPassword").val(response.md5(password));
				// quantity
				//$("#editPassword").val(response.quantity);
				
				// update the product data function
				$("#editUserForm").unbind('submit').bind('submit', function() {

					// form validation

					var urole = $("#editRole").val();
					var email = $("#editEmail").val();
					if(urole == "") {
						$("#editRole").after('<p class="text-danger">Role field is required</p>');
						$('#editRole').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editRole").find('.text-danger').remove();
						// success out for form 
						$("#editRole").closest('.form-group').addClass('has-success');	  	
					}	// /else
					if(email == "") {
						$("#editEmail").after('<p class="text-danger">Email field is required</p>');
						$('#editEmail').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editEmail").find('.text-danger').remove();
						// success out for form 
						$("#editEmail").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if( urole && email) {
						// submit loading button
						$("#editUsersBtn").button('loading');

						var form = $(this);
						//var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data:  form.serialize(),
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								//console.log(response);
								$("#editUsersBtn").button('reset');	
								if(response.success == true) {
									// submit loading button
									manageUserTable.ajax.reload(null, false);					
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');								

									//$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-user-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									/*manageUserTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');*/

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the product data function

				// update the product image				

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit product function


// remove product 
function removeUser(userid = null) {
	if(userid) {
		// remove product button clicked
		$("#removeProductBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeUser.php',
				type: 'post',
				data: {userid: userid},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeUserModal").modal('hide');

						// update the product table
						manageUserTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeUserMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if userid
} // /remove product function

function clearForm(oForm) {
	// var frm_elements = oForm.elements;									
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();									
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":	    
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":	    
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file": 
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}