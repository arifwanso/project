<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">หน้าหลัก</a></li>		  
		  <li class="active">ประเภทสินค้า</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>ประเภทสินค้า</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addTypeModalBtn" data-target="#addTypeModal"> <i class="glyphicon glyphicon-plus-sign"></i> เพิ่มประเภทสินค้า </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageTypeTable">
					<thead>
						<tr>							
							<th>ชื่อประเภท</th>
							<th style="width:15%;">จัดการข้อมูล</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add categories -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitTypeForm" action="php_action/createType.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มประเภทสินค้า</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-type-messages"></div>

	        <div class="form-group">
	        	<label for="typeName" class="col-sm-4 control-label">ชื่อประเภท: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="typeName" placeholder="" name="typeName" autocomplete="off">
				    </div>	         	        
	        </div> <!-- /form-group-->	         	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>
	        
	        <button type="submit" class="btn btn-primary" id="createTypeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editTypeForm" action="php_action/editType.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขประเภท</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-type-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">กำลังโหลด...</span>
					</div>

		      <div class="edit-type-result">
		      	<div class="form-group">
		        	<label for="editTypeName" class="col-sm-4 control-label">ชื่อประเภท: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" id="editTypeName" placeholder="" name="editTypeName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editTypeFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>
	        
	        <button type="submit" class="btn btn-success" id="editTypeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeTypeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> ลบประเภทสินค้า</h4>
      </div>
      <div class="modal-body">
        <p>คุณต้องการที่จะลบประเภทสินค้านี้ออกหรือไม่ ?</p>
      </div>
      <div class="modal-footer removeTypeFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>
        <button type="button" class="btn btn-primary" id="removeTypeBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> บันทึกข้อมูล</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/types.js"></script>

<?php require_once 'includes/footer.php'; ?>