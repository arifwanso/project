<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$buyId = $_POST['buyId'];

	$buyDate 					= date('Y-m-d', strtotime($_POST['buyDate']));
	$buyTime                     = date('H:i', strtotime($_POST['buyTime']));
  $buyTotalValue 				= $_POST['buyTotalValue'];


				
	$sql = "UPDATE buy SET buy_date = '$buyDate', buy_total = '$buyTotalValue',  buy_time = '$buyTime' WHERE buy_id = {$buyId}";	
	$connect->query($sql);
	
	$readyToUpdateBuyItem = false;
	// add the quantity from the order item to product table
	for($x = 0; $x < count($_POST['productName']); $x++) {		
		//  product table
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);			
			
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			// order item table add product quantity
			$buyItemTableSql = "SELECT buy_item.quantity FROM buy_item WHERE buy_item.buy_id = {$buyId}";
			$buyItemResult = $connect->query($buyItemTableSql);
			$buyItemData = $buyItemResult->fetch_row();

			$editQuantity = $updateProductQuantityResult[0] + $buyItemData[0];							

			$updateQuantitySql = "UPDATE product SET quantity = $editQuantity WHERE product_id = ".$_POST['productName'][$x]."";
			$connect->query($updateQuantitySql);		
		} // while	
		
		if(count($_POST['productName']) == count($_POST['productName'])) {
			$readyToUpdateBuyItem = true;			
		}
	} // /for quantity

	// remove the order item data from order item table
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$removeBuySql = "DELETE FROM buy_item WHERE buy_id = {$buyId}";
		$connect->query($removeBuySql);	
	} // /for quantity

	if($readyToUpdateBuyItem) {
			// insert the order item data 
		for($x = 0; $x < count($_POST['productName']); $x++) {			
			$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
			$updateProductQuantityData = $connect->query($updateProductQuantitySql);
			
			while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
				$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
					// update product table
					$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
					$connect->query($updateProductTable);

					// add into order_item
				$buyItemSql = "INSERT INTO buy_item (buy_id, product_id, quantity, rate, total) 
				VALUES ({$buyId}, '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."')";

				$connect->query($buyItemSql);		
			} // while	
		} // /for quantity
	}

	

	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);