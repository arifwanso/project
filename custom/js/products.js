var manageProductTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	// manage product data table
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'php_action/fetchProduct.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addProductModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitProductForm")[0].reset();		

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
		$("#submitProductForm").unbind('submit').bind('submit', function() {

			// form validation
			var productImage = $("#productImage").val();
			var productName = $("#productName").val();
			var quantity = $("#quantity").val();
			var typeName = $("#typeName").val();
			var buyPrice = $("#buyPrice").val();
			var sellPrice = $("#sellPrice").val();
			var warning = $("#warning").val();
	
			if(productImage == "") {
				$("#productImage").closest('.center-block').after('<p class="text-danger">Product Image field is required</p>');
				$('#productImage').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productImage").find('.text-danger').remove();
				// success out for form 
				$("#productImage").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(productName == "") {
				$("#productName").after('<p class="text-danger">Product Name field is required</p>');
				$('#productName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productName").find('.text-danger').remove();
				// success out for form 
				$("#productName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(quantity == "") {
				$("#quantity").after('<p class="text-danger">Quantity field is required</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#quantity").find('.text-danger').remove();
				// success out for form 
				$("#quantity").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(typeName == "") {
				$("#typeName").after('<p class="text-danger">TypeName field is required</p>');
				$('#typeName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#typeName").find('.text-danger').remove();
				// success out for form 
				$("#typeName").closest('.form-group').addClass('has-success');	  	
			}	// /else
			if(buyPrice == "") {
				$("#buyPrice").after('<p class="text-danger">Buyprice field is required</p>');
				$('#buyPrice').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#buyPrice").find('.text-danger').remove();
				// success out for form 
				$("#buyPrice").closest('.form-group').addClass('has-success');	  	
			}	// /else
			if(sellPrice == "") {
				$("#sellPrice").after('<p class="text-danger">Sellprice field is required</p>');
				$('#selPrice').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#sellPrice").find('.text-danger').remove();
				// success out for form 
				$("#sellPrice").closest('.form-group').addClass('has-success');	  	
			}	// /else
			if(warning == "") {
				$("#warning").after('<p class="text-danger">productStatus field is required</p>');
				$('#warning').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#warning").find('.text-danger').remove();
				// success out for form 
				$("#warning").closest('.form-group').addClass('has-success');	  	
			}	// /else


			if(productImage && productName && quantity && typeName && buyPrice && sellPrice && warning) {
				// submit loading button
				$("#createProductBtn").button('loading');

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
							$("#createProductBtn").button('reset');
							
							$("#submitProductForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-product-messages').html('<div class="alert alert-success">'+
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
							manageProductTable.ajax.reload(null, true);

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

function editProduct(productId = null) {

	if(productId) {
		$("#productId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedProduct.php',
			type: 'post',
			data: {productId: productId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				$("#getProductImage").attr('src', 'stock/'+response.product_image);

				$("#editProductImage").fileinput({		      
				});  

				// $("#editProductImage").fileinput({
		  //     overwriteInitial: true,
			 //    maxFileSize: 2500,
			 //    showClose: false,
			 //    showCaption: false,
			 //    browseLabel: '',
			 //    removeLabel: '',
			 //    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			 //    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			 //    removeTitle: 'Cancel or reset changes',
			 //    elErrorContainer: '#kv-avatar-errors-1',
			 //    msgErrorClass: 'alert alert-block alert-danger',
			 //    defaultPreviewContent: '<img src="stock/'+response.product_image+'" alt="Profile Image" style="width:100%;">',
			 //    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		  // 		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				// });  

				// product id 
				$(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
				$(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');				
				
				// product name
				$("#editProductName").val(response.product_name);
				// quantity
				$("#editQuantity").val(response.quantity);
				// type name
				$("#editTypeName").val(response.type_id);
				// buyPrice
				$("#editbuyPrice").val(response.buy_price);
				// sellPrice
				$("#editsellPrice").val(response.sell_price);
				// warning
				$("#editwarning").val(response.warning);


				// update the product data function
				$("#editProductForm").unbind('submit').bind('submit', function() {

					// form validation
					var productImage = $("#editProductImage").val();
					var productName = $("#editProductName").val();
					var quantity = $("#editQuantity").val();
					var typeName = $("#editTypeName").val();
					var buyPrice = $("#editbuyPrice").val();
					var sellPrice = $("#editsellPrice").val();
					var Warning = $("#editwarning").val();
								
					if(productName == "") {
						$("#editProductName").after('<p class="text-danger">Product Name field is required</p>');
						$('#editProductName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductName").find('.text-danger').remove();
						// success out for form 
						$("#editProductName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(quantity == "") {
						$("#editQuantity").after('<p class="text-danger">Quantity field is required</p>');
						$('#editQuantity').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editQuantity").find('.text-danger').remove();
						// success out for form 
						$("#editQuantity").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(typeName == "") {
						$("#editTypeName").after('<p class="text-danger">Type Name field is required</p>');
						$('#editTypeName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editTypeName").find('.text-danger').remove();
						// success out for form 
						$("#editTypeName").closest('.form-group').addClass('has-success');	  	
					}	// /else
					if(buyPrice == "") {
						$("#editbuyPrice").after('<p class="text-danger">BuyPrice field is required</p>');
						$('#editbuyPrice').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editbuyPrice").find('.text-danger').remove();
						// success out for form 
						$("#editbuyPrice").closest('.form-group').addClass('has-success');	  	
					}	// /else
					if(sellPrice == "") {
						$("#editsellPrice").after('<p class="text-danger">Sellprice field is required</p>');
						$('#editsellPrice').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editsellPrice").find('.text-danger').remove();
						// success out for form 
						$("#editsellPrice").closest('.form-group').addClass('has-success');	  	
					}	// /else
					if(Warning == ""){
						$("#editwarning").after('<p class="text-danger"> Status field is required</p>');
						$('#editwarning').closest('.form-group').addClass('has-error');
					}
					else{	
						// remov error text field
						$("#editwarning").find('.text-danger').remove();
						// success out for form 
						$("#editwarning").closest('.form-group').addClass('has-success');	
					}

					if(productName && quantity && typeName && buyPrice && sellPrice && Warning) {
						// submit loading button
						$("#editProductBtn").button('loading');

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
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editProductBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-product-messages').html('<div class="alert alert-success">'+
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
									manageProductTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the product data function

				// update the product image				
				$("#updateProductImageForm").unbind('submit').bind('submit', function() {					
					// form validation
					var productImage = $("#editProductImage").val();					
					
					if(productImage == "") {
						$("#editProductImage").closest('.center-block').after('<p class="text-danger">Product Image field is required</p>');
						$('#editProductImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductImage").find('.text-danger').remove();
						// success out for form 
						$("#editProductImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(productImage) {
						// submit loading button
						$("#editProductImageBtn").button('loading');

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
									$("#editProductImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-productPhoto-messages').html('<div class="alert alert-success">'+
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
									manageProductTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchProductImageUrl.php?i='+productId,
										type: 'post',
										success:function(response) {
										$("#getProductImage").attr('src', response);		
										}
									});																		

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // /update the product image

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit product function

// remove product 
function removeProduct(productId = null) {
	if(productId) {
		// remove product button clicked
		$("#removeProductBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeProduct.php',
				type: 'post',
				data: {productId: productId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeProductModal").modal('hide');

						// update the product table
						manageProductTable.ajax.reload(null, false);

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
						$(".removeProductMessages").html('<div class="alert alert-success">'+
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
	} // /if productid
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