<?php
if (isset($_GET['act']) && $_GET['act'] == "register") {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phoneNumber = $_POST['phoneNumber'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$email = $_POST['email'];
	$validate = new validate();
	$checkValue = $validate->checkRegisterAccount($fname, $lname, $email, $phoneNumber, $password, $repassword);

	if ($checkValue == 1) {
		$register = new user();
		$checkEmail = $register->existsEmailAccount($email);
		if (empty($checkEmail)) {
			$registerAccount = $register->registerAccount($fname, $lname, $phoneNumber, $email, $password);
			if ($registerAccount) {
				echo "<script>alert('Đăng ký thành công')</script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
			} else {
				// var_dump($registerAccount);
				// die;
				echo "<script>alert('Đã có lỗi xãy ra')</script>";
				include_once "View/register-account.php";
			}
		} else {
			echo "<script>alert('Email đã tồn tại!!')</script>";
			include_once "View/register-account.php";
		}
	} else {
		include_once "View/register-account.php";
	}
} else {
	include_once "View/register-account.php";
}
