<?php 	

require_once 'core.php';

$sql = "SELECT type_id, type_name FROM type";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 

 while($row = $result->fetch_array()) {
 	$typeId = $row[0];
 	// active 
 

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Click <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editTypeModalBtn" data-target="#editTypeModal" onclick="editType('.$typeId.')"> <i class="glyphicon glyphicon-edit"></i> แก้ไข</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeTypeModal" id="removeTypeModalBtn" onclick="removeType('.$typeId.')"> <i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);