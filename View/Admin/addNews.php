<form action="index.php?action=admin-page&act=addNews&get=add" method="post" enctype="multipart/form-data" id="addNewsDatabase">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12">

			<div class="form-group">
				<label for="title">Tiêu đề</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add") {
																	echo $_POST['title'];
																} ?>" type="text" name="title">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['titleErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="date">Ngày</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add") {
																	echo $_POST['date'];
																} ?>" type="date" name="date">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['dateErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="image">Ảnh</label><br>
				<input class="" type="file" name="image"><br>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['imageErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="tt">Trạng thái</label>
				<select name="tt" class="form-control">
					<option value="0">Ẩn</option>
					<option value="1">Hiện</option>
				</select>
			</div>

			<button class="btn btn-primary">Thêm tin tức</button>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12">
			<div class="form-group">
				<label for="content">Nội dung</label>
				<textarea class="form-control" cols="10" rows="13" style="resize: none;" type="text" name="content"><?php if (isset($_GET['get']) && $_GET['get'] == "add") {
																																							echo $_POST['content'];
																																						} ?></textarea>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['contentErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="content">Chi tiết</label>
				<textarea class="form-control" cols="10" rows="13" style="resize: none;" type="text" name="content" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "add") {
																																							echo $_POST['content'];
																																						} ?></textarea>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['contentErrorAdminAddNews']; ?></span>
			</div>
		</div>
	</div>
</form>