<?php
if (isset($_GET['act'])) {
	if ($_GET['act'] == 'reset') {
		if (!empty($_POST['email'])) {
			$validate = new validate();
			$result = $validate->checkExistsEmail($_POST['email']);
			if (!empty($result)) {
				$sendEmail = new sendEmail();
				$send  = $sendEmail->sendCodeResetPassword($_POST['email'], $result['hovaten']);
				include_once "View/reset-password.php";
			} else {
				echo '<script>alert("Email chưa được đăng ký")</script>';
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password"/>';
			}
		} else {
			echo '<script>alert("Vui lòng nhập email")</script>';
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password"/>';
		}
	}

	if ($_GET['act'] == 'submit') {
		$code = $_POST['code'];
		if ($code == $_SESSION['codeResetPassword']) {
			include_once "View/reset-password.php";
		}
	}

	if ($_GET['act'] == 'complete') {
		if (isset($_GET['get']) && $_GET['get'] == 'changePass') {
			$validate = new validate();
			$check = $validate->checkResetPassword($_POST['password'], $_POST['repassword']);
			if ($check == 1) {
				$email = $_SESSION['emailResetPassword'];
				$password = $_POST['password'];
				$repassword = $_POST['repassword'];
				$user = new user();
				$result = $user->resetPassword($email, $repassword);
				echo '<script>alert("Đổi mật khẩu thành công")</script>';
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
			} else {
				include_once "View/reset-password.php";
			}
		} else {
			include_once "View/reset-password.php";
		}
	}
} else {
	include_once "View/reset-password.php";
}
