<?php require_once 'includes/header.php'; ?>

<?php 

$sql = "SELECT * FROM product ";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM product where quantity != warning AND quantity > 0 ";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$countWarning = "SELECT * FROM product where quantity <= warning";
$WarningSql = $connect->query($countWarning);
$countWarnings = $WarningSql->num_rows;

$lowStockSql = "SELECT * FROM product WHERE  quantity = 0";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$connect->close();

?>


<div class="row">
	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">			
				<a href="product.php" style="text-decoration:none;color:black;">
					จำนวนสินค้าทั้งหมด
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
		<div class="col-md-3">
			<div class="panel panel-success">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Available
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->
		

		<div class="col-md-3">
			<div class="panel panel-warning">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Warning
					<span class="badge pull pull-right"><?php echo $countWarnings; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					No Available
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	
</div>


	

<?php require_once 'includes/footer.php'; ?>