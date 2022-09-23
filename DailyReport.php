<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">รายงานประจำวัน</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>รายงานประจำวัน</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
            <div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-success" data-toggle="modal" id="generateReportBtn" data-target="#generateReportModal"> <i class="glyphicon glyphicon-ok-sign"></i> พิมพ์รายงาน </button>
				</div> <!-- /div-action -->
				<table class="table" id="manageReportTable">
					<thead>
						<tr>							
							<th>ชื่อประเภท</th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th>กำไรรวม</th>
						</tr>
					</thead>
                    <tfoot align="right">
		<tr><th></th><th></th><th></th><th></th><th></th></tr>
	</tfoot>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/Dailyreport.js"></script>

<?php require_once 'includes/footer.php'; ?>

