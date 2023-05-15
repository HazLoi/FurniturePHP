<div class="container-fluid">
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
				$customerList = $admin->getAllCustomerDeleted();
				while ($get = $customerList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maKH'] ?></td>
						<td><?php echo $get['hovaten'] ?></td>
						<td><?php echo $get['email'] ?></td>
						<td><?php echo $get['sdt'] ?></td>
						<td><?php echo $get['quyen'] ?></td>
						<td style="font-size: 18px">
							<a class="btn btn-primary" href="index.php?action=admin-page&act=findCustomerDeleted&get=submit&id=<?= $get['maKH'] ?>">Kích hoạt lại</a>
							<a class="btn btn-danger" href="index.php?action=admin-page&act=findCustomerDeleted&get=delete&id=<?= $get['maKH'] ?>">Tạm biệt</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>