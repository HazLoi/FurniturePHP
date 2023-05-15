<?php
$ac = 0;
if (isset($_GET['get'])) {
	if ($_GET['get'] == 'category') {
		$ac = 1;
	}
	if ($_GET['get'] == 'searchByName') {
		$ac = 2;
	}
	if ($_GET['get'] == 'searchById') {
		$ac = 3;
	}
}
if (isset($_GET['category']) && $_GET['category'] == 'all') {
	$ac = 0;
}
?>
<div class="container-fluid">
	<a id="exportData" class="btn btn-success" href="index.php?action=admin-page&act=productList&get=export">Xuất dữ liệu ra file excel</a>

	<hr class="sidebar-divider d-none d-md-block">
	<div class="d-flex">
		<button class="btn btn-primary" id="searchName">Tìm theo tên</button>
		<button class="btn btn-primary mx-1" id="searchId">Tìm theo mã</button>
		<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) { ?>
			<form class="m-auto" action="index.php?action=admin-page&act=importProducts" method="post" enctype="multipart/form-data">
				<input class="" type="file" name="fileImport">
				<button class="btn btn-primary">Chèn dữ liệu</button>
			</form>
		<?php } ?>
	</div>

	<form class="d-none form-inline navbar-search my-2" id="f1" action="index.php?action=admin-page&act=productList&get=searchByName" method="post">
		<div class="input-group">
			<input name="search" type="text" class="form-control bg-light border-1 small" placeholder="Tìm kiếm tên sản phẩm" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<form class="d-none form-inline navbar-search my-2" id="f2" action="index.php?action=admin-page&act=productList&get=searchById" method="post">
		<div class="input-group">
			<input name="search" type="text" class="form-control bg-light border-1 small" placeholder="Tìm kiếm mã sản phẩm" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<hr class="sidebar-divider d-none d-md-block">

	<div class="">
		<a href="index.php?action=admin-page&act=productList&get=category&category=all" class="btn btn-info text-white">Tất cả</a>
		<?php
		$admin = new admin();
		$result = $admin->getAllCategory();

		while ($set = $result->fetch()) :
		?>
			<a href="index.php?action=admin-page&act=productList&get=category&category=<?php echo $set['tenloai'] ?>" class="btn btn-info text-white"><?php echo $set['tenloai'] ?></a>
		<?php endwhile; ?>
	</div>
	<div class="row mt-3">
		<table class="table">
			<thead>
				<tr>
					<th>Mã sản phẩm</th>
					<th style="width: 20%;">Ảnh sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Loại sản phẩm</th>
					<th>Đơn giá</th>
					<!-- <th>Màu sắc</th> -->
					<!-- <th>Kích thước</th> -->
					<th>Tồn kho</th>
					<th>Đã bán</th>
					<th>Đánh giá</th>
					<th>Yêu thích</th>
					<th>Bình luận</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($ac == 0) {
					$productList = $admin->getAllProduct();
				}
				if ($ac == 1) {
					$productList = $admin->getProductForCategory($_GET['category']);
				}
				if ($ac == 2) {
					if (!empty($_POST['search']) && $_POST['search'] != '') {
						$productList = $admin->getProductSearchByName(htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8'));
					} else {
						$productList = $admin->getAllProduct();
					}
				}
				if ($ac == 3) {
					if (!empty($_POST['search']) && $_POST['search'] != '') {
						$productList = $admin->getProductSearchById(htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8'));
					} else {
						$productList = $admin->getAllProduct();
					}
				}
				while ($get = $productList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maSP'] ?></td>
						<td><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></td>
						<td><?php echo $get['ten'] ?></td>
						<td><?php echo $get['tenloai'] ?></td>
						<td>$<?php echo $get['dongia'] ?></td>
						<!-- <td><?php echo $get['mausac'] ?></td> -->
						<!-- <td><?php echo $get['kichthuoc'] ?></td> -->
						<td><?php echo $get['tonkho'] ?></td>
						<td><?php echo $get['daban'] ?></td>
						<td><?php echo $get['danhgia'] ?></td>
						<td><?php echo $get['yeuthich'] ?></td>
						<td>
							<a href="index.php?action=admin-page&act=commentList&id=<?= $get['maSP'] ?>" class="btn btn-info">
								Có <?php $comment = new admin();
									$qtyCommentByProductId = $comment->getQtyCommentByProductId($get['maSP']);
									echo $qtyCommentByProductId['soluong'] ?>
							</a>
						</td>
						<td style="font-size: 18px" class="d-flex">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalViewProduct<?php echo $get['maSP'] ?>"><i class="fa-solid fa-eye"></i></button>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalProduct<?php echo $get['maSP'] ?>"><i class="fa-solid fa-trash-can"></i></button>
							<?php } ?>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) { ?>
								<a href="index.php?action=admin-page&act=editProduct&maSP=<?php echo $get['maSP'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
							<?php } ?>
						</td>
					</tr>
					<!-- Modal delete sản phẩm -->
					<div class="modal fade" id="modalProduct<?php echo $get['maSP'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div style="table-layout: fixed; width: 100%; text-align: center; font-size: 16px">
										<div class="row mt-3">
											<p class="col-lg-3 col-sm-3 col-md-3">Mã sản phẩm</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Ảnh sản phẩm</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Tên sản phẩm</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Loại sản phẩm</p>
										</div>
										<div class="row">
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['maSP'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><img width="100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['ten'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['tenloai'] ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=productList&get=deleteProduct" method="post">
										<input type="hidden" name="masp" value="<?php echo $get['maSP'] ?>">
										<button class="border-0 btn btn-danger" style=" margin-left: 10px">Chắc chắn</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- end modal-->
					<!-- Modal-->
					<div class="modal fade" id="modalViewProduct<?php echo $get['maSP'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Mô tả sản phẩm</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?= $get['mota'] ?>
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

<script>
	const searchName = document.getElementById('searchName');
	const searchId = document.getElementById('searchId');
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');

	searchName.addEventListener('click', () => {
		f1.classList.add('d-sm-inline-block');
		// xóa class hiện form => ẩn
		f2.classList.remove('d-sm-inline-block');
		//
		// searchName.classList.add('d-none');
		// searchId.classList.remove('d-none');
	})

	searchId.addEventListener('click', () => {
		f2.classList.add('d-sm-inline-block');
		// xóa class hiện form => ẩn
		f1.classList.remove('d-sm-inline-block');
		//
		// searchId.classList.add('d-none');
		// searchName.classList.remove('d-none');
	})
</script>