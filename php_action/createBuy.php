<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'buy_id' => '');
// print_r($valid);
if($_POST) {	

  $buyDate 					= date('Y-m-d', strtotime($_POST['buyDate']));	
  $buyTime                     = date('H:i:s', strtotime($_POST['buyTime']));
  $buyTotalValue 				= $_POST['buyTotalValue'];

	
				
	$sql = "INSERT INTO buy (buy_date,buy_time,buy_total) VALUES ('$buyDate','$buyTime','$buyTotalValue')";
	
	
	$buy_id;
	if($connect->query($sql) === true) {
		$buy_id = $connect->insert_id;
		$valid['buy_id'] = $buy_id;	
	}
	
		
	// echo $_POST['productName'];

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] + $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);



				// add into order_item
				$buyItemSql = "INSERT INTO buy_item (buy_id, product_id, quantity, rate, total) 
				VALUES ('$buy_id','".$_POST['productName'][$x]."','".$_POST['quantity'][$x]."','".$_POST['buyPriceValue'][$x]."','".$_POST['totalValue'][$x]."')";

				$connect->query($buyItemSql);		
					
		} // while	
	} // /for quantity


	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);