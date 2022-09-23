<?php 	

require_once 'core.php';

$sql = "SELECT buy_id,buy_time,buy_date FROM buy ";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$buyId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM buy_item WHERE buy_id = $buyId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Click <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="buy.php?o=editOrd&i='.$buyId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-eye-open"></i> ดู </a></li>

	    <li><a type="button" onclick="printBuy('.$buyId.')"> <i class="glyphicon glyphicon-print"></i> พิมพ์ </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeBuyModal" id="removeBuyModalBtn" onclick="removeBuy('.$buyId.')"> <i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</a></li>       
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