<?php
$ac = 0;
if (isset($_GET['get'])) {
	if ($_GET['get'] == 'tt') {
		$ac = 1;
	}
}
if (isset($_GET['tt']) && $_GET['tt'] == 'all') {
	$ac = 0;
}
?>
<div class="container-fluid">

	<div class="">
		<a href="index.php?action=admin-page&act=newsList&get=tt&tt=all" class="btn btn-info text-white">Tất cả</a>
		<a href="index.php?action=admin-page&act=newsList&get=tt&tt=1" class="btn btn-info text-white">Tin tức hiện</a>
		<a href="index.php?action=admin-page&act=newsList&get=tt&tt=0" class="btn btn-info text-white">Tin tức ẩn</a>
	</div>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="row mt-3">
		<table class="table table-borderless">
			<thead>
				<tr>
					<th>Mã tin tức</th>
					<th>Tiêu đề</th>
					<th>Ảnh</th>
					<th>Ngày</th>
					<th>Nội dung</th>
					<th>Tình trạng</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				if ($ac == 0) {
					$newsList = $admin->getAllNews();
				} elseif ($ac == 1) {
					$newsList = $admin->getNewsByTT($_GET['tt']);
				}
				while ($get = $newsList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maTT'] ?></td>
						<td><?php echo $get['tenTT'] ?></td>
						<td style="width: 100px"><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><img width="100%" src="assets/images/resource/<?php echo $get['anh'] ?>" alt=""></a></td>
						<td><?php
								$date = new DateTime($get['ngay']);
								$dateFix = $date->format('d/m/Y');
								echo $dateFix;
								?></td>
						<td style="width: 40%;"><?php echo $get['noidung'] ?></td>
						<?php
						if ($get['tinhtrang'] == 0) {
						?>
							<td class="text-danger" style="font-size: 18px">Ẩn</td>
						<?php } else { ?>
							<td class="text-success" style="font-size: 18px">Hiện</td>
						<?php } ?>
						<td style="font-size: 18px">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalViewNews<?php echo $get['maTT'] ?>"><i class="fa-solid fa-eye"></i></button>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalNews<?php echo $get['maTT'] ?>"><i class="fa-solid fa-trash-can"></i></button>
							<?php } ?>
							<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) { ?>
								<a href="index.php?action=admin-page&act=editNews&maTT=<?php echo $get['maTT'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
							<?php } ?>
						</td>
					</tr>
					<!-- Modal delete tin tức -->
					<div class="modal fade" id="modalNews<?php echo $get['maTT'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<p class="col-lg-3 col-sm-3 col-md-3">Mã tin tức</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Tiêu đề</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Ảnh</p>
											<p class="col-lg-3 col-sm-3 col-md-3">Ngày</p>
										</div>
										<div class="row">
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['maTT'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['tenTT'] ?></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><img width="100%" src="assets/images/resource/<?php echo $get['anh'] ?>" alt=""></p>
											<p class="col-lg-3 col-sm-3 col-md-3"><?php $date = new DateTime($get['ngay']);
																								$dateFix = $date->format('d/m/Y');
																								echo $dateFix; ?></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
									<form action="index.php?action=admin-page&act=newsList&get=deleteNews" method="post">
										<input type="hidden" name="maTT" value="<?php echo $get['maTT'] ?>">
										<button class="border-0 btn btn-danger" style=" margin-left: 10px">Chắc chắn</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- end modal-->
					<!-- Modal delete tài khoản -->
					<div class="modal fade" id="modalViewNews<?php echo $get['maTT'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Chi tiết tin tức</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php echo $get['chitiet'] ?>
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