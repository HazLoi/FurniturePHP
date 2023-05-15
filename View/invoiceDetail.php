<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/4.jpg)">
	<div class="auto-container">
		<h2>Chi tiết hóa đơn</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Chi tiết hóa đơn</li>
		</ul>
	</div>
</section>
<!--End Page Title-->


<div class="container-fluid my-5">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12 border-right my-5" style="overflow-y: auto; height: 553px">
			<table class="table table-striped" style="font-size: 18px;">
				<thead>
					<tr>
						<th>Mã hóa đơn</th>
						<th>Ngày</th>
						<th>Tổng tiền</th>
						<th>Tình trạng</th>
						<th></th>
					</tr>
				</thead>
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
						<?php if ($get['tinhtrang'] == "Chưa thanh toán") { ?>
							<th class="text-danger">
								<?= $get['tinhtrang'] ?>
							</th>
						<?php } else { ?>
							<th class="text-success">
								<?= $get['tinhtrang'] ?>
							</th>
						<?php } ?>
						<th>
							<a href="index.php?action=invoiceDetail&id=<?= $get['maHD'] ?>" class="btn btn-info">Xem</a>
						</th>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 my-5">
			<table class="table table-striped" style="font-size: 18px">
				<tr>
					<td>Mã sản phẩm</td>
					<td>Ảnh</td>
					<td>Tên sản phẩm</td>
					<td>Số lượng</td>
					<td>Đơn giá</td>
					<td>Thành tiền</td>
				</tr>
				<?php
				$admin = new admin();
				$result = $admin->getProductInvoiceById($_GET['id']);
				while ($get = $result->fetch()) {
				?>
					<tr>
						<th><?= $get['maSP'] ?></th>
						<th><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></th>
						<th><?= $get['tenSP'] ?></th>
						<th><?= $get['soluongmua'] ?></th>
						<th>$<?= $get['dongia'] ?></th>
						<th>$<?= $get['thanhtien'] ?></th>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>