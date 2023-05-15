<div class="container-fluid">
	<div class="row mt-3">
		<table class="table table-borderless" style="font-size: 18px">
			<thead>
				<tr>
					<th>Hóa đơn:<br> <?php echo $maHD ?></th>
					<th>Tổng tiền:<br> $<?php echo $tongtien ?></th>
					<th>Ngày:<br> <?php
										$date = new DateTime($ngay);
										$dateFix = $date->format('d/m/Y');
										echo $dateFix;   ?>
					</th>
					<th>Tên khách hàng: <?php echo $hovaten ?></th>
					<th>Số điện thoại: <?php echo $sdt ?></th>
					<th>Email: <?php echo $email ?></th>
					<th>
						<?php if ($tinhtrang == 0) { ?>
							<span class="btn btn-danger"><?php echo "Chưa thanh toán" ?></span>
						<?php } else { ?>
							<span class="btn btn-primary"><?php echo "Đã thanh toán" ?></span>
						<?php } ?>
					</th>
				</tr>
				<tr>
					<th>Mã sản phẩm</th>
					<th>Ảnh</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng mua</th>
					<th>Đơn giá</th>
					<th>Thành tiền</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				$invoiceDetails = $admin->getProductInvoiceById($maHD);
				while ($get = $invoiceDetails->fetch()) {
				?>
					<form action="index.php?action=admin-page&act=editInvoice&get=edit&id=<?php echo $maHD ?>" method="post">
						<tr>
							<td>
								<?php echo $get['maSP'] ?>
								<input type="hidden" name="maSP" value="<?php echo $get['maSP'] ?>">
							</td>
							<td><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></td>
							<td><?php echo $get['tenSP'] ?></td>
							<td><input class="form-control" type="number" name="soluong" id="qty" onblur="checkQty()" value="<?php echo $get['soluongmua'] ?>"></td>
							<td>
								<input type="hidden" name="dongia" value="<?php echo $get['dongia'] ?>">
								$<?php echo $get['dongia'] ?>
							</td>
							<td>$<?php echo $get['thanhtien'] ?></td>
							<td style="font-size: 18px">
								<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalProductInvoice<?php echo $get['maSP'] ?>"><i class="fa-solid fa-trash-can"></i></a>
								<button class="btn btn-primary"><i class="fa-solid fa-rotate"></i></button>
							</td>
						</tr>
					</form>
					<!-- Modal delete tài khoản -->
					<div class="modal fade" id="modalProductInvoice<?php echo $get['maSP'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<p class="col-lg-2 col-sm-2 col-md-2">Mã sản phẩm</p>
											<p class="col-lg-2 col-sm-2 col-md-2">Ảnh</p>
											<p class="col-lg-2 col-sm-2 col-md-2">Tên sản phẩm</p>
											<p class="col-lg-2 col-sm-2 col-md-2">Số lượng mua</p>
											<p class="col-lg-2 col-sm-2 col-md-2">Đơn giá</p>
											<p class="col-lg-2 col-sm-2 col-md-2">Thành tiền</p>
										</div>
										<div class="row">
											<p class="col-lg-2 col-sm-2 col-md-2"><?php echo $get['maSP'] ?></p>
											<p class="col-lg-2 col-sm-2 col-md-2"><img width="100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></p>
											<p class="col-lg-2 col-sm-2 col-md-2"><?php echo $get['tenSP'] ?></p>
											<p class="col-lg-2 col-sm-2 col-md-2"><?php echo $get['soluongmua'] ?></p>
											<p class="col-lg-2 col-sm-2 col-md-2"><?php echo $get['dongia'] ?></p>
											<p class="col-lg-2 col-sm-2 col-md-2"><?php echo $get['thanhtien'] ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=editInvoice&get=delete&id=<?php echo $maHD ?>" method="post">
										<input type="hidden" name="maSP" value="<?php echo $get['maSP'] ?>">
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

<script>
	var qty = document.getElementById('qty');

	function checkQty() {
		if (qty.value < 0) {
			qty.value = 1;
		}
		if (qty.value > 100) {
			qty.value = 100;
		}
	}
</script>