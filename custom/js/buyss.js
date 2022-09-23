var manageBuyTable;

$(document).ready(function() {

	var divRequest = $(".div-request").text();
	// top nav bar 
	$("#navBuy").addClass('active');

	if(divRequest == 'add')  {
		// add order	
		// top nav child bar 
		$('#topNavAddBuy').addClass('active');	

		// order date picker
		$("#buyDate").datepicker();

		// create order form function
		$("#createBuyForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var buyDate = $("#buyDate").val();
			var buyTime = $("#buyTime").val();

					

			// form validation 
			if(buyDate == "") {
				$("#buyDate").after('<p class="text-danger"> The Buy Date field is required </p>');
				$('#buyDate').closest('.form-group').addClass('has-error');
			} else {
				$('#buyDate').closest('.form-group').addClass('has-success');
			} // /else
			if(buyTime == "") {
				$("#buyTime").after('<p class="text-danger"> The Buy Time field is required </p>');
				$('#buyTime').closest('.form-group').addClass('has-error');
			} else {
				$('#buyTime').closest('.form-group').addClass('has-success');
			} // /else
			// array validation

			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for       		   	
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == '' ){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Quantity Field is required!! </p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for	   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == '' ){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Quantity Field is required!! </p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for       	
	   	

			if(buyDate && buyTime) {
				if(validateProduct == true && validateQuantity == true ) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createBuyBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	' <br /> <br /> <a type="button" onclick="printOrder('+response.buy_id+')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>'+
	            	'<a href="buy.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Buy </a>'+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} 
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create order form function	
	
	} else if(divRequest == 'addNew'){

		$('#topNavAddNewBuy').addClass('active');
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
				var buyDate = $("#buyDate").val();
				var buyTime = $("#buyTime").val();
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
				if(buyDate == "") {
					$("#buyDate").after('<p class="text-danger"> The Buy Date field is required </p>');
					$('#buyDate').closest('.form-group').addClass('has-error');
				} else {
					$('#buyDate').closest('.form-group').addClass('has-success');
				} // /else
				if(buyTime == "") {
					$("#buyTime").after('<p class="text-danger"> The Buy Time field is required </p>');
					$('#buyTime').closest('.form-group').addClass('has-error');
				} else {
					$('#buyTime').closest('.form-group').addClass('has-success');
				} // /else
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
	
	
				if(productImage && buyDate && buyTime && productName && quantity && typeName && buyPrice && sellPrice && warning) {
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
	
		 // /add product modal btn clicked
		
	}else if(divRequest == 'manord') {
		// top nav child bar 
		$('#topNavManageBuy').addClass('active');

		manageBuyTable = $("#manageBuyTable").DataTable({
			'ajax': 'php_action/fetchBuy.php',
			'buy': []
		});		
					
	} else if(divRequest == 'editOrd') {
		$("#buyDate").datepicker();

		// edit order form function
		$("#editBuyForm").unbind('submit').bind('submit', function() {
			// alert('ok');
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var buyDate = $("#buyDate").val();
			var buyTime = $("buyTime").val();
			// form validation 
			if(buyDate == "") {
				$("#buyDate").after('<p class="text-danger"> The Buy Date field is required </p>');
				$('#buyDate').closest('.form-group').addClass('has-error');
			} else {
				$('#buyDate').closest('.form-group').addClass('has-success');
			} // /else
			if(buyTime == "") {
				$("#buyTime").after('<p class="text-danger"> The Buy Time field is required </p>');
				$('#buyTime').closest('.form-group').addClass('has-error');
			} else {
				$('#buyTime').closest('.form-group').addClass('has-success');
			} // /else
			
			// array validation
			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for       		   	
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Quantity Field is required!! </p>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for       	
	   	

			if(buyDate && buyTime) {
				if(validateProduct == true && validateQuantity == true) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#editBuyBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /edit order form function	
	} 	

}); // /documernt


// print order function
function printBuy(buyId = null) {
	if(buyId) {		
			
		$.ajax({
			url: 'php_action/printBuy.php',
			type: 'post',
			data: {buyId: buyId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Order Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function
$('.select2').select2({
	theme:'bootstrap4',
	tags:true,
	allowClear: true,
  });
  let initializeSelect2 =  function() {
	$('.select2').select2({
		theme:'bootstrap4',
		tags:true,
		allowClear: true,
});
  }
function addRow() {
	$("#addRowBtn").button("loading");

	
	
	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
	$.ajax({
		url: 'php_action/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			
			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+
					'<select class="form-control select2" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+initializeSelect2()+	
						'<option value="">--เลือก--</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value[0]+'">'+value[1]+'</option>';	
						});			
						tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;"">'+
				'<input type="text" name="buyPrice[]" id="buyPrice'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
					'<input type="hidden" name="buyPriceValue[]" id="buyPriceValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+									
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {						
				$("#productTable tbody tr:last").after(tr);
				initializeSelect2().after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data


} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getProductData(row = null) {
	if(row) {
		var productId = $("#productName"+row).val();		
		
		if(productId == "") {
			$("#buyPrice"+row).val("");
			$("#quantity"+row).val("");						
			$("#total"+row).val("");

			// remove check if product name is selected
			// var tableProductLength = $("#productTable tbody tr").length;			
			// for(x = 0; x < tableProductLength; x++) {
			// 	var tr = $("#productTable tbody tr")[x];
			// 	var count = $(tr).attr('id');
			// 	count = count.substring(3);

			// 	var productValue = $("#productName"+row).val()

			// 	if($("#productName"+count).val() == "") {					
			// 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');	
			// 		console.log("#changeProduct"+count);
			// 	}											
			// } // /for

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#buyPrice"+row).val(response.buy_price);
					$("#buyPriceValue"+row).val(response.buy_price);
					$("#quantity"+row).val(1);
					var total = Number(response.buy_price) * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					
					// check if product name is selected
					// var tableProductLength = $("#productTable tbody tr").length;					
					// for(x = 0; x < tableProductLength; x++) {
					// 	var tr = $("#productTable tbody tr")[x];
					// 	var count = $(tr).attr('id');
					// 	count = count.substring(3);

					// 	var productValue = $("#productName"+row).val()

					// 	if($("#productName"+count).val() != productValue) {
					// 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');	
					// 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');								
					// 		console.log("#changeProduct"+count);
					// 	}											
					// } // /for
			
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

// table total
function getTotal(row = null) {
	if(row) {
		var total = Number($("#buyPrice"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#buyTotal").val(totalSubAmount);
	$("#buyTotalValue").val(totalSubAmount);
} // /sub total amount
function resetBuyForm() {
	// reset the input field
	$("#createBuyForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form



// remove order from server
function removeBuy(buyId = null) {
	if(buyId) {
		$("#removeBuyBtn").unbind('click').bind('click', function() {
			$("#removeBuyBtn").button('loading');

			$.ajax({
				url: 'php_action/removeBuy.php',
				type: 'post',
				data: {buyId : buyId},
				dataType: 'json',
				success:function(response) {
					$("#removeBuyBtn").button('reset');

					if(response.success == true) {

						manageBuyTable.ajax.reload(null, false);
						// hide modal
						$("#removeBuyModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
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
						// error messages
						$(".removeBuyMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
// /remove order from server


