<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'buy_id' => '');

if($_POST) {	
  $buyDate 					= date('Y-m-d', strtotime($_POST['buyDate']));	
  $buyTime                     = date('H:i:s', strtotime($_POST['buyTime']));
  $productName 		= $_POST['productName'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $typeName 	= $_POST['typeName'];
  $buyPrice =   $_POST['buyPrice'];
  $sellPrice =  $_POST['sellPrice'];
  $warning       = $_POST['warning'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (product_name, product_image, type_id,quantity,buy_price,sell_price,warning) 
				VALUES ('$productName', '$url',  '$typeName', '$quantity','$buyPrice','$sellPrice','$warning')";
				if($connect->query($sql) === TRUE) {
					$product_id = $connect->insert_id;
					$valid['product_id'] = $product_id;	
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}
				$buyTotalValue = $buyPrice * $quantity;
				$sqls = "INSERT INTO buy (buy_date,buy_time,buy_total) VALUES ('$buyDate','$buyTime','$buyTotalValue')";
				$buy_id;
				if($connect->query($sqls) === true) {
					$buy_id = $connect->insert_id;
					$valid['buy_id'] = $buy_id;	
				}
			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
		 $buyItemSql = "INSERT INTO buy_item (buy_id, product_id, quantity, rate, total) 
		 VALUES ('$buy_id','$product_id','$quantity','$buyPrice','".$buyTotalValue."')";

		 $connect->query($buyItemSql);		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST