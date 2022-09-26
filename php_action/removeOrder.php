<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$sellId = $_POST['sellId'];

if($sellId) { 

 $sql = "DELETE FROM sell WHERE sell_id = {$sellId}";

 $sellItem = "DELETE FROM sell_item WHERE sell_id = {$sellId}";

 if($connect->query($sql) === TRUE && $connect->query($sellItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "ลบสำเร็จ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST