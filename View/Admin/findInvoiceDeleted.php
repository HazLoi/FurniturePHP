<div class="container-fluid">
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
				$invoiceList = $admin->getAllInvoiceDeleted();
				while ($get = $invoiceList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maHD'] ?></td>
						<td><?php echo $get['maKH'] ?></td>
						<td><?php echo $get['hovaten'] ?></td>
						<td><?php $date = new DateTime($get['ngay']);
								$dateFix = $date->format('d/m/Y');
								echo $dateFix;  ?></td>
						<td><?php echo $get['tongtien'] ?></td>
						<td>
							<?php if ($get['tinhtrang'] == 0) { ?>
								<span class="btn btn-danger"><?php echo "Chưa thanh toán" ?></span>
							<?php } else { ?>
								<span class="btn btn-primary"><?php echo "Đã thanh toán" ?></span>
							<?php } ?>
						</td>
						<td style="font-size: 18px">
							<a class="btn btn-primary" href="index.php?action=admin-page&act=findInvoiceDeleted&get=submit&id=<?= $get['maHD'] ?>">Kích hoạt lại</a>
							<a class="btn btn-danger" href="index.php?action=admin-page&act=findInvoiceDeleted&get=delete&id=<?= $get['maHD'] ?>">Tạm biệt</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>