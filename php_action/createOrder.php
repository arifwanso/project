<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'sell_id' => '');
// print_r($valid);
if($_POST) {	

  $sellDate 					= date('Y-m-d', strtotime($_POST['sellDate']));	
  $sellTime                     = date('H:i:s', strtotime($_POST['sellTime']));
  $sellTotalValue 				= $_POST['sellTotalValue'];

	
				
	$sql = "INSERT INTO sell (sell_date,sell_time,sell_total) VALUES ('$sellDate','$sellTime','$sellTotalValue')";
	
	
	$sell_id;
	if($connect->query($sql) === true) {
		$sell_id = $connect->insert_id;
		$valid['sell_id'] = $sell_id;	
	}
	
		
	// echo $_POST['productName'];

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			if($updateProductQuantityResult[0] >= $_POST['quantity'][$x]){
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);



				// add into order_item
				$sellItemSql = "INSERT INTO sell_item (sell_id, product_id, quantity, rate, total) 
				VALUES ('$sell_id','".$_POST['productName'][$x]."','".$_POST['quantity'][$x]."','".$_POST['sellPriceValue'][$x]."','".$_POST['totalValue'][$x]."')";

				$connect->query($sellItemSql);		
				$valid['success'] = true;
				$valid['messages'] = "ขายสินค้าสำเร็จ";		
			}	
			else{
				$DeleteSql = "DELETE from sell where sell_id = $sell_id";
				$connect->query($DeleteSql);
				$valid['success'] = false;
				$valid['messages'] = "สินค้าไม่เพียงพอโปรดตรวจสอบอีกครั้ง";		
			}
					
		} // while	
	} // /for quantity


	/*$valid['success'] = true;
	$valid['messages'] = "Successfully Added";*/
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);