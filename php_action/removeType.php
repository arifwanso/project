<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$typeId = $_POST['typeId'];

if($typeId) { 

 $sql = "DELETE FROM type WHERE type_id = {$typeId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "ลบสำเร็จ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST