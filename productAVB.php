<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">สินค้า</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>สินค้า</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>							
				<table class="table" id="manageProductAVBTable">
					<thead>
						<tr>
							<th style="width:10%;">รูป</th>							
							<th>ประเภทสินค้า</th>						
							<th>ชื่อสินค้า</th>
							<th>จำนวน</th>
							<th>สถานะ</th>
							<th>จุดสั่งซื้อ</th>
							<th>ราคาซื้อ</th>
							<th>ราคาขาย</th>		
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
<script src="custom/js/product.js"></script>

<?php require_once 'includes/footer.php'; ?>