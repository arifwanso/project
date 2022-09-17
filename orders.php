<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>ขายสินค้า</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		ทำการขาย
		<?php } else if($_GET['o'] == 'manord') { ?>
			รายการการขาย
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	ทำการขาย
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-time"></i> รายการการขาย
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-time"></i> แก้ไขการขาย
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">
		 
			  <div class="form-group">
			    <label for="sellDate" class="col-sm-2 control-label">วันที่ที่ทำการขาย</label>
			    <div class="col-sm-10">
			      <input type="text" value=<?php date_default_timezone_set("Asia/Bangkok"); echo date('m/d/y');?> class="form-control" id="sellDate" name="sellDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="sellTime" class="col-sm-2 control-label">เวลาที่ทำการขาย</label>
			    <div class="col-sm-10">
			      <input type="text" value=<?php date_default_timezone_set("Asia/Bangkok"); echo date("H:i:s");?> class="form-control" id="sellTime" name="sellTime" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:25%;">รายการสินค้า</th>
			  			<th style="width:10%;">ราคา</th>
			  			<th style="width:10%;">จำนวน</th>	
						<!--<th style="width:10%;">จำนวนที่เหลือ</th>-->			  			
			  			<th style="width:10%;">ราคารวม</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">		
			  				<td style="margin-left:30px;">
			  					<div class="form-group">
										
			  					<select data-live-search="true" class="form-control select2" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">
								  <option value="">--เลือก--</option>
									  <?php
										$productSql = "SELECT * FROM product WHERE quantity > 0";
										$productData = $connect->query($productSql);
				
										while($row = $productData->fetch_array() ) {								 		
									    echo"<option  value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
				   							} // /while 
										
			  						?>
									 	
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="sellPrice[]" id="sellPrice<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="sellPriceValue[]" id="sellPriceValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" onchange="CheckQuantity(<?php echo $x; ?>)" />
			  					</div>
			  				</td>
							 <!--<td style="padding-left:20px;">			  					
			  					<input type="text" name="left[]" id="left<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="left[]" id="left<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>-->
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
							
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="sellTotal" class="col-sm-3 control-label">ราคารวมทั้งหมด</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="sellTotal" name="sellTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="sellTotalValue" name="sellTotalValue" />
				    </div>
				  </div> <!--/form-group-->		  	  	  			  		  
			  </div> 
			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> เพิ่มจำนวนสินค้า </button>

			      <button type="submit" id="createSellBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>

			      <button type="reset" class="btn btn-default" onclick="resetSellForm()"><i class="glyphicon glyphicon-erase"></i> ล้าง</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่ที่ทำการขาย</th>
						<th>เวลาที่ทำการขาย</th>
						<th>จำนวนสินค้า</th>
						<th>จัดการข้อมูล</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $sellId = $_GET['i'];

  			$sql = "SELECT sell.sell_id, sell.sell_date,sell_time,sell.sell_total FROM sell	
					WHERE sell.sell_id = {$sellId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">วันที่ที่ทำการขาย</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" disabled="true" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->  
			  <div class="form-group">
			    <label for="orderTime" class="col-sm-2 control-label">เวลาที่ทำการขาย</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderTime" name="orderTime" autocomplete="off" disabled="true" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> <!--/form-group-->  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">สินค้า</th>
			  			<th style="width:20%;">ราคา</th>
			  			<th style="width:15%;">จำนวน</th>			  			
			  			<th style="width:15%;">ราคารวม</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$sellItemSql = "SELECT sell_item.sell_item_id, sell_item.sell_id, sell_item.product_id, sell_item.quantity, sell_item.rate, sell_item.total FROM sell_item WHERE sell_item.sell_id = {$sellId}";
						$sellItemResult = $connect->query($sellItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($sellItemData = $sellItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>"disabled="true"onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">--เลือก--</option>
			  						<?php
			  							$productSql = "SELECT * FROM product ";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $sellItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="sellPrice[]" id="sellPrice<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $sellItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="sellPriceValue[]" id="sellPriceValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $sellItemData['rate']; ?>" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" disabled="true" autocomplete="off" class="form-control" value="<?php echo $sellItemData['quantity'];?>"; />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $sellItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $sellItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<!--<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>-->
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="sellTotal" class="col-sm-3 control-label">ราคารวมทั้งหมด</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="sellTotal" name="sellTotal" disabled="true" value="<?php echo $data[3] ?>" />
				      <input type="hidden" class="form-control" id="sellTotalValue" name="sellTotalValue" value="<?php echo $data[3] ?>" />
				    </div>
				  </div> <!--/form-group-->			  				 	  		  				 		  		  
			  </div> 
			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <!--<button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> เพิ่มจำนวนสินค้า </button>
				

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>-->
				<button type="button" class="btn btn-default" onclick="history.back()">back</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	




<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> ลบรายการสินค้า</h4>
      </div>
      <div class="modal-body">

      	<div class="removeSellMessages"></div>

        <p>คุณต้องการที่จะลบออกหรือไม่ ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->

<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>