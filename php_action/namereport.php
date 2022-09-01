<?php 

require_once 'core.php';

if($_POST) {
$client_name = $_POST['client_name'];
	$sql = "SELECT * FROM orders WHERE client_name LIKE '%$client_name%'";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>วันที่ที่ทำการเบิก</th>
			<th>ชื่อผู้เบิก</th>
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
