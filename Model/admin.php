<?php
class admin
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllProduct()
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and a.trangthai = 1 ORDER BY a.maSP DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductForCategory($loai)
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and tenloai = '$loai' and a.trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductSearchByName($ten)
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and ten like '%$ten%'  and a.trangthai = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getProductSearchById($maSP)
	{
		$maSP = intval($maSP);
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and maSP = $maSP  and a.trangthai = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function addProductDatabase($productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong)
	{
		$insert = "INSERT INTO sanpham (maSP, ten, loai, anh, dongia, giamgia, motangan, mota, mausac, kichthuoc, tonkho, daban, danhgia, yeuthich)
		VALUES (null , '$productName', '$category', '$image', $price, $sale, '$descriptionShort', '$descriptionLong', '', '','$instock', '$selled', '$rate', '$like')";

		$this->db->exec($insert);
	}

	public function editProductDatabase($productId, $productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE sanpham SET ten = '$productName', loai = '$category', anh = '$image', giamgia = $sale, dongia = $price, tonkho = '$instock', daban = '$selled', danhgia = '$rate', yeuthich = '$like', mota = '$descriptionLong', motangan = '$descriptionShort', ngaycapnhat = '$dateFix' WHERE maSP = $productId";

		$this->db->exec($update);
	}

	public function editProductDatabaseNoImage($productId, $productName, $category, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE sanpham SET ten = '$productName', loai = '$category', giamgia = $sale, dongia = $price, tonkho = '$instock', daban = '$selled', danhgia = '$rate', yeuthich = '$like', mota = '$descriptionLong', motangan = '$descriptionShort', ngaycapnhat = '$dateFix' WHERE maSP = $productId";

		$this->db->exec($update);
	}

	public function deleteProductDatabase($productId)
	{
		$query = "UPDATE sanpham SET trangthai = 0 WHERE maSP = $productId";
		$this->db->exec($query);
	}

	public function findProductById($productId)
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and maSP = $productId  and a.trangthai = 1";
		return $this->db->getInstance($select);
	}

	public function getAllCustomer()
	{
		$select = "SELECT * FROM nguoi_dung as a, phan_quyen as b WHERE a.maQuyen = 0 and a.maQuyen = b.maQuyen and a.trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function findCustomerById($idCustomer)
	{
		$select = "SELECT * FROM nguoi_dung as a,phan_quyen as b WHERE maKH = $idCustomer and a.maQuyen = b.maQuyen and a.trangthai = 1 GROUP BY a.maQuyen";
		return $this->db->getInstance($select);
	}

	public function deleteCustomer($idCustomer)
	{
		$delete = "UPDATE nguoi_dung SET trangthai = 0 WHERE maKH = $idCustomer";
		$this->db->exec($delete);
	}

	public function updateCustomer($idCustomer, $email, $phone, $fname, $lname, $role)
	{
		$fullname = $lname . " " . $fname;
		$update = "UPDATE nguoi_dung SET ho = '$fname', ten='$lname', hovaten = '$fullname', sdt = '$phone', email = '$email', maQuyen = $role WHERE maKH = $idCustomer";
		$this->db->exec($update);
	}

	public function getAllRole()
	{
		$select = "SELECT * FROM phan_quyen WHERE trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getRoleByName($roleName)
	{
		$select = "SELECT * FROM phan_quyen WHERE quyen = '$roleName'";
		$result = $this->db->getInstance($select);
		return $result;
	}


	public function getAllAdmin()
	{
		$select = "SELECT * FROM nguoi_dung as a, phan_quyen as b WHERE a.maQuyen != 0 and a.maQuyen = b.maQuyen and a.trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllNews()
	{
		$select = "SELECT * FROM tin_tuc";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsById($id)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT = $id";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getNewsByTT($tt)
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = $tt";
		$result = $this->db->getList($select);
		return $result;
	}

	public function editNews($newsId, $title, $date, $imageName, $content, $tt, $detail)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE tin_tuc SET tenTT = '$title',anh = '$imageName', ngay = '$date', noidung = '$content', tinhtrang = $tt, chitiet = '$detail', ngaycapnhat = '$dateFix' WHERE maTT = $newsId";

		$this->db->exec($update);
	}

	public function editNewsNoImage($newsId, $title, $date, $content, $tt, $detail)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE tin_tuc SET tentT = '$title', ngay = '$date', noidung = '$content', tinhtrang = $tt, chitiet = '$detail', ngaycapnhat = '$dateFix' WHERE maTT = $newsId";

		$this->db->exec($update);
	}

	public function addNews($title, $date, $image, $content, $tt)
	{
		$insert = "INSERT INTO tin_tuc (tenTT, anh, ngay, noidung, tinhtrang)

		VALUES ('$title', '$image', '$date', '$content','$tt')";

		$this->db->exec($insert);
	}

	public function deleteNews($newsId)
	{
		$delete = "UPDATE tin_tuc SET trangthai = 0 WHERE maTT = $newsId";
		$this->db->exec($delete);
	}

	public function getAllInvoice()
	{
		$select = "SELECT * FROM hoa_don as a, nguoi_dung as b WHERE a.maKH = b.maKH and a.trangthai = 1 ORDER BY maHD DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function deleteInvoice($invoiceId)
	{
		$delete = "UPDATE hoa_don SET trangthai = 0 WHERE maHD = $invoiceId";
		$this->db->exec($delete);
	}

	public function editInvoice($invoiceId, $productId, $quantity, $price)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$product = new product();
		$check = $product->checkInStock($productId);
		if ($quantity < $check) {
			$totalProduct = $quantity * $price;
			$updateOneProduct = "UPDATE ct_hoadon SET soluongmua = $quantity, thanhtien = $totalProduct WHERE maHD = $invoiceId and maSP = $productId";
			$this->db->exec($updateOneProduct);

			$admin = new admin();
			$result = $admin->getProductInvoiceById($invoiceId);
			$totalInvoice = 0;
			while ($get = $result->fetch()) {
				$totalInvoice += $get['thanhtien'];
			}

			$updateTotalInvoice = "UPDATE hoa_don SET tongtien = $totalInvoice, ngaycapnhat = '$dateFix' WHERE maHD = $invoiceId";
			$this->db->exec($updateTotalInvoice);
			return -1;
		} else {
			return $check;
		}
	}

	public function deleteProductInInvoice($invoiceId, $productId)
	{
		$delete = "UPDATE ct_hoadon SET trangthai = 0 and maHD = $invoiceId and maSP = $productId";
		$this->db->exec($delete);

		$admin = new admin();
		$result = $admin->getProductInvoiceById($invoiceId);
		$totalInvoice = 0;
		while ($get = $result->fetch()) {
			$totalInvoice += $get['thanhtien'];
		}

		if ($totalInvoice > 0) {
			$updateTotalInvoice = "UPDATE hoa_don SET tongtien = $totalInvoice WHERE maHD = $invoiceId";
			$this->db->exec($updateTotalInvoice);
			return 1;
		} elseif ($totalInvoice == 0) {
			$delete = "UPDATE hoa_don SET trangthai = 0 WHERE maHD = $invoiceId";
			$this->db->exec($delete);
			return 0;
		}
	}

	public function getInvoiceById($invoiceId)
	{
		$select = "SELECT a.maHD, a.ngay, a.tongtien, a.tinhtrang, b.hovaten, b.sdt, b.email
		FROM hoa_don as a, nguoi_dung as b
		WHERE a.maKH = b.maKH and a.maHD = $invoiceId and a.trangthai = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getProductInvoiceById($invoiceId)
	{
		$select = "SELECT c.maSP, c.tenSP, c.soluongmua, c.dongia, c.thanhtien, d.anh
		FROM ct_hoadon as c, sanpham as d 
		WHERE c.maSP = d.maSP and c.maHD = $invoiceId and c.trangthai = 1";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllCategory()
	{
		$select = "SELECT * FROM loai_sanpham WHERE trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getCategoryById($categoryId)
	{
		$select = "SELECT * FROM loai_sanpham WHERE maLoai = $categoryId and trangthai = 1";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getCategoryByName($categoryName)
	{
		$select = "SELECT maLoai FROM loai_sanpham WHERE tenloai = '$categoryName'";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function addCategory($categoryName)
	{
		$insert = "INSERT INTO loai_sanpham (tenloai) VALUES ('$categoryName')";
		$result = $this->db->exec($insert);
		return $result;
	}

	public function deleteCategory($categoryId)
	{
		$delete = "UPDATE loai_sanpham SET trangthai = 0 WHERE maLoai = $categoryId";
		$result = $this->db->exec($delete);
		return $result;
	}

	public function editCategory($categoryId, $categoryName)
	{
		$update = "UPDATE loai_sanpham SET tenloai = '$categoryName' WHERE maLoai = $categoryId";
		$result = $this->db->exec($update);
		return $result;
	}

	public function getAllComment()
	{
		$select = "SELECT * FROM comments WHERE trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getQtyCommentByProductId($productId)
	{
		$select = "SELECT count(*) as 'soluong' FROM binh_luan WHERE maSP = $productId and trangthai = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getCommentByProductId($productId)
	{
		$select = "SELECT * FROM binh_luan WHERE maSP = $productId and trangthai = 1";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getCommentByRating($qtyRate, $productId)
	{
		$select = "SELECT * FROM binh_luan WHERE danhgia = $qtyRate and maSP = $productId and trangthai = 1";

		$result = $this->db->getList($select);
		return $result;
	}

	public function deleteComment($commentId, $productId)
	{
		$select = "UPDATE binh_luan SET trangthai = 0 WHERE maSP = $productId AND maBL = $commentId";
		$result = $this->db->exec($select);
		return $result;
	}

	public function getAllContact()
	{
		$select = "SELECT * FROM lienhe WHERE trangthai = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getContactByEmail($email)
	{
		$select = "SELECT * FROM lienhe WHERE email = '$email' and trangthai = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getContactBySubject($subject)
	{
		$select = "SELECT * FROM lienhe WHERE chude LIKE '%$subject%' and trangthai = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getEmailSendContact()
	{
		$select = "SELECT email FROM lienhe WHERE trangthai = 1 GROUP BY email";

		$result = $this->db->getList($select);

		return $result;
	}

	public function deleteContact($contactId)
	{
		$delete = "UPDATE lienhe SET trangthai = 0 WHERE maLH = $contactId";

		$result = $this->db->exec($delete);

		return $result;
	}



	public function thongKeTheoMY($month, $year)
	{
		$select = "SELECT a.ten, sum(soluongmua) as soluongmua FROM sanpham a, ct_hoadon b, hoa_don c WHERE a.maSP = b.maSP and c.maHD = b.maHD and month(ngay) = $month and year(ngay) = $year group by a.ten";

		$result = $this->db->getlist($select);

		return  $result;
	}

	public function thongKeTheoDMY($day, $month, $year)
	{
		$select = "SELECT a.ten, sum(soluongmua) as soluongmua FROM sanpham a, ct_hoadon b, hoa_don c WHERE a.maSP = b.maSP and c.maHD = b.maHD and day(ngay) = $day and month(ngay) = $month and year(ngay) = $year group by a.ten";

		$result = $this->db->getlist($select);

		return  $result;
	}

	public function thongKeTheoQuy($quy, $year)
	{
		$start_date = '';
		$end_date = '';

		// Tính ngày bắt đầu và ngày kết thúc của quý
		switch ($quy) {
			case 1:
				$start_date = $year . '-01-01';
				$end_date = $year . '-03-31';
				break;
			case 2:
				$start_date = $year . '-04-01';
				$end_date = $year . '-06-30';
				break;
			case 3:
				$start_date = $year . '-07-01';
				$end_date = $year . '-09-30';
				break;
			case 4:
				$start_date = $year . '-10-01';
				$end_date = $year . '-12-31';
				break;
			default:
				return null;
				break;
		}

		// Lấy thông tin sản phẩm bán được trong quý
		$select = "SELECT a.ten, SUM(b.soluongmua) AS soluongmua, c.ngay FROM sanpham a, ct_hoadon b, hoa_don c WHERE a.maSP = b.maSP AND c.maHD = b.maHD AND c.ngay >= '$start_date' AND c.ngay <= '$end_date' and year(c.ngay) = $year GROUP BY a.ten";

		$result = $this->db->getlist($select);

		return $result;
	}



	public function getAllAdminDeleted()
	{
		$select = "SELECT * FROM nguoi_dung as a, phan_quyen as b WHERE a.maQuyen != 0 and a.maQuyen = b.maQuyen and a.trangthai = 0";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllCustomerDeleted()
	{
		$select = "SELECT * FROM nguoi_dung as a, phan_quyen as b WHERE a.maQuyen = 0 and a.maQuyen = b.maQuyen and a.trangthai = 0";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllProductDeleted()
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and a.trangthai = 0 ORDER BY a.maSP DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllCategoryDeleted()
	{
		$select = "SELECT * FROM loai_sanpham WHERE trangthai = 0";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllInvoiceDeleted()
	{
		$select = "SELECT * FROM hoa_don as a, nguoi_dung as b WHERE a.maKH = b.maKH and a.trangthai = 0 ORDER BY maHD DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllContactDeleted()
	{
		$select = "SELECT * FROM lienhe WHERE trangthai = 0 ORDER BY maLH DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function restoreAdmin($idAdmin)
	{
		$select = "UPDATE nguoi_dung SET trangthai = 1 WHERE maKH = $idAdmin";
		$result = $this->db->exec($select);
		return $result;
	}

	public function restoreCustomer($idCustomer)
	{
		$select = "UPDATE nguoi_dung SET trangthai = 1 WHERE maKH = $idCustomer";
		$result = $this->db->exec($select);
		return $result;
	}

	public function restoreProduct($idProduct)
	{
		$select = "UPDATE sanpham SET trangthai = 1 WHERE maSP = $idProduct";
		$result = $this->db->exec($select);
		return $result;
	}

	public function restoreInvoice($idInvoice)
	{
		$select = "UPDATE hoa_don SET trangthai = 1 WHERE maHD = $idInvoice";
		$result = $this->db->exec($select);
		return $result;
	}

	public function restoreCategory($idCategory)
	{
		$select = "UPDATE loai_sanpham SET trangthai = 1 WHERE maLoai = $idCategory";
		$result = $this->db->exec($select);
		return $result;
	}

	public function restoreContact($idContact)
	{
		$select = "UPDATE lienhe SET trangthai = 1 WHERE maLH = $idContact";
		$result = $this->db->exec($select);
		return $result;
	}

	public function dropAdmin($idAdmin)
	{
		$delete = "DELETE FROM nguoi_dung WHERE maKH = $idAdmin";
		$result = $this->db->exec($delete);
		return $result;
	}
	public function dropCustomer($idCustomer)
	{
		$delete = "DELETE FROM nguoi_dung WHERE maKH = $idCustomer";
		$result = $this->db->exec($delete);
		return $result;
	}
	public function dropProduct($idProduct)
	{
		$delete = "DELETE FROM sanpham WHERE maSP = $idProduct";
		$result = $this->db->exec($delete);
		return $result;
	}
	public function dropCategory($idCategory)
	{
		$delete = "DELETE FROM loai_sanpham WHERE maLoai = $idCategory";
		$result = $this->db->exec($delete);
		return $result;
	}
	public function dropContact($idContact)
	{
		$delete = "DELETE FROM lienhe WHERE maLH = $idContact";
		$result = $this->db->exec($delete);
		return $result;
	}
	public function dropInvoice($idInvoice)
	{
		$delete = "DELETE FROM hoa_don WHERE maHD = $idInvoice";
		$result = $this->db->exec($delete);
		return $result;
	}

	public function importProducts($productImage, $productName, $category, $price, $instock, $descriptionShort, $descriptionLong)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$insert = "INSERT INTO sanpham (ten, loai, anh, dongia, motangan, mota, tonkho, ngaythem)
		VALUES ('$productName', $category, '$productImage', '$price', '$descriptionShort', '$descriptionLong' , '$instock', '$dateFix')";

		$result = $this->db->exec($insert);
		return $result;
	}

	public function importAdmin($fname, $lname, $email, $password, $phone, $roleId)
	{
		$fullname = $lname . " " . $fname;

		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);


		$insert = "INSERT INTO nguoi_dung (ho, ten, hovaten, sdt, email, matkhau, maQuyen, ngaydk)
		VALUES ('$fname', '$lname', '$fullname', '$phone', '$email', '$mk', '$roleId', '$dateFix')";

		$result = $this->db->exec($insert);
		return $result;
	}
}
