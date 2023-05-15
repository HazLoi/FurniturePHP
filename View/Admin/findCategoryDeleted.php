<div class="container-fluid">
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
				$categoryList = $admin->getAllCategoryDeleted();
				while ($get = $categoryList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maLoai'] ?></td>
						<td><?php echo $get['tenloai'] ?></td>
						<td style="font-size: 18px">
							<a class="btn btn-primary" href="index.php?action=admin-page&act=findCategoryDeleted&get=submit&id=<?= $get['maLoai'] ?>">Kích hoạt lại</a>
							<a class="btn btn-danger" href="index.php?action=admin-page&act=findCategoryDeleted&get=delete&id=<?= $get['maLoai'] ?>">Tạm biệt</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>