<?php
if (empty($_SESSION['productCart'])) {
	$_SESSION['productCart'] = array();
}

if (isset($_GET['act'])) {
	$sp = new productCart();
	if ($_GET['act'] == "addToCart") {
		if (isset($_POST['maSP'])) {
			$maSP = $_POST['maSP'];
			$mausac = $_POST['mausac'];
			$kichthuoc = $_POST['kichthuoc'];
			$soluong = $_POST['soluong'];

			$sp->addToCart($maSP, $mausac, $kichthuoc, $soluong);
		}
	}

	if ($_GET['act'] == "deleteProduct") {
		$sp->deleteProduct($_GET['index']);
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
	}

	if ($_GET['act'] == "updateProduct") {
		$quantityNew = $_POST['soluong'];
		$idProductEdit = $_POST['maSP'];
		foreach ($quantityNew as $index => $quantity) {
			if ($quantity > 0) {
				if ($_SESSION['productCart'][$index]['soluong'] != $quantity) {
					$sp->updateProduct($quantity, $index, $_SESSION['productCart'][$index]['maSP']);
				}
			} else {
				include_once "View/cart-page.php";
			}
		}
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
	}

	if ($_GET['act'] == "deleteAll") {
		$sp->deleteProductCart();
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
	}
}

include_once "View/cart-page.php";
