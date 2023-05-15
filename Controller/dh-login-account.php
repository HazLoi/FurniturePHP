<?php
if (isset($_GET['act']) && $_GET['act'] == 'login') {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$login = new user();
	$result = $login->loginAccount($email, $password);
	if (!empty($result)) {
		// đăng nhập thành công và lưu thông tin người dùng
		$_SESSION['idCustomer'] = $result['maKH'];
		$_SESSION['role'] = $result['maQuyen'];
		$_SESSION['fullname'] = $result['hovaten'];
		$_SESSION['email'] = $result['email'];
		$_SESSION['lname'] = $result['ten'];
		$_SESSION['fname'] = $result['ho'];
		$_SESSION['phone'] = $result['sdt'];
		$_SESSION['image'] = $result['anh'];

		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
	} else {
		echo "<script>alert('Email hoặc mật khẩu không đúng!!')</script>";
		include_once "View/login-account.php";
	}
} else {
	include_once "View/login-account.php";
}
