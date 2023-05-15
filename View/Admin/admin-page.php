<?php
if (isset($_SESSION['role']) == 1){
	include 'thongkedoanhthu.php';
}
?>
<hr class="sidebar-divider d-none d-md-block">
<div class="container-fluid">
	<!-- Danh mục -->
	<div class="row">
		<?php if ($_SESSION['role'] == 1) { ?>
			<div class="col-lg-3 col-md-3 col-sm-12 text-white mb-2">
				<div class="" style="position: relative; border-radius: 10px; background: rgb(27, 131, 216);">
					<i class="fa-solid fa-user-tie text-dark m-2" style="position: absolute; right: 0; font-size: 70px"></i>
					<h1 class="ml-2">
						<?php
						$admin = new admin();
						$allAdmin = $admin->getAllAdmin();
						$countAdmin = $allAdmin->rowCount();
						echo $countAdmin;
						?></h1>
					<h2 class="ml-2">Admin</h2>
					<div class="">
						<a href="index.php?action=admin-page&act=adminList" class="w-100 btn text-white" style="border-radius: 0px 0px 10px 10px; background: rgb(0, 108, 209);">Xem chi tiết <i class="fa-solid fa-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 text-white mb-2">
				<div class="" style="position: relative; border-radius: 10px; background: rgb(27, 131, 216);">
					<i class="fa-solid fa-id-card text-dark m-2" style="position: absolute; right: 0; font-size: 70px"></i>
					<h1 class="ml-2">
						<?php
						$admin = new admin();
						$allCustomer = $admin->getAllCustomer();
						$countCustomer = $allCustomer->rowCount();
						echo $countCustomer;
						?></h1>
					<h2 class="ml-2">Khách hàng</h2>
					<div class="">
						<a href="index.php?action=admin-page&act=customerList" class="w-100 btn text-white" style="border-radius: 0px 0px 10px 10px; background: rgb(0, 108, 209);">Xem chi tiết <i class="fa-solid fa-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="col-lg-3 col-md-3 col-sm-12 text-white mb-2">
			<div class="" style="position: relative; border-radius: 10px; background: rgb(27, 131, 216);">
				<i class="fa-solid fa-couch text-dark m-2" style="position: absolute; right: 0; font-size: 70px"></i>
				<h1 class="ml-2">
					<?php
					$admin = new admin();
					$allProduct = $admin->getAllProduct();
					$countProduct = $allProduct->rowCount();
					echo $countProduct;
					?></h1>
				<h2 class="ml-2">Sản phẩm</h2>
				<div class="">
					<a href="index.php?action=admin-page&act=productList" class="w-100 btn text-white" style="border-radius: 0px 0px 10px 10px; background: rgb(0, 108, 209);">Xem chi tiết <i class="fa-solid fa-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 text-white mb-2">
			<div class="" style="position: relative; border-radius: 10px; background: rgb(27, 131, 216);">
				<i class="fa-solid fa-newspaper text-dark m-2" style="position: absolute; right: 0; font-size: 70px"></i>
				<h1 class="ml-2">
					<?php
					$admin = new admin();
					$allCustomer = $admin->getAllNews();
					$countCustomer = $allCustomer->rowCount();
					echo $countCustomer;
					?></h1>
				<h2 class="ml-2">Tin tức</h2>
				<div class="">
					<a href="index.php?action=admin-page&act=newsList" class="w-100 btn text-white" style="border-radius: 0px 0px 10px 10px; background: rgb(0, 108, 209);">Xem chi tiết <i class="fa-solid fa-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 text-white mb-2">
			<div class="" style="position: relative; border-radius: 10px; background: rgb(27, 131, 216);">
				<i class="fa-solid fa-file-invoice-dollar text-dark m-2" style="position: absolute; right: 0; font-size: 70px"></i>
				<h1 class="ml-2">
					<?php
					$admin = new admin();
					$allInvoice = $admin->getAllInvoice();
					$countInvoice = $allInvoice->rowCount();
					echo $countInvoice;
					?></h1>
				<h2 class="ml-2">Hóa đơn</h2>
				<div class="">
					<a href="index.php?action=admin-page&act=invoiceList" class="w-100 btn text-white" style="border-radius: 0px 0px 10px 10px; background: rgb(0, 108, 209);">Xem chi tiết <i class="fa-solid fa-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>

		<?php if ($_SESSION['role'] == 1) { ?>
			<div class="col-lg-3 col-md-3 col-sm-12 text-white mb-2">
				<div class="" style="position: relative; border-radius: 10px; background: rgb(27, 131, 216);">
					<i class="fa-solid fa-envelope text-dark m-2" style="position: absolute; right: 0; font-size: 70px"></i>
					<h1 class="ml-2">
						<?php
						$admin = new admin();
						$allInvoice = $admin->getAllContact();
						$countInvoice = $allInvoice->rowCount();
						echo $countInvoice;
						?></h1>
					<h2 class="ml-2">Liên hệ</h2>
					<div class="">
						<a href="index.php?action=admin-page&act=contactList" class="w-100 btn text-white" style="border-radius: 0px 0px 10px 10px; background: rgb(0, 108, 209);">Xem chi tiết <i class="fa-solid fa-circle-arrow-right"></i></a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>