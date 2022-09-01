<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	พิมพ์รายการที่เบิก
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDates" class="col-sm-2 control-label">วันที่เริ่มทำการเบิก</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">วันที่สิ้นสุดทำการเบิก</label>
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
				<i class="glyphicon glyphicon-check"></i>	พิมพ์รายการที่เบิก
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/nameReport.php" method="post" id="nameReportForm">
				  <div class="form-group">
				    <label for="client_name" class="col-sm-2 control-label">รายชื่อ</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" id="client_name" name="client_name" placeholder="กรอกรายชื่อผู้ที่เบิก" />
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