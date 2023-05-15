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
				$adminList = $admin->getAllAdminDeleted();
				while ($get = $adminList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maKH'] ?></td>
						<td><?php echo $get['hovaten'] ?></td>
						<td><?php echo $get['email'] ?></td>
						<td><?php echo $get['sdt'] ?></td>
						<td><?php echo $get['quyen'] ?></td>
						<td class="d-flex" style="font-size: 18px">
							<a class="btn btn-primary" href="index.php?action=admin-page&act=findAdminDeleted&get=submit&id=<?= $get['maKH'] ?>">Kích hoạt lại</a>
							<a class="btn btn-danger" href="index.php?action=admin-page&act=findAdminDeleted&get=delete&id=<?= $get['maKH'] ?>">Tạm biệt</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>