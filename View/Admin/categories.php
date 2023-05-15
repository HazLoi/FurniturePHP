<div class="container-fluid">
	<?php if (empty($_GET['get']) || $_GET['get'] == 'add') { ?>
		<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) { ?>
			<form class="col-lg-12 col-md-12 col-sm-12" action="index.php?action=admin-page&act=categories&get=add" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 m-auto">

						<div class="form-group">
							<label for="categoryName">Tên loại sản phẩm</label>
							<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == 'edit') {
																				echo $_POST['categoryName'];
																			} ?>" type="text" name="categoryName">
							<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == 'edit') echo $_SESSION['categoryNameErrorAddCategory']; ?></span>
						</div>

						<button class="btn btn-primary">Thêm loại sản phẩm</button>
					</div>
				</div>
			</form>
		<?php }
	} elseif ($_GET['get'] == 'edit') { ?>
		<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) { ?>
			<form class="col-lg-12 col-md-12 col-sm-12" action="index.php?action=admin-page&act=categories&get=edit&active=edit&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 m-auto">

						<div class="form-group">
							<label for="categoryName">Tên loại sản phẩm</label>
							<input class="form-control" value="<?php if (isset($_GET['active']) && $_GET['active'] == 'edit') {
																				echo $_POST['categoryName'];
																			} else {
																				echo $categoryName;
																			} ?>" type="text" name="categoryName">
							<span class="text-danger"><?php if (isset($_GET['active']) && $_GET['active'] == 'edit') echo $_SESSION['categoryNameErrorEditCategory']; ?></span>
						</div>

						<button class="btn btn-primary">Cập nhật</button>
					</div>
				</div>
			</form>
	<?php }
	} ?>
	<div class="row mt-3">
		<table class="table table-borderless">
			<thead>
				<tr>
					<th>Mã loại</th>
					<th>Tên loại</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				$categoryList = $admin->getAllCategory();
				while ($get = $categoryList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maLoai'] ?></td>
						<td><?php echo $get['tenloai'] ?></td>
						<td style="font-size: 18px">
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCategory<?php echo $get['maLoai'] ?>"><i class="fa-solid fa-trash-can"></i></button>
							<?php } ?>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) { ?>
								<a href="index.php?action=admin-page&act=categories&get=edit&id=<?= $get['maLoai'] ?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
							<?php } ?>
						</td>
					</tr>
					<!-- Modal delete tài khoản -->
					<div class="modal fade" id="modalCategory<?php echo $get['maLoai'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Xóa loại sản phẩm</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div style="table-layout: fixed; width: 100%; text-align: center; font-size: 16px">
										<div class="row mt-3">
											<p class="col-lg-6 col-sm-6 col-md-6">Mã loại</p>
											<p class="col-lg-6 col-sm-6 col-md-6">Tên loại</p>
										</div>
										<div class="row">
											<p class="col-lg-6 col-sm-6 col-md-6"><?php echo $get['maLoai'] ?></p>
											<p class="col-lg-6 col-sm-6 col-md-6"><?php echo $get['tenloai'] ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=categories&get=deleteCategory" method="post">
										<input type="hidden" name="maLoai" value="<?php echo $get['maLoai'] ?>">
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