<form action="index.php?action=admin-page&act=editNews&get=edit&maTT=<?php echo $_GET['maTT'] ?>" method="post" enctype="multipart/form-data" id="editNewsDatabase">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12">

			<div class="form-group">
				<label for="title">Tiêu đề</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['title'];
																} else {
																	echo $title;
																} ?>" type="text" name="title">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['titleErrorAdminEditNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="date">Ngày</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['date'];
																} else {
																	echo $date;
																} ?>" type="date" name="date">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['dateErrorAdminEditNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="image">Ảnh</label><br>
				<input class="" type="file" name="image">
			</div>

			<div class="form-group">
				<label for="tt">Trạng thái</label>
				<select class="form-control" name="tt">
					<option value="1">Hiện</option>
					<option value="0">Ẩn</option>
				</select>
			</div>

			<button class="btn btn-primary">Cập nhật tin tức</button>
		</div>

		<div class="col-lg-9 col-md-9 col-sm-12">
			<div class="form-group">
				<label for="content">Nội dung</label>
				<textarea class="form-control" cols="10" rows="13" style="resize: none;" type="text" name="content"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																																							echo $_POST['content'];
																																						} else {
																																							echo $content;
																																						} ?></textarea>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['contentErrorAdminEditNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="detail">Chi tiết</label>
				<textarea class="form-control" cols="10" rows="13" style="resize: none;" type="text" name="detail" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																																						echo $_POST['detail'];
																																					} else {
																																						echo $detail;
																																					} ?></textarea>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['detailErrorAdminEditNews']; ?></span>
			</div>
		</div>
	</div>
</form>