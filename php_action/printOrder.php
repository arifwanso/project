<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT order_date, client_name, client_contact,description, sub_total FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2];
$description = $orderData[3]; 
$subTotal = $orderData[4];
$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				วันที่ที่ทำการเบิก : '.$orderDate.'
				<center>ชื่อผู้เบิก : '.$clientName.'</center>
				เบอร์โทรศัพท์ : '.$clientContact.'
				<center>หมายเหตุ : '.$description.'</center>
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>#</th>
			<th>พัสดุ</th>
			<th>ราคา</th>
			<th>จำนวน</th>
			<th>ราคารวม</th>
		</tr>';

		$x = 1;
		while($row = $orderItemResult->fetch_array()) {			
						
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$row[4].'</th>
				<th>'.$row[1].'</th>
				<th>'.$row[2].'</th>
				<th>'.$row[3].'</th>
			</tr>
			';
		$x++;
		} // /while

		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
			<th>ราคารวมทั้งหมด</th>
			<th>'.$subTotal.'</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;