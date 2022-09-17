<?php 	



require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.product_image,
 		 product.type_id,product.quantity, product.buy_price,product.sell_price,product.status, 
 		type.type_name,product.warning FROM product,type where product.type_id = type.type_id AND product.warning >= product.quantity AND product.quantity != 0 "; 
		

$result = $connect->query($sql);


$sqls = "UPDATE product SET status='3' Where quantity <= warning AND quantity != 0";
$results = $connect->query($sqls);

$sqlss = "UPDATE product SET status='2' Where quantity <= 0 ";
$resultss = $connect->query($sqlss);

$sqlsss = "UPDATE product SET status='1' Where quantity > warning";
$resultsss = $connect->query($sqlsss);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $status = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active 
 	if($row[7] == 1 ){
 		// activate member
 		$status = "<label class='label label-success'>Available</label>";
 	} elseif($row[7] == 2) {
 		// deactivate member
 		$status = "<label class='label label-danger'>No Available</label>";
 	} // /else
	 elseif($row[7] == 3){
		$status = "<label class='label label-warning'>Warning</label>";

	 }

 	

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row[8], 
 		// quantity
 		$row[1],
 		// type 
 		$row[4], 		 	
 		// status
 		$status,
		 //warning
		 $row[9],
 		// buy 		
 		$row[5],
 		// sell
 		$row[6],		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);