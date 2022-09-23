<?php 	

require_once 'core.php';

$sql = "SELECT product.product_name,sum(sell_item.quantity) as sumquantity ,sum(sell_item.total) as sumtotal,product.buy_price,type.type_name FROM sell,sell_item,product,type WHERE sell.sell_date = date(now()) AND sell.sell_id = sell_item.sell_id AND sell_item.product_id = product.product_id AND type.type_id = product.type_id group by product.product_name";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 while($row = $result->fetch_array()) {
    $profit = $row['sumtotal'] - $row['buy_price'] * $row['sumquantity'];
 	$output['data'][] = array( 		
 	    $row[4],
        $row[0], 		
 		$row[1],
        $row[2],
        $profit		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);