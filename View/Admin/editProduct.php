<form action="index.php?action=admin-page&act=editProduct&get=edit&maSP=<?php echo $_GET['maSP'] ?>" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 m-auto">

			<div class="form-group">
				<label for="productName">Tên sản phẩm</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['productName'];
																} else {
																	echo $productName;
																} ?>" type="text" name="productName">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['productNameErrorAdminEditProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="category">Loại sản phẩm</label>
				<select class="form-control" name="category">
					<option value="<?php echo $categoryId ?>"><?php echo $categoryName ?></option>
					<?php
					$admin = new admin();
					$categories = $admin->getAllCategory();
					while ($get = $categories->fetch()) {
					?>
						<option value="<?php echo $get['maLoai'] ?>"><?php echo $get['tenloai'] ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="image">Ảnh</label>
				<input class="form-control" type="file" name="image">
			</div>

			<div class="form-group">
				<label for="price">Đơn giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['price'];
																} else {
																	echo $price;
																} ?>" type="number" value="0" name="price">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['priceErrorAdminEditProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="sale">Giảm giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['sale'];
																} else {
																	echo $sale;
																} ?>" type="number" value="0" name="sale">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['saleErrorAdminEditProduct']; ?></span>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 m-auto">
			<button class="btn btn-primary">Cập nhật sản phẩm</button>
			<div class="form-group">
				<label for="instock">Tồn kho</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['instock'];
																} else {
																	echo $instock;
																} ?>" type="number" value="0" name="instock">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['instockErrorAdminEditProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="selled">Đã bán</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['selled'];
																} else {
																	echo $selled;
																} ?>" type="number" value="0" name="selled">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['selledErrorAdminEditProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="rate">Đánh giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['rate'];
																} else {
																	echo $rate;
																} ?>" type="number" value="0" name="rate">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['rateErrorAdminEditProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="like">Yêu thích</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																	echo $_POST['like'];
																} else {
																	echo $like;
																} ?>" type="number" value="0" name="like">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['likeErrorAdminEditProduct']; ?></span>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 form-group">
			<label for="descriptionShort">Mô tả ngắn</label>
			<textarea class="form-control" style="resize: none;" type="text" name="descriptionShort" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																																								echo $_POST['descriptionShort'];
																																							} else {
																																								echo $descriptionShort;
																																							} ?></textarea>
			<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['descriptionShortErrorAdminEditProduct']; ?></span>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 form-group">
			<label for="descriptionLong">Mô tả chi tiết</label>
			<textarea class="form-control" style="resize: none;" type="text" name="descriptionLong" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") {
																																							echo $_POST['descriptionLong'];
																																						} else {
																																							echo $descriptionLong;
																																						} ?></textarea>
			<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['descriptionLongErrorAdminEditProduct']; ?></span>
		</div>
	</div>

</form>