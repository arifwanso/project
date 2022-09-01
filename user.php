<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active">ผู้ใช้</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> ผู้ใช้ทั้งหมด</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addUserModalBtn" data-target="#addUserModal"> <i class="glyphicon glyphicon-plus-sign"></i> เพิ่ม User </button>
				</div> <!-- /div-action -->

				<table class="table" id="manageUserTable">
					<thead>
						<tr>
							<th style="width:25%;">UserID</th>
							<th style="width:25%;">email</th>
							<th style="width:25%">ตำแหน่ง</th>
							<th style="width:10%;">ตั้งค่า</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<form class="form-horizontal" id="submitUserForm" action="php_action/createUser.php" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มผู้ใช้</h4>
				</div>

				<div class="modal-body" style="max-height:450px; overflow:auto;">

					<div id="add-user-messages"></div>



					<div class="form-group">
						<label for="userName" class="col-sm-3 control-label">UserID: </label>

						<div class="col-sm-8">
							<input type="text" class="form-control" id="userName" placeholder="User Name" name="userName" autocomplete="off">
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="upassword" class="col-sm-3 control-label">Password: </label>

						<div class="col-sm-8">
							<input type="password" class="form-control" id="upassword" placeholder="Password" name="upassword" autocomplete="off">
						</div>
					</div> <!-- /form-group-->

					<div class="form-group">
						<label for="uemail" class="col-sm-3 control-label">Email: </label>

						<div class="col-sm-8">
							<input type="email" class="form-control" id="uemail" placeholder="Email" name="uemail" autocomplete="off">
						</div>
					</div> <!-- /form-group-->
					<div class="form-group">
						<label for="urole" class="col-sm-3 control-label">ตำแหน่ง: </label>

						<div class="col-sm-8">
							<select class="form-control" id="urole" name="urole">
								<option value="">--เลือก--</option>
								<option value="1">admin</option>
								<option value="2">staff</option>
							</select>
						</div>
					</div>
				</div> <!-- /form-group-->
				<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>

			<button type="submit" class="btn btn-primary" id="createUserBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> บันทึก</button>
		</div> <!-- /modal-footer -->
		</div> <!-- /modal-body -->

		

		</form> <!-- /.form -->
	</div> <!-- /modal-content -->
</div> <!-- /modal-dailog -->
</div>
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไข User</h4>
			</div>
			<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div class="div-loading">
					<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
				</div>

				<div class="div-result">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#userInfo" aria-controls="profile" role="tab" data-toggle="tab">User Info</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">



						<!-- product image -->
						<div role="tabpanel" class="tab-pane active" id="userInfo">
							<form class="form-horizontal" id="editUserForm" action="php_action/editUser.php" method="POST">
								<br />

								<div id="edit-user-messages"></div>

			
								<div class="form-group">
									<label for="editEmail" class="col-sm-3 control-label">Email: </label>

									<div class="col-sm-8">
										<input type="text" class="form-control" id="editEmail" placeholder="Email" name="editEmail" autocomplete="off">
									</div>
								</div> <!-- /form-group-->
								<div class="form-group">
									<label for="editRole" class="col-sm-3 control-label">ตำแหน่ง: </label>

									<div class="col-sm-8">
										<select class="form-control" id="editRole" name="editRole">
											<option value="">--เลือก--</option>
											<option value="1">admin</option>
											<option value="2">staff</option>
										</select>
									</div>
								</div>
						</div> <!-- /form-group-->




						<div class="modal-footer editUserFooter">
							<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ปิด</button>

							<button type="submit" class="btn btn-success" id="editUsersBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> บันทึก</button>
						</div> <!-- /modal-footer -->
						</form> <!-- /.form -->
					</div>
					<!-- /product info -->
				</div>

			</div>

		</div> <!-- /modal-body -->


	</div>
	<!-- /modal-content -->
</div>
<!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> ลบ User</h4>
			</div>
			<div class="modal-body">

				<div class="removeUserMessages"></div>

				<p>คุณต้องการที่จะลบออกหรือไม่ ?</p>
			</div>
			<div class="modal-footer removeProductFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/user.js"></script>

<?php require_once 'includes/footer.php'; ?>