<div class="container-fluid">
	<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
	<a class="btn btn-success" href="index.php?action=admin-page&act=invoiceList&get=export">Xuất dữ liệu ra file excel</a>
	<?php } ?>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="row mt-3">
		<table class="table table-borderless">
			<thead>
				<tr>
					<th>Mã hóa đơn</th>
					<th>Mã khách hàng</th>
					<th>Tên khách hàng</th>
					<th>Ngày</th>
					<th>Tổng tiền</th>
					<th>Tình trạng</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				$invoiceList = $admin->getAllInvoice();
				while ($get = $invoiceList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maHD'] ?></td>
						<td><?php echo $get['maKH'] ?></td>
						<td><?php echo $get['hovaten'] ?></td>
						<td><?php $date = new DateTime($get['ngay']);
								$dateFix = $date->format('d/m/Y');
								echo $dateFix;  ?></td>
						<td>$<?php echo $get['tongtien'] ?></td>
						<td>
							<?php if ($get['tinhtrang'] == 0) { ?>
								<span class="btn btn-danger"><?php echo "Chưa thanh toán" ?></span>
							<?php } else { ?>
								<span class="btn btn-primary"><?php echo "Đã thanh toán" ?></span>
							<?php } ?>
						</td>
						<td style="font-size: 18px">
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalOrder<?php echo $get['maHD'] ?>"><i class="fa-solid fa-trash-can"></i></button>
							<?php } ?>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) { ?>
								<a href="index.php?action=admin-page&act=editInvoice&id=<?php echo $get['maHD'] ?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
							<?php } ?>
						</td>
					</tr>
					<!-- Modal delete tài khoản -->
					<div class="modal fade" id="modalOrder<?php echo $get['maHD'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Xóa hóa đơn</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div style="table-layout: fixed; width: 100%; text-align: center; font-size: 16px">
										<div class="row mt-3">
											<p class="col-lg-3 col-sm-3 col-md-3">Mã hóa đơn</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Tên khách hàng</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Ngày</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Tổng tiền</p>
										</div>
										<div class="row">
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['maHD'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['hovaten'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php $date = new DateTime($get['ngay']);
																								$dateFix = $date->format('d/m/Y');
																								echo $dateFix;  ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3">$<?php echo $get['tongtien'] ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=invoiceList&get=deleteInvoice" method="post">
										<input type="hidden" name="maHD" value="<?php echo $get['maHD'] ?>">
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