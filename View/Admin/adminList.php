<div class="container-fluid">
	<?php if ($_SESSION['role'] == 1) { ?>
	<a class="btn btn-success" href="index.php?action=admin-page&act=adminList&get=export">Xuất dữ liệu ra file excel</a>
	<?php } ?>
	<hr class="sidebar-divider d-none d-md-block">
	<form class="m-auto" action="index.php?action=admin-page&act=importAdmin" method="post" enctype="multipart/form-data">
		<input class="" type="file" name="fileImport">
		<button class="btn btn-primary">Thêm tài khoản</button>
	</form>
	<div class="row mt-3">
		<table class="table table-borderless">
			<thead>
				<tr>
					<th>Mã tài khoản</th>
					<th>Tên người dùng</th>
					<th>Email</th>
					<th>Số điện thoại</th>
					<th>Quyền</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				$adminList = $admin->getAllAdmin();
				while ($get = $adminList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maKH'] ?></td>
						<td><?php echo $get['hovaten'] ?></td>
						<td><?php echo $get['email'] ?></td>
						<td><?php echo $get['sdt'] ?></td>
						<td><?php echo $get['quyen'] ?></td>
						<td style="font-size: 18px">

							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalAdmin<?php echo $get['maKH'] ?>"><i class="fa-solid fa-trash-can"></i></button>
							<?php } ?>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) { ?>
								<a href="index.php?action=admin-page&act=editAdmin&maKH=<?php echo $get['maKH'] ?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
							<?php } ?>
						</td>
					</tr>
					<!-- Modal delete tài khoản -->
					<div class="modal fade" id="modalAdmin<?php echo $get['maKH'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Xóa tài khoản</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div style="table-layout: fixed; width: 100%; text-align: center; font-size: 16px">
										<div class="row mt-3">
											<p class="col-lg-3 col-sm-3 col-md-3">Mã tài khoản</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Tên người dùng</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Email</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Số điện thoại</p>
										</div>
										<div class="row">
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['maKH'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['hovaten'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['email'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['sdt'] ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=adminList&get=deleteAdmin" method="post">
										<input type="hidden" name="maKH" value="<?php echo $get['maKH'] ?>">
										<button class="border-0 btn btn-danger" style=" margin-left: 10px">Chắc chắn</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- end modal-->
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>