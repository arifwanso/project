<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$buyId = $_POST['buyId'];

if($buyId) { 

 $sql = "DELETE FROM buy WHERE buy_id = {$buyId}";

 $buyItem = "DELETE FROM buy_item WHERE buy_id = {$buyId}";

 if($connect->query($sql) === TRUE && $connect->query($buyItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "ลบสำเร็จ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST