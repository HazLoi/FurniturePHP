<?php
if (isset($_SESSION['productCart']) && count($_SESSION['productCart']) > 0) {
	if (isset($_GET['act']) && $_GET['act'] == "orderPlace" && isset($_SESSION['idCustomer'])) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$companyName = $_POST['companyName'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$code = $_POST['code'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$note = $_POST['note'];


		$validate = new validate();
		$result = $validate->checkoutValidate($fname, $lname, $address1, $city, $country, $code, $email, $phone);
		if ($result == 1) {
			if (isset($_SESSION['idCustomer'])) {
				$checkout = new checkout();

				$idInvoice = $checkout->insertInvoice($_SESSION['idCustomer']);
				$total = 0;

				foreach ($_SESSION['productCart'] as $key => $item) {
					$insertInvoiceDetails = $checkout->insertInvoiceDetails($idInvoice, $item['maSP'], $item['ten'], $item['soluong'], $item['dongia'], $item['thanhtien']);

					$total += $item['thanhtien'];
				}
	
				$a = $checkout->saveInvoiceInfomation($idInvoice, $_SESSION['idCustomer'], $_SESSION['fullname'], $phone, $email, $companyName, $address1, $address2, $city, $code, $total, $note);

				$checkout->updateInvoiceTotal($idInvoice, $total);
				$send = new sendEmail();
				$send->sendEmailCheckout($_SESSION['idCustomer'], $idInvoice, $email);
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
			}
			// else {
			// 	$idCustomer = '';
			// 	$characters = '0123456789';
			// 	$charactersLength = strlen($characters);
			// 	$idCustomerLength = 10;
			// 	for ($i = 0; $i < $idCustomerLength; $i++) {
			// 		$idCustomer .= $characters[rand(0, $charactersLength - 1)];
			// 	}

			// 	$idCustomer = intval($idCustomer);
			// 	$checkout = new checkout();

			// 	$idInvoice = $checkout->insertInvoice(12345);
			// 	$total = 0;

			// 	foreach ($_SESSION['productCart'] as $key => $item) {
			// 		$checkout->insertInvoiceDetails($idInvoice, $item['maSP'], $item['ten'], $item['soluong'], $item['dongia'], $item['thanhtien']);
			// 		$total += $item['thanhtien'];
			// 	}

			// 	$checkout->updateInvoiceTotal($idInvoice, $total);
			// 	$send = new sendEmail();
			// 	$send->sendEmailCheckout(12345, $idInvoice, $email);
			// 	// echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
			// 	echo $idCustomer;
			// 	echo gettype($idCustomer);
			// 	die;
			// }
		}
	}
	include_once "View/checkout.php";
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
}
