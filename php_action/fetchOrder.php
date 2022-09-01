<?php 	

require_once 'core.php';

$sql = "SELECT sell_id,sell_time, sell_date FROM sell ";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$sellId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM sell_item WHERE sell_id = $sellId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    ตั้งค่า <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="orders.php?o=editOrd&i='.$sellId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-eye-open"></i> ดู </a></li>

	    <li><a type="button" onclick="printOrder('.$sellId.')"> <i class="glyphicon glyphicon-print"></i> พิมพ์ </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$sellId.')"> <i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// image
 		$x,
 		// order date
 		$row[2],
		$row[1], 		 	
 		$itemCountRow, 		 	
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);