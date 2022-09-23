<?php 	

require_once 'core.php';

$buyId = $_POST['buyId'];

$sql = "SELECT buy_date,buy_time,buy_total FROM buy WHERE buy_id = $buyId";

$buyResult = $connect->query($sql);
$buyData = $buyResult->fetch_array();

$buyDate = $buyData[0];
$buyTime = $buyData[1];
$buyTotal = $buyData[2];

$buyItemSql = "SELECT buy_item.product_id, buy_item.rate, buy_item.quantity, buy_item.total,
product.product_name FROM buy_item
	INNER JOIN product ON buy_item.product_id = product.product_id 
 WHERE buy_item.buy_id = $buyId";
$buyItemResult = $connect->query($buyItemSql);

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">
			<center>
				<center>วันที่ที่ทำการซื้อ : '.$buyDate.'</center>
				เวลาที่ทำการซื้อ: '.$buyTime.'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>#</th>
			<th>สินค้า</th>
			<th>ราคาซื้อ</th>
			<th>จำนวน</th>
			<th>ราคารวม</th>
		</tr>';

		$x = 1;
		while($row = $buyItemResult->fetch_array()) {			
						
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
			<th>'.$buyTotal.'</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;