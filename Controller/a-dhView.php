<?php
$action = "home";
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

switch ($action) {
	case "home":
		include_once "dh-home.php";
		break;
	case "about":
		include_once "dh-about.php";
		break;
	case "contact":
		include_once "dh-contact.php";
		break;
	case "blog":
		include_once "dh-blog.php";
		break;
	case "blog-2":
		include_once "dh-blog-2.php";
		break;
	case "blog-detail":
		include_once "dh-blog-detail.php";
		break;
	case "checkout":
		include_once "dh-checkout.php";
		break;
	case "shop":
		include_once "dh-shop.php";
		break;
		// add - remove - update
	case "cart-page":
		include_once "dh-cart-page.php";
		break;
	case "product-detail":
		include_once "dh-product-detail.php";
		break;
	case "projects":
		include_once "dh-projects.php";
		break;
	case "login-account":
		include_once "dh-login-account.php";
		break;
	case "register-account":
		include_once "dh-register-account.php";
		break;
	case "myAccount":
		include_once "dh-myAccount.php";
		break;
	case "invoiceDetail":
		include_once "dh-invoiceDetail.php";
		break;
	case "reset-password":
		include_once "dh-reset-password.php";
		break;

		// services
	case "services-dark":
		include_once "dh-services-dark.php";
		break;
	case "services-light":
		include_once "dh-services-light.php";
		break;
	case "commercial-interior":
		include_once "services/dh-commercial-interior.php";
		break;
	case "false-celling-design":
		include_once "services/dh-false-celling-design.php";
		break;
	case "hospitality-design":
		include_once "services/dh-hospitality-design.php";
		break;
	case "modern-furniture":
		include_once "services/dh-modern-furniture.php";
		break;
	case "modular-kitchen":
		include_once "services/dh-modular-kitchen.php";
		break;
	case "office-interior":
		include_once "services/dh-office-interior.php";
		break;
	case "residental-interior":
		include_once "services/dh-residental-interior.php";
		break;
	case "wardrobe":
		include_once "services/dh-wardrobe.php";
		break;
		// Not found
	case "404":
		include_once "View/404.php";
		break;
	case "admin-page":
		if (isset($_SESSION['role']) != 0) {
			include_once "dh-admin-page.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		}
		break;
	case "logout-account":
		$user = new user();
		$user->logout();
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
		break;
	case "subscribe":
		if (empty($_POST['email'])) {
			echo "<script> alert('Vui lòng nhập email') </script>";
			include 'View/home.php';
		} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "<script> alert('Email không hợp lệ') </script>";
			include 'View/home.php';
		} else {
			$validate = new validate();
			$checkEmailSubscribe = $validate->checkExistsSubscribeEmail($_POST['email']);
			if (empty($checkEmailSubscribe)) {
				$user = new user();
				$emailSubscribe = $user->emailSubscribe($_POST['email']);
				if ($emailSubscribe) {
					echo "<script> alert('Đăng ký thành công') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
				} else {
					echo "<script> alert('Đã xãy ra lỗi trong quá trình đăng ký!!') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
				}
			} else {
				echo "<script> alert('Email đã tồn tại') </script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
			}
		}
		break;

	default:
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		break;
}
