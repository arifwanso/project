
<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
}else if($_GET['o']=='addNew'){
    echo "<div class='div-request div-hide'>addNew</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">หน้าหลัก</a></li>
  <li>ซื้อสินค้า</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		ทำการซื้อ
		<?php }else if($_GET['o'] == 'addNew'){?>
		ซื้อสินค้าใหม่<?php
		}
		else if($_GET['o'] == 'manord') { ?>
			รายการการซื้อ
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "เพิ่มสินค้า";
	}else if($_GET['o']=='addNew'){
		echo "เพิ่มสินค้าใหม่";
	}else if($_GET['o'] == 'manord') { 
		echo "ประวัติการซื้อ";
	} else if($_GET['o'] == 'editOrd') { 
		echo "รายละเอียดการซื้อ";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	ทำการซื้อ
		<?php } else if($_GET['o'] == 'addNew') { ?> 
			<i class="glyphicon glyphicon-plus-sign"></i> เพิ่มสินค้าใหม่
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-time"></i> รายการการซื้อ
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-time"></i> รายละเอียดการซื้อ
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createBuy.php" id="createBuyForm">
		 
			  <div class="form-group">
			    <label for="buyDate" class="col-sm-2 control-label">วันที่ที่ทำการซื้อ</label>
			    <div class="col-sm-10">
			      <input type="text" value=<?php date_default_timezone_set("Asia/Bangkok"); echo date('m/d/y');?> class="form-control" id="buyDate" name="buyDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="buyTime" class="col-sm-2 control-label">เวลาที่ทำการซื้อ</label>
			    <div class="col-sm-10">
			      <input type="text" value=<?php date_default_timezone_set("Asia/Bangkok"); echo date("H:i:s");?> class="form-control" id="buyTime" name="buyTime" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:25%;">รายการสินค้า</th>
			  			<th style="width:10%;">ราคาซื้อ</th>
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
										$productSql = "SELECT * FROM product ";
										$productData = $connect->query($productSql);
				
										while($row = $productData->fetch_array() ) {								 		
									    echo"<option  value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
				   							} // /while 
										
			  						?>
									 	
		  						</select>
			  					</div>
			  				</td>
                              </td>
                              <td style="padding-left:20px;">			  					
			  					<input type="text" name="buyPrice[]" id="buyPrice<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="buyPriceValue[]" id="buyPriceValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
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
				    <label for="buyTotal" class="col-sm-3 control-label">ราคารวมทั้งหมด</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="buyTotal" name="buyTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="buyTotalValue" name="buyTotalValue" />
				    </div>
				  </div> <!--/form-group-->		  	  	  			  		  
			  </div> 
			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> เพิ่มจำนวนสินค้า </button>

			      <button type="submit" id="createBuyBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>

			      <button type="reset" class="btn btn-default" onclick="resetBuyForm()"><i class="glyphicon glyphicon-erase"></i> ล้าง</button>
			    </div>
			  </div>
			</form>
			<?php } else if($_GET['o'] == 'addNew') {
				?>
				<form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-product-messages"></div>
			  <div class="form-group">
			    <label for="buyDate" class="col-sm-3 control-label">วันที่ที่ทำการซื้อ: </label>
				<label class="col-sm-1 control-label">: </label>
			    <div class="col-sm-8">
			      <input type="text" value=<?php date_default_timezone_set("Asia/Bangkok"); echo date('m/d/y');?> class="form-control" id="buyDate" name="buyDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="buyTime" class="col-sm-3 control-label">เวลาที่ทำการซื้อ: </label>
				<label class="col-sm-1 control-label">: </label>
			    <div class="col-sm-8">
			      <input type="text" value=<?php date_default_timezone_set("Asia/Bangkok"); echo date("H:i:s");?> class="form-control" id="buyTime" name="buyTime" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
	      	<div class="form-group">
	        	<label for="productImage" class="col-sm-3 control-label">เพิ่มรูปภาพ: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="productImage" placeholder="" name="productImage" class="file-loading" style="width:auto;"/>
					    </div>
				      
				    </div>
	        </div> <!-- /form-group-->	     	  
			<div class="form-group">
	        	<label for="typeName" class="col-sm-3 control-label">ประเภทสินค้า: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="typeName" placeholder="Type Name" name="typeName" >
				      	<option value="">--เลือก--</option>
				      	<?php 
				      	$sql = "SELECT type_id, type_name FROM type";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while					
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->         	       

	        <div class="form-group">
	        	<label for="productName" class="col-sm-3 control-label">ชื่อสินค้า: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="productName" placeholder="" name="productName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">จำนวน: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="quantity" placeholder="" name="quantity" autocomplete="off">
				    </div>        	 
	        </div> <!-- /form-group-->	     	 
			<div class="form-group">
	        	<label for="buyPrice" class="col-sm-3 control-label">ราคาซี้อ: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="buyPrice" placeholder="" name="buyPrice" autocomplete="off">
				    </div>        	 
	        </div> <!-- /form-group-->	    
			<div class="form-group">
	        	<label for="sellPrice" class="col-sm-3 control-label">ราคาขาย: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="sellPrice" placeholder="" name="sellPrice" autocomplete="off">
				    </div>        	 
	        </div> <!-- /form-group-->	           		
			<div class="form-group">
	        	<label for="warning" class="col-sm-3 control-label">จุดสั่งซื้อ: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control " id="warning" placeholder="" name="warning" value="5" autocomplete="off">
				    </div>        	 
	        </div> <!-- /form-group-->	     			        	         	         
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">	        
	        <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     


		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageBuyTable">
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่ที่ทำการซื้อ</th>
						<th>เวลาที่ทำการซื้อ</th>
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

  		<form class="form-horizontal" method="POST" action="php_action/editBuy.php" id="editBuyForm">

  			<?php $buyId = $_GET['i'];

  			$sql = "SELECT buy.buy_id, buy.buy_date,buy_time,buy.buy_total FROM buy	
					WHERE buy.buy_id = {$buyId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>

			  <div class="form-group">
			    <label for="buyDate" class="col-sm-2 control-label">วันที่ที่ทำการซื้อ</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="buyDate" name="buyDate" autocomplete="off" disabled="true" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->  
			  <div class="form-group">
			    <label for="buyTime" class="col-sm-2 control-label">เวลาที่ทำการซื้อ</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="buyTime" name="buyTime" autocomplete="off" disabled="true" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> <!--/form-group-->  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">สินค้า</th>
			  			<th style="width:20%;">ราคาซื้อ</th>
			  			<th style="width:15%;">จำนวน</th>			  			
			  			<th style="width:15%;">ราคารวม</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$buyItemSql = "SELECT buy_item.buy_item_id, buy_item.buy_id, buy_item.product_id, buy_item.quantity, buy_item.rate, buy_item.total FROM buy_item WHERE buy_item.buy_id = {$buyId}";
						$buyItemResult = $connect->query($buyItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($buyItemData = $buyItemResult->fetch_array()) { 
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
			  								if($row['product_id'] == $buyItemData['product_id']) {
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
			  					<input type="text" name="buyPrice[]" id="buyPrice<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $buyItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="buyPriceValue[]" id="buyPriceValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $buyItemData['rate']; ?>" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" disabled="true" autocomplete="off" class="form-control" value="<?php echo $buyItemData['quantity'];?>"; />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $buyItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $buyItemData['total']; ?>"/>			  					
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
				    <label for="buyTotal" class="col-sm-3 control-label">ราคารวมทั้งหมด</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="buyTotal" name="buyTotal" disabled="true" value="<?php echo $data[3] ?>" />
				      <input type="hidden" class="form-control" id="buyTotalValue" name="buyTotalValue" value="<?php echo $data[3] ?>" />
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeBuyModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> ลบรายการสินค้า</h4>
      </div>
      <div class="modal-body">

      	<div class="removeBuyMessages"></div>

        <p>คุณต้องการที่จะลบออกหรือไม่ ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>
        <button type="button" class="btn btn-primary" id="removeBuyBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->

<script src="custom/js/buyss.js"></script>

<?php require_once 'includes/footer.php'; ?>