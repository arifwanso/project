<?php 	

require_once 'core.php';

$sellId = $_POST['sellId'];

$valid = array('sell' => array(), 'sell_item' => array());

$sql = "SELECT sell.sell_id, sell.sell_date, sell.sell_time FROM sell 	
	WHERE sell.sell_id = {$sellId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['sell'] = $data;


$connect->close();

echo json_encode($valid);