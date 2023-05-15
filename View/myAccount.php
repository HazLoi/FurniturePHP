<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/4.jpg)">
	<div class="auto-container">
		<h2>Tài khoản của bạn</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Tài khoản của bạn</li>
		</ul>
	</div>
</section>
<!--End Page Title-->


<div class="container my-5">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-12 border-right my-5">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

				<form action="index.php?action=myAccount&get=updateImageAccount" method="post" class="mb-2" enctype="multipart/form-data">
					<div class="d-flex mb-2 justify-content-center">
						<div class="position-relative">
							<input id="image-upload" name="imageAccount" class="d-none" type="file" onchange="previewImage(event)">
							<img src="assets/images/imageAccount/<?= $_SESSION['image'] != '' ? $_SESSION['image'] : 'user.png' ?>" id="preview" style="width: 60px; height: 60px; border-radius: 50px; background: rgb(206, 196, 196)">
							<div class="position-absolute" style="right: 0; top: 45px">
								<label for="image-upload" style="display: inline-block"><i class="fa fa-camera" style="font-size: 18px"></i></label>
							</div>
						</div>
					</div>
					<div class="row">
						<button class="btn btn-success col-lg-6 col-md-6 col-sm-6" id="btnUpdateImageAccount" style="display: none">Xác nhận</button>
						<button type="button" onclick="exitBtn()" class="btn btn-light col-lg-6 col-md-6 col-sm-6" id="btnExitUpdateImageAccount" style="display: none">Hủy</button>
					</div>
				</form>

				<h3 class="m-auto"><?php echo	 $fullname ?></h3>

				<?php if ($_SESSION['role'] == 1) { ?>
					<div>
						<input class="form-control" type="text" name="phone" value="0987813589 (totoday.vn)" disabled>
						<input class="form-control" type="text" name="phone" value="123456 (totoday.vn)" disabled>
					</div>
				<?php } ?>

				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link <?php if (!empty($_GET['get']) && $_GET['get'] == 'saveInfo') echo 'active text-success border-success' ?> " id="v-pills-infoAccount-tab" data-toggle="pill" data-target="#v-pills-infoAccount" type="button" role="tab" aria-controls="v-pills-infoAccount" aria-selected="true"><i class="fa fa-user">
					</i> Thông tin tài khoản</a>
				</button>

				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link <?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo 'active text-success border-success' ?>" id="v-pills-changePass-tab" data-toggle="pill" data-target="#v-pills-changePass" type="button" role="tab" aria-controls="v-pills-changePass" aria-selected="false"><i class="fa fa-unlock">
					</i> Thay đổi mật khẩu
				</button>

				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link" id="v-pills-invoices-tab" data-toggle="pill" data-target="#v-pills-invoices" type="button" role="tab" aria-controls="v-pills-invoices" aria-selected="false"><i class="fa fa-file-invoice">
					</i> Đơn hàng của tôi
				</button>

				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link <?php if (!empty($_GET['get']) && $_GET['get'] == 'wishlist') echo 'active text-success border-success' ?>" id="v-pills-wishlist-tab" data-toggle="pill" data-target="#v-pills-wishlist" type="button" role="tab" aria-controls="v-pills-wishlist" aria-selected="false"><i class="fa fa-heart">
					</i> Danh sách yêu thích
				</button>
			</div>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-12 my-5">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade <?php if (empty($_GET['get']) || !empty($_GET['get']) && $_GET['get'] == 'saveInfo') echo 'show active' ?>" id="v-pills-infoAccount" role="tabpanel" aria-labelledby="v-pills-infoAccount-tab">
					<h1>Thông tin tài khoản</h1>
					<form class="mt-5" action="index.php?action=myAccount&get=saveInfo" method="post">
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Họ và tên <sup class="text-danger">*</sup></label>
								<input class="form-control" type="text" name="fullname" value="<?php echo $fullname ?>" placeholder="Họ và tên">
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "saveInfo") echo $_SESSION['fullnameErrorSaveInfoAccount']; ?></span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Ngày sinh <sup class="text-danger">*</sup></label>
								<input class="form-control" type="date" name="date" value="<?php echo $date ?>">
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "saveInfo") echo $_SESSION['dateErrorSaveInfoAccount']; ?></span>
							</div>
						</div>
						<div class="form-group row my-4">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Số điện thoại <sup class="text-danger">*</sup></label><br>
								<input class="form-control" type="text" name="phone" value="<?php echo $phone ?>">
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "saveInfo") echo $_SESSION['phoneErrorSaveInfoAccount']; ?></span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Email <sup class="text-danger">*</sup></label><br>
								<input class="form-control" type="text" name="email" value="<?php echo $email ?>">
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "saveInfo") echo $_SESSION['emailErrorSaveInfoAccount']; ?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="h5">Giới tính</label><br>
							<span style="font-size: 18px" class="ml-2">
								<input <?php if ($gender == 'Nữ') echo 'checked' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Nữ"> Nữ</span>
							<span style="font-size: 18px" class="mx-3">
								<input <?php if ($gender == 'Nam') echo 'checked' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Nam"> Nam</span>
							<span style="font-size: 18px">
								<input <?php if ($gender == 'Khác') echo 'checked' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Khác"> Khác</span>
						</div>
						<div class="form-group row">
							<div class="col-lg-10 col-md-10 col-sm-12">
								<label for="" class="h5">Địa chỉ <sup class="text-danger">*</sup></label>
								<input class="form-control" type="text" name="address" value="<?php echo $address ?>" placeholder="Địa chỉ của bạn">
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "saveInfo") echo $_SESSION['addressErrorSaveInfoAccount']; ?></span>
							</div>
							<div class="col-lg-2 col-md-10 col-sm-12">
								<label for="" class="h5">Zip <sup class="text-danger">*</sup></label>
								<input class="form-control" type="text" maxlength="6" name="zip" value="<?php echo $zip ?>" placeholder="Mã Zip">
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "saveInfo") echo $_SESSION['zipErrorSaveInfoAccount']; ?></span>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success">Cập nhật thông tin</button>
						</div>
					</form>
				</div>
				<div class="tab-pane fade <?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo 'show active' ?>" id="v-pills-changePass" role="tabpanel" aria-labelledby="v-pills-changePass-tab">
					<div class="row">
						<h1 class="m-auto">Thay đổi mật khẩu</h1>
					</div>
					<form class="mt-5" action="index.php?action=myAccount&get=changePass" method="post">
						<div class="form-group row">
							<div class="col-6 m-auto">
								<label for="" class="h5">Mật khẩu cũ</label>
								<input class="form-control" type="password" name="password" id="passwordOld" value="<?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo $_POST['password'] ?>" placeholder="Nhập mật khẩu cũ">
								<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassOld()">
									<span id="showPassOld">Hiện mật khẩu</span>
								</button><br>
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "changePass") echo $_SESSION['passwordErrorChangePassword']; ?></span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-6 m-auto">
								<label for="" class="h5">Mật khẩu mới</label>
								<input class="form-control" type="password" name="passwordNew" id="passwordNew" value="<?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo $_POST['passwordNew'] ?>" placeholder="Nhập mật khẩu mới">
								<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassNew()">
									<span id="showPassNew">Hiện mật khẩu</span>
								</button><br>
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "changePass") echo $_SESSION['passwordNewErrorChangePassword']; ?></span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-6 m-auto">
								<label for="" class="h5">Nhập lại mật khẩu mới</label>
								<input class="form-control" type="password" name="passwordRenew" id="passwordRenew" value="<?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo $_POST['passwordRenew'] ?>" placeholder="Nhập lại mật khẩu">
								<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassRenew()">
									<span id="showPassRenew">Hiện mật khẩu</span>
								</button><br>
								<span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "changePass") echo $_SESSION['passwordRenewErrorChangePassword']; ?></span>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-6 m-auto">
								<button class="btn btn-success">Thay đổi mật khẩu</button>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="v-pills-invoices" role="tabpanel" aria-labelledby="v-pills-invoices-tab">
					<div class="row" style="overflow-y: auto; height: 500px">
						<table class="table table-striped" style="font-size: 18px">
							<tr>
								<td>Mã hóa đơn</td>
								<td>Ngày</td>
								<td>Tổng tiền</td>
								<td>Tình trạng</td>
								<td></td>
							</tr>
							<?php
							$user = new user();
							$result = $user->getInvoiceByCustomerId($_SESSION['idCustomer']);
							while ($get = $result->fetch()) {
							?>
								<tr>
									<th><?php echo $get['maHD'] ?></th>
									<th><?php $date = new DateTime($get['ngay']);
											$dateFix = $date->format('d/m/Y');
											echo $dateFix ?></th>
									<th>$<?php echo $get['tongtien'] ?></th>
									<th><?php echo $get['tinhtrang'] ?></th>
									<th>
										<a href="index.php?action=invoiceDetail&id=<?= $get['maHD'] ?>" class="btn btn-info">Xem</a>
									</th>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
				<div class="tab-pane fade <?php if (!empty($_GET['get']) && $_GET['get'] == 'wishlist') echo 'show active' ?>" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab" style="overflow-y: auto; height: 600px">
					<table class="table table-striped" style="font-size: 18px">
						<tr>
							<td>Tên sản phẩm</td>
							<td>Ảnh</td>
							<td>Trạng thái</td>
							<td>Đơn giá</td>
							<td></td>
						</tr>
						<?php
						$user = new user();
						$result = $user->getWishlist($_SESSION['idCustomer']);
						while ($get = $result->fetch()) {
						?>
							<tr>
								<th><?php echo $get['ten'] ?></th>
								<th>
									<a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>">
										<img style="height: 150px; width: 100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt="" />
									</a>
								</th>
								<th><?php echo ($get['tonkho'] > 0) ? '<b class="text-success">Còn hàng<b>' : '<b class="text-danger">Hết hàng<b>' ?></th>
								<th>$<?php echo $get['dongia'] ?></th>
								<th>
									<a href="index.php?action=myAccount&get=deleteWishlist&id=<?= $get['maYT'] ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
								</th>
							</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// Lấy tất cả các button
	const buttons = document.querySelectorAll(".tabsBtn");

	// Lặp qua từng button và thêm sự kiện click
	buttons.forEach((button) => {
		button.addEventListener("click", function() {
			// Xóa class "text-success" 'border-success' từ tất cả các button
			buttons.forEach((button) => {
				button.classList.remove('text-success', 'border-success');
			});
			// Thêm class "text-success" 'border-success' vào button được click
			this.classList.add("text-success", 'border-success');
		});
	});
</script>