<?php
if (!empty($_SESSION['idCustomer'])) {
	$user = new user();
	$result = $user->getInfoByCustomerId($_SESSION['idCustomer']);
	$fname = $result['ho'];
	$lname = $result['ten'];
	$fullname = $result['hovaten'];
	$email = $result['email'];
	$phone = $result['sdt'];
	$address = $result['diachi'];
	$zip = $result['zip'];
	$date = $result['ngaysinh'];
	$gender = $result['gioitinh'];
	if (isset($_GET['get'])) {
		if ($_GET['get'] == 'saveInfo') {
			$fullname = $_POST['fullname'];
			$date = $_POST['date'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$zip = $_POST['zip'];
			$gender = $_POST['gender'];
			$validate = new validate();
			$check = $validate->checkSaveInfoAccount($fullname, $date, $email, $address, $phone, $zip);
			if ($check == 1) {
				$user = new user();
				$save = $user->saveInfoAccount($_SESSION['idCustomer'], $fullname, $date, $email, $gender, $address, $zip, $phone);
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
			} else {
				include_once "View/myAccount.php";
			}
		}
		if ($_GET['get'] == 'changePass') {
			$password = $_POST['password'];
			$passwordNew = $_POST['passwordNew'];
			$passwordRenew = $_POST['passwordRenew'];

			$validate = new validate();
			$check = $validate->checkChangePassword($password, $passwordNew, $passwordRenew);
			if ($check == 1) {
				$user = new user();
				$change = $user->changePassword($_SESSION['idCustomer'], $password, $passwordNew);
				if ($change == 1) {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
				} else {
					include_once "View/myAccount.php";
				}
			} else {
				include_once "View/myAccount.php";
			}
		}
		if($_GET['get'] == 'deleteWishlist'){
			$user = new user();
			$user->deleteWishlist($_GET['id'], $_SESSION['idCustomer']);
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount&get=wishlist"/>';
		}
	}
	include_once "View/myAccount.php";
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
}
