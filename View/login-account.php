    <!--Page Title-->
    <section class="page-title" style="background-image:url(assets/images/background/2.jpg)">
    	<div class="auto-container">
    		<h2>Đăng nhập</h2>
    		<ul class="page-breadcrumb">
    			<li><a href="index.php?action=home">home</a></li>
    			<li>Đăng nhập</li>
    		</ul>
    	</div>
    </section>

    <!--End Page Title-->
    <section>
    	<div class="auto-container my-5" style="font-size: 16px">
    		<h1 class="text-center title-page">Đăng nhập tài khoản</h1>
    		<form class="col-lg-6 col-md-6 col-sm-12 m-auto" action="index.php?action=login-account&act=login" method="post">

    			<div class="form-group">
    				<label for="email">Email</label>
    				<input class="form-control" type="text" name="email" autocomplete="off" value="<?php if (isset($_GET['act']) && $_GET['act'] == "login") echo $_POST['email']; ?>" placeholder="furniture@gmail.com">
    			</div>

    			<div class="form-group">
    				<label for="passwordAccount">Mật khẩu</label>
    				<input class="form-control" type="password" name="password" id="password" autocomplete="off" placeholder="******">
    				<div class="d-flex  justify-content-between">
    					<button class="border-0" style="background: none;" type="button" onclick="showPass()">
    						<span id="showPass">Hiện mật khẩu</span>
						</button>
						<a href="index.php?action=reset-password" class="text-primary">Quên mật khẩu ?</a>
    				</div>
    			</div>

    			<div class="d-flex justify-content-between">
    				<div>
    					<button class="btn btn-info">
    						Đăng nhập
    					</button>
    				</div>
    				<div>
    					<a href="index.php?action=register-account" class="btn btn-primary">Chưa có tài khoản</a>
    				</div>
    			</div>

    		</form>
    	</div>
    </section>