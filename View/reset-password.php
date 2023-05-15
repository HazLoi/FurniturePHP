    <!--Page Title-->
    <section class="page-title" style="background-image:url(assets/images/background/2.jpg)">
    	<div class="auto-container">
    		<h2>Lấy lại mật khẩu</h2>
    		<ul class="page-breadcrumb">
    			<li><a href="index.php?action=home">home</a></li>
    			<li>Lấy lại mật khẩu</li>
    		</ul>
    	</div>
    </section>

    <!--End Page Title-->
    <section>
    	<?php if (empty($_GET['act'])) { ?>
    		<div class="auto-container my-5" style="font-size: 16px">
    			<h1 class="text-center title-page">Đặt lại mật khẩu</h1>
    			<div class="row">
    				<p class="mx-auto my-2 text-danger" style="font-size: 18px">(*) Nhập email đã đăng ký, mã xác thực sẽ được gửi đến email của bạn</p>
    			</div>
    			<form class="col-lg-6 col-md-6 col-sm-12 m-auto" action="index.php?action=reset-password&act=reset" method="post">
    				<div class="form-group">
    					<label for="email">Email</label>
    					<input class="form-control" type="text" name="email" autocomplete="off" placeholder="furniture@gmail.com">
    				</div>
    				<div>
    					<button class="btn btn-info">
    						Xác nhận
    					</button>
    				</div>
    			</form>
    		</div>
    	<?php } elseif (isset($_GET['act']) && $_GET['act'] == 'reset') { ?>
    		<div class="auto-container my-5" style="font-size: 16px">
    			<h1 class="text-center title-page">Nhập mã đã nhận</h1>
    			<div class="row">
    				<p class="mx-auto my-2 text-danger" style="font-size: 18px">(*) Nhập mã đã gửi qua email, mã xác thực đã được gửi đến email của bạn</p>
    			</div>
    			<form class="col-lg-6 col-md-6 col-sm-12 m-auto" action="index.php?action=reset-password&act=submit" method="post">
    				<div class="form-group">
    					<label for="code">Mã xác nhận</label>
    					<input class="form-control" type="text" name="code" autocomplete="off" placeholder="**********">
    				</div>
    				<div>
    					<button class="btn btn-info">
    						Xác nhận
    					</button>
    				</div>
    			</form>
    		</div>
    	<?php } elseif (isset($_GET['act']) && $_GET['act'] == 'submit' || $_GET['act'] == 'complete') { ?>
    		<div class="auto-container my-5" style="font-size: 16px">
    			<h1 class="text-center title-page my-3">Nhập lại mật khẩu</h1>
    			<form class="col-lg-7 col-md-7 col-sm-12 m-auto" action="index.php?action=reset-password&act=complete&get=changePass" method="post">

    				<div class="form-group row">
    					<div class="col-7 m-auto">
    						<label for="" class="h5">Mật khẩu mới</label>
    						<input class="form-control" type="password" name="password" id="passwordNew" value="<?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo $_POST['password'] ?>" placeholder="Nhập mật khẩu mới">
    						<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassNew()">
    							<span id="showPassNew">Hiện mật khẩu</span>
    						</button><br>
    						<span class="error text-danger">
    							<?php if (isset($_GET['get']) && $_GET['get'] == "changePass") echo $_SESSION['passwordErrorResetPassword']; ?>
    						</span>
    					</div>
    				</div>

    				<div class="form-group row">
    					<div class="col-7 m-auto">
    						<label for="" class="h5">Nhập lại mật khẩu mới</label>
    						<input class="form-control" type="password" name="repassword" id="passwordRenew" value="<?php if (!empty($_GET['get']) && $_GET['get'] == 'ResetPass') echo $_POST['repassword'] ?>" placeholder="Nhập lại mật khẩu">
    						<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassRenew()">
    							<span id="showPassRenew">Hiện mật khẩu</span>
    						</button><br>
    						<span class="error text-danger">
    							<?php if (isset($_GET['get']) && $_GET['get'] == "changePass") echo $_SESSION['repasswordErrorResetPassword']; ?>
    						</span>
    					</div>
    				</div>

    				<div class="form-group row">
    					<div class="col-6 m-auto">
    						<button class="btn btn-success">Thay đổi mật khẩu</button>
    					</div>
    				</div>

    			</form>
    		</div>
    	<?php } ?>
    </section>