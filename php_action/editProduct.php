<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
  $productId = $_POST['productId'];
  $productName 		= $_POST['editProductName']; 
  $quantity 			= $_POST['editQuantity'];
  $typeName 	= $_POST['editTypeName'];
  $buyPrice =   $_POST['editbuyPrice'];
  $sellPrice =  $_POST['editsellPrice'];
  $warning	= $_POST['editwarning'];

				
	$sql = "UPDATE product SET product_name = '$productName', type_id = '$typeName', quantity = '$quantity',buy_price = '$buyPrice',sell_price = '$sellPrice', warning = '$warning' WHERE product_id = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "แก้ไขสำเร็จ";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
