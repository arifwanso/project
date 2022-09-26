<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$typeName = $_POST['editTypeName'];
    $typeId = $_POST['editTypeId'];

	$sql = "UPDATE type SET type_name = '$typeName' WHERE type_id = '$typeId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "แก้ไขสำเร็จ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST