<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date'";
	$query = $connect->query($sql);

	$sum = "SELECT SUM(sub_total)FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date' ";
	$total = $connect->query($sum);
	

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>วันที่ที่ทำการเบิก</th>
			<th>รายชื่อผู้เบิก</th>
			<th>เบอร์โทรศัพท์</th>
			<th>หมายเหตุ</th>
			<th>ราคารวม</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc() ) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['client_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['description'].'</center></td>
				<td><center>'.$result['sub_total'].'</center></td>
			</tr>';
			//$total = $result['sub_total'] ;
			$totalAmount += $result['sub_total'];
			//$totalAmount =  $result['sub_total'] ;
		}
		$table .= '
		
		</tr>
		<tr>
		
			<td colspan="4"><center>ราคารวมทั้งหมด</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>

	</table>
	';	

	echo $table;

}

?>