<?php

class productCart
{
	public function addToCart($maSP, $mausac, $kichthuoc, $soluong)
	{
		$sp = new product();

		$result = $sp->checkProductId($maSP);

		$ten = $result['ten'];
		$anh = $result['anh'];
		$tonkho = $result['tonkho'];
		$daban = $result['daban'];
		$yeuthich = $result['yeuthich'];
		$danhgia = $result['danhgia'];
		$dongia = $result['dongia'];
		$giamgia = $result['giamgia'];
		$loai = $result['loai'];
		$thanhtien = $dongia * $soluong;
		$kiemtra = 0;

		if (isset($_SESSION['productCart']) && count($_SESSION['productCart']) > 0) {
			foreach ($_SESSION['productCart'] as $key => $item) {
				if ($maSP == $item['maSP'] && $mausac == $item['mausac'] && $kichthuoc == $item['kichthuoc']) {
					$kiemtra = 1;
					$sp = new product();
					if (($_SESSION['productCart'][$key]['soluong'] + $soluong) <= $tonkho) {
						$_SESSION['productCart'][$key]['soluong'] += $soluong;
						$_SESSION['productCart'][$key]['thanhtien'] = $_SESSION['productCart'][$key]['soluong'] * $_SESSION['productCart'][$key]['dongia'];
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
					} else {
						echo "<script> alert('Sản phẩm $ten chỉ còn $tonkho') </script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=product-detail&maSP=' . $maSP . '"/>';
					}
				}
			}
		}

		if ($kiemtra == 0) {
			if ($soluong <= $tonkho) {
				$item = array(
					'maSP' => $maSP,
					'ten' => $ten,
					'anh' => $anh,
					'loai' => $loai,
					'dongia' => $dongia,
					'giamgia' => $giamgia,
					'soluong' => $soluong,
					'mausac' => $mausac,
					'kichthuoc' => $kichthuoc,
					'thanhtien' => $thanhtien
				);
				$_SESSION['productCart'][] = $item;
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
			} else {
				echo "<script> alert('Sản phẩm $ten chỉ còn $tonkho') </script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=product-detail&maSP=' . $maSP . '"/>';
			}
		}
	}

	public function tongTien()
	{
		$tongtien = 0;
		if (isset($_SESSION['productCart'])) {
			foreach ($_SESSION['productCart'] as $item) {
				$tongtien += $item['thanhtien'];
			}
		}

		return $tongtien;
	}

	public function updateProduct($soluongmoi, $vitri, $maSP)
	{
		if ($soluongmoi <= 0) {
			$this->deleteProduct($vitri);
		} else {
			$sp = new product();
			$checkTonKho = $sp->checkInStock($maSP);
			$name = $_SESSION['productCart'][$vitri]['ten'];
			if ($soluongmoi <= $checkTonKho) {

				$_SESSION['productCart'][$vitri]['soluong'] = $soluongmoi;

				$newTotal = $_SESSION['productCart'][$vitri]['soluong'] * $_SESSION['productCart'][$vitri]['dongia'];

				$_SESSION['productCart'][$vitri]['thanhtien'] = $newTotal;
			} else {
				echo "<script> alert('Hiện tại sản phẩm $name chỉ còn: $checkTonKho') </script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=product-cart"/>';
			}
		}
	}

	public function deleteProduct($vitri)
	{
		array_splice($_SESSION['productCart'], $vitri, 1);
	}

	public function deleteProductCart()
	{
		array_splice($_SESSION['productCart'], 0, count($_SESSION['productCart']));
	}
}
