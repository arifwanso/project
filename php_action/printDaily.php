<?php 

require_once 'core.php';
	$date = date("d-m-Y");
	$sql = "SELECT product.product_name,sum(sell_item.quantity) as sumquantity ,sum(sell_item.total) as sumtotal,product.buy_price,type.type_name FROM sell,sell_item,product,type WHERE sell.sell_date = date(now()) AND sell.sell_id = sell_item.sell_id AND sell_item.product_id = product.product_id AND type.type_id = product.type_id group by product.product_name";
	$query = $connect->query($sql);
	//$data = $query->fetch_row();
	$table = '
	<h3><center>รายงานการขายสินค้าประจำวันที่ '.$date.'</center></h3>
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>ชื่อสินค้า</th>
			<th>จำนวน</th>
			<th>ราคารวม</th>
			<th>กำไรรวม</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		$totalQuantity = 0;
		$totalProfit = 0;
		while ($result = $query->fetch_array() ) {
			$profit = $result['sumtotal'] - $result['buy_price']*$result['sumquantity'];
			$table .= '<tr>
				<td><center>'.$result['product_name'].'</center></td>
				<td><center>'.$result['sumquantity'].'</center></td>
				<td><center>'.$result['sumtotal'].'</center></td>
				<td><center>'.$profit.'</center></td>
			</tr>';
			//$total = $result['sub_total'] ;
			$totalAmount += $result['sumtotal'];
			$totalQuantity += $result['sumquantity'];
			$totalProfit += $profit;
			/*<h3><center>ประเภทสินค้า'.$data['type.type_name'].'</center></h3>*/
			//$totalAmount =  $result['sub_total'] ;
		}
		$table .= '
		
		</tr>
		<tr>
		
			<td colspan="1"><center>ทั้งหมด</center></td>
			<td><center>'.$totalQuantity.'</center></td>
			<td><center>'.$totalAmount.'</center></td>
			<td><center>'.$totalProfit.'</center></td>
		</tr>

	</table>
	';	
    echo $table;

?>
