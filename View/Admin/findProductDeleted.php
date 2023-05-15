<div class="container-fluid">
	<div class="row mt-3">
		<table class="table">
			<thead>
				<tr>
					<th>Mã sản phẩm</th>
					<th>Ảnh sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Loại sản phẩm</th>
					<th>Đơn giá</th>
					<th>Mô tả ngắn</th>
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
				$admin = new admin();
				$productList = $admin->getAllProductDeleted();
				while ($get = $productList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maSP'] ?></td>
						<td><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="100%" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></td>
						<td><?php echo $get['ten'] ?></td>
						<td><?php echo $get['tenloai'] ?></td>
						<td><?php echo $get['dongia'] ?></td>
						<td><?php echo $get['motangan'] ?></td>
						<!-- <td><?php echo $get['mausac'] ?></td> -->
						<!-- <td><?php echo $get['kichthuoc'] ?></td> -->
						<td><?php echo $get['tonkho'] ?></td>
						<td><?php echo $get['daban'] ?></td>
						<td><?php echo $get['danhgia'] ?></td>
						<td><?php echo $get['yeuthich'] ?></td>
						<td>
							<?php $comment = new admin();
							$qtyCommentByProductId = $comment->getQtyCommentByProductId($get['maSP']);
							echo $qtyCommentByProductId['soluong']
							?>
						</td>
						<td class="d-flex" style="font-size: 18px">
							<a class="btn btn-primary" href="index.php?action=admin-page&act=findProductDeleted&get=submit&id=<?= $get['maSP'] ?>">Kích hoạt lại</a>
							<a class="btn btn-danger" href="index.php?action=admin-page&act=findProductDeleted&get=delete&id=<?= $get['maSP'] ?>">Tạm biệt</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>