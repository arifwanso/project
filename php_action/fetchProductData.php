<?php 	

require_once 'core.php';

$sql = "SELECT product_id, product_name FROM product Where quantity > 0";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);