<?php
$ac = 0;
if (isset($_GET['get'])) {
	if ($_GET['get'] == 'email') {
		$ac = 1;
	}
	if ($_GET['get'] == 'all') {
		$ac = 0;
	}
	if ($_GET['get'] == 'searchBySubject') {
		$ac = 2;
	}
}
?>
<div class="container-fluid">

	<form class="form-inline navbar-search my-2" id="f1" action="index.php?action=admin-page&act=contactList&get=searchBySubject" method="post">
		<div class="input-group">
			<input name="search" type="text" class="form-control bg-light border-1 small" placeholder="Tìm kiếm tên chủ đề" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-lg-2 col-md-12 col-sm-12">
			<a href="index.php?action=admin-page&act=contactList&get=all" class=" w-75 btn btn-info text-white" style="border-radius: 0px 50px 50px 0px">All</a>
			<?php
			$admin = new admin();
			$result = $admin->getEmailSendContact();
			while ($get = $result->fetch()) :
			?>
				<a href="index.php?action=admin-page&act=contactList&get=email&email=<?= $get['email'] ?>" class="my-1 w-75 btn btn-info text-white" style="border-radius: 0px 50px 50px 0px"><?= $get['email'] ?></a>
			<?php endwhile; ?>
		</div>
		<hr class="sidebar-divider d-none d-md-block">
		<div class="col-lg-10 col-md-12 col-sm-12">
			<table class="table table-borderless">
				<thead>
					<tr>
						<th>Mã liên hệ</th>
						<th>Người gửi</th>
						<th>Email</th>
						<th>Chủ đề</th>
						<th>Nội dung</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$admin = new admin();
					if ($ac == 0) {
						$newsList = $admin->getAllContact();
					} elseif ($ac == 1) {
						$newsList = $admin->getContactByEmail($_GET['email']);
					} elseif ($ac == 2) {
						if (!empty($_POST['search']) && $_POST['search'] != '') {
							$newsList = $admin->getContactBySubject(htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8'));
						} else {
							$newsList = $admin->getAllContact();
						}
					}
					while ($get = $newsList->fetch()) {
					?>
						<tr>
							<td><?php echo $get['maLH'] ?></td>
							<td><?php echo $get['tacgia'] ?></td>
							<td><?php echo $get['email'] ?></td>
							<td><?php echo $get['chude'] ?></td>
							<td><?php echo $get['noidung'] ?></td>
							<td style="font-size: 18px">
								<?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 5) { ?>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalContact<?php echo $get['maLH'] ?>"><i class="fa-solid fa-trash-can"></i></button>
								<?php } ?>
							</td>
						</tr>
						<!-- Modal delete tài khoản -->
						<div class="modal fade" id="modalContact<?php echo $get['maLH'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
												<p class="col-lg-3 col-sm-3 col-md-3">Mã liên hệ</p>
												<p class="col-lg-3 col-sm-3 col-md-3">Người gửi</p>
												<p class="col-lg-3 col-sm-3 col-md-3">Email</p>
												<p class="col-lg-3 col-sm-3 col-md-3">Chủ đề</p>
											</div>
											<div class="row">
												<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['maLH'] ?></p>
												<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['tacgia'] ?></p>
												<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['email'] ?></p>
												<p class="col-lg-3 col-sm-3 col-md-3"><?php echo $get['chude'] ?></p>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<!-- <button type="button" class="border-0 btn btn-secondary" data-dismiss="modal">Close</button> -->
										<form action="index.php?action=admin-page&act=contactList&get=deleteContact" method="post">
											<input type="hidden" name="maLH" value="<?php echo $get['maLH'] ?>">
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
</div>