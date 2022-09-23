<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	พิมพ์รายการที่ขาย
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDates" class="col-sm-2 control-label">วันที่เริ่มทำการขาย</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">วันที่สิ้นสุดทำการขาย</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="" />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> ทำการพิมพ์</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	พิมพ์รายการที่ขายตามประเภท
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/typeReport.php" method="post" id="typeReportForm">
				<div class="form-group">
				    <label for="startDates" class="col-sm-2 control-label">วันที่เริ่มทำการขาย</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDates" name="startDates" placeholder="" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">วันที่สิ้นสุดทำการขาย</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDates" name="endDates" placeholder="" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="type_product" class="col-sm-2 control-label">ประเภทสินค้า</label>
					
					<div class="col-sm-10">
					<select class="form-control select2" name="type_product" id="type_product">
								  <option value="">--เลือก--</option>
									  <?php
										$typeSql = "SELECT * FROM type ";
										$typeData = $connect->query($typeSql);
				
										while($row = $typeData->fetch_array() ) {								 		
									    echo"<option  value='".$row['type_id']."' id='changeType".$row['type_id']."'>".$row['type_name']."</option>";
				   							} // /while 
										
			  						?>
									 	
		  						</select>
				    </div>
				    </div>
				  
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> ทำการพิมพ์</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/reports.js"></script>

<?php require_once 'includes/footer.php'; ?>

