<?php
if (isset($_GET['maSP'])) {
	$comment = new comment();
	$getAllCommentByProductId =  $comment->getCommentByProductId($_GET['maSP']);
	$count =  $getAllCommentByProductId->rowCount();

	$p = new page();
	$limit = 5;
	$page = $p->findPage($count, $limit);
	$start = $p->findStart($limit);
	if (isset($_GET['page']) && $_GET['page'] <= 0 || isset($_GET['page']) && $_GET['page'] > $page) {
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
	} else {


		if (!preg_match("/^[0-9]+$/", $_GET['maSP'])) {
			include_once "View/404.php";
		}

		$sp = new product();
		$result = $sp->checkProductId($_GET['maSP']);

		if (!empty($result)) {
			$maSP = $result['maSP'];
			$ten = $result['ten'];
			$loai = $result['loai'];
			$anh = $result['anh'];
			$dongia = $result['dongia'];
			$giamgia = $result['giamgia'];
			$mota = $result['mota'];
			$mausac = $result['mausac'];
			$kichthuoc = $result['kichthuoc'];
			$tonkho = $result['tonkho'];
			$daban = $result['daban'];
			$danhgia = $result['danhgia'];
			$yeuthich = $result['yeuthich'];
			$motangan = $result['motangan'];
			if (isset($_GET['get']) && $_GET['get'] == 'comment') {
				$productId = $_GET['maSP'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$email = $_POST['email'];
				$content = $_POST['content'];
				$rating = $_POST['rating'];

				$validate = new validate();
				$check = $validate->checkComment($fname, $lname, $email, $content, $rating);
				if ($check == 1) {
					$comment = new comment();
					$result = $comment->insertComments($productId, $_SESSION['idCustomer'], $fname, $lname, $email, $content, $rating);
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=product-detail&maSP=' . $productId . '"/>';
				} else {
					include_once "View/product-detail.php";
				}
			}
			include_once "View/product-detail.php";
		} else {
			include_once "View/404.php";
		}
	}
} else {
	include_once "View/404.php";
}
