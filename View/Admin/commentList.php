<?php
$ac = 0;
if (isset($_GET['get']) && $_GET['get'] == 'view') {
	if ($_GET['rate'] != 'all') {
		$ac = 1;
	}
	if ($_GET['rate'] == 'all') {
		$ac = 0;
	}
}
if(isset($_GET['id']) && intval($_GET['id'])){
?>
<div class="container-fluid">

	<div class="">
		<a href="index.php?action=admin-page&act=commentList&get=view&rate=all&id=<?php echo $_GET['id'] ?>" class="btn btn-info text-white">Tất cả</a>
		<a href="index.php?action=admin-page&act=commentList&get=view&rate=1&id=<?php echo $_GET['id'] ?>" class="btn btn-info text-white">1 <span class="fa fa-star"></span></a>
		<a href="index.php?action=admin-page&act=commentList&get=view&rate=2&id=<?php echo $_GET['id'] ?>" class="btn btn-info text-white">2 <span class="fa fa-star"></span></a>
		<a href="index.php?action=admin-page&act=commentList&get=view&rate=3&id=<?php echo $_GET['id'] ?>" class="btn btn-info text-white">3 <span class="fa fa-star"></span></a>
		<a href="index.php?action=admin-page&act=commentList&get=view&rate=4&id=<?php echo $_GET['id'] ?>" class="btn btn-info text-white">4 <span class="fa fa-star"></span></a>
		<a href="index.php?action=admin-page&act=commentList&get=view&rate=5&id=<?php echo $_GET['id'] ?>" class="btn btn-info text-white">5 <span class="fa fa-star"></span></a>
	</div>
	<div class="row mt-3">
		<table class="table">
			<thead>
				<tr>
					<th>Mã bình luận</th>
					<th>Tác giả</th>
					<th>Email</th>
					<th>Nội dung</th>
					<th>Ngày</th>
					<th>Đánh giá</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				if ($ac == 0) {
					$comments = $admin->getCommentByProductId($_GET['id']);
				} else if ($ac == 1) {
					$comments = $admin->getCommentByRating($_GET['rate'], $_GET['id']);
				}
				while ($get = $comments->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maBL'] ?></td>
						<td><?php echo $get['tacgia'] ?></td>
						<td><?php echo $get['email'] ?></td>
						<td><?php echo $get['binhluan'] ?></td>
						<td><?php $date = new DateTime('now');
								$dateFix = $date->format('d/m/Y');
								echo $dateFix ?></td>
						<td class="text-warning"><?php for ($i = 0; $i < $get['danhgia']; $i++) { ?>
								<span class="fa fa-star"></span>
							<?php  } ?>
						</td>
						<td style="font-size: 18px">
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalComment<?php echo $get['maBL'] ?>"><i class="fa-solid fa-trash-can"></i></button>
							<?php } ?>
						</td>
					</tr>
					<!-- Modal delete -->
					<div class="modal fade" id="modalComment<?php echo $get['maBL'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Xóa bình luận</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div style="table-layout: fixed; width: 100%; text-align: center; font-size: 16px">
										<div class="row mt-3">
											<p class="col-lg-3 col-sm-3 col-md-3">Mã bình luận</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Tác giả</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Nội dung</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Đánh giá</p>
										</div>
										<div class="row">
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['maBL'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['tacgia'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['binhluan'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['danhgia'] ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=commentList&get=deleteComment&id=<?= $_GET['id'] ?>" method="post">
										<input type="hidden" name="maBL" value="<?php echo $get['maBL'] ?>">
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
<?php } ?>

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