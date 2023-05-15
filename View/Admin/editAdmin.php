<form action="index.php?action=admin-page&act=editAdmin&get=edit&maKH=<?php echo $_GET['maKH'] ?>" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 m-auto">

			<div class="row">
				<div class="form-group col-lg-6">
					<label for="fname">Họ người dùng</label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																		echo $_POST['fname'];
																	} else {
																		echo $fname;
																	} ?>" type="text" name="fname">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['fnameErrorAdminEditCustomer']; ?></span>
				</div>

				<div class="form-group col-lg-6">
					<label for="lname">Tên người dùng</label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																		echo $_POST['lname'];
																	} else {
																		echo $lname;
																	} ?>" type="text" name="lname">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['lnameErrorAdminEditCustomer']; ?></span>
				</div>
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['email'];
																} else {
																	echo $emailBefore;
																} ?>" type="text" value="0" name="email">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['emailErrorAdminEditCustomer']; ?></span>
			</div>

			<div class="form-group">
				<label for="phone">Số điện thoại</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['phone'];
																} else {
																	echo $phone;
																} ?>" type="text" value="0" name="phone">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['phoneErrorAdminEditCustomer']; ?></span>
			</div>

			<div class="form-group">
				<label for="password">Mật khẩu</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['password'];
																} ?>" type="password" value="0" name="password" id="passwordEdit">
				<button class="border-0" style="background: none;" type="button" onclick="showPassEdit()">
					<span id="showPassEdit">Hiện mật khẩu</span>
				</button>
			</div>

			<div class="form-group">
				<label for="role">Phân quyền</label>
				<select class="form-control" name="role">
					<option value="<?php echo $roleId ?>">
						<?php echo $roleName ?>
					</option>
					<?php
					$admin = new admin();
					$result = $admin->getAllRole();
					while ($get = $result->fetch()) {
					?>
						<option value="<?php echo $get['maQuyen'] ?>"><?php echo $get['quyen'] ?></option>
					<?php } ?>
				</select>
			</div>

			<button class="btn btn-primary">Cập nhật tài khoản</button>
		</div>
	</div>
</form>