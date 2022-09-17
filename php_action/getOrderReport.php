<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT sell.sell_date,sell.sell_time,product.product_name,sell_item.quantity,sell_item.total,product.buy_price FROM sell,sell_item,product WHERE sell.sell_date >= '$start_date' AND sell.sell_date <= '$end_date' AND sell.sell_id = sell_item.sell_id AND sell_item.product_id = product.product_id";
	$query = $connect->query($sql);

	

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>วันที่ที่ทำการขาย</th>
			<th>เวลาที่ทำการขาย</th>
			<th>ชื่อสินค้า</th>
			<th>จำนวน</th>
			<th>ราคารวม</th>
			<th>กำไรรวม</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		$totalQuantity = 0;
		$totalProfit = 0;

		while ($result = $query->fetch_assoc() ) {
			$profit = $result['total'] - $result['buy_price']*$result['quantity'];
			$table .= '<tr>
				<td><center>'.$result['sell_date'].'</center></td>
				<td><center>'.$result['sell_time'].'</center></td>
				<td><center>'.$result['product_name'].'</center></td>
				<td><center>'.$result['quantity'].'</center></td>
				<td><center>'.$result['total'].'</center></td>
				<td><center>'.$profit.'</center></td>
			</tr>';
			//$total = $result['sub_total'] ;
			$totalAmount += $result['total'];
			$totalQuantity += $result['quantity'];
			$totalProfit += $profit;
			//$totalAmount =  $result['sub_total'] ;
		}
		$table .= '
		
		</tr>
		<tr>
		
			<td colspan="3"><center>ทั้งหมด</center></td>
			<td><center>'.$totalQuantity.'</center></td>
			<td><center>'.$totalAmount.'</center></td>
			<td><center>'.$totalProfit.'</center></td>
		</tr>

	</table>
	';	

	echo $table;

}

?>