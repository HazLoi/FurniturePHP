<?php
class user
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function registerAccount($fname, $lname, $phoneNumber, $email, $password)
	{
		$fullName = trim($lname) . " " . trim($fname);

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');


		$insert = "INSERT INTO nguoi_dung (ho, ten, hovaten, gioitinh, sdt, email, matkhau, maQuyen,ngaydk) 
		VALUES ('$fname', '$lname', '$fullName', 'Khác', '$phoneNumber', '$email', '$mk', 0, '$dateFix')";

		$result = $this->db->exec($insert);
		return $result;
	}

	public function existsEmailAccount($email)
	{
		$query = "SELECT * FROM nguoi_dung WHERE email = '$email' and trangthai = 1";

		$result = $this->db->getInstance($query);

		return $result;
	}

	public function loginAccount($email, $password)
	{
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$query = "SELECT * FROM nguoi_dung WHERE email = '$email' and matkhau = '$mk' and trangthai = 1 ";

		$result = $this->db->getInstance($query);
		return $result;
	}

	public function logout()
	{
		unset($_SESSION['phone']);
		unset($_SESSION['idCustomer']);
		unset($_SESSION['email']);
		unset($_SESSION['fullname']);
		if (isset($_SESSION['cartProdcut']) && count($_SESSION['cartProduct']) > 0) {
			array_splice($_SESSION['cartProduct'], 0, count($_SESSION['cartProduct']));
		}
	}

	public function getInfoByCustomerId($customerId)
	{
		$select = "SELECT * FROM nguoi_dung WHERE maKH = $customerId and trangthai = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}

	public function saveInfoAccount($customerId, $fullname, $date, $email, $gender, $address, $zip, $phone)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE nguoi_dung SET hovaten = '$fullname', ngaysinh = '$date', email = '$email', gioitinh = '$gender', diachi = '$address', zip = '$zip', sdt = '$phone', ngaycapnhat = '$dateFix' WHERE maKH = $customerId";

		$result = $this->db->exec($update);
		return $result;
	}

	public function changePassword($customerId, $password, $passwordNew)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');
		//lấy mật khẩu đã mã hóa trong database
		$select = "SELECT matkhau FROM nguoi_dung WHERE maKH = $customerId and trangthai = 1";
		$passAcc = $this->db->getInstance($select);
		$passwordOld = $passAcc['matkhau'];
		// mã hóa mật khẩu nhập - mật khẩu mới - và nhập lại mật khẩu
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk1 = md5($mahoa1 . $password . $mahoa2);
		$mk2 = md5($mahoa1 . $passwordNew . $mahoa2);
		//bắt đầu đổi mật khẩu
		if ($mk1 == $passwordOld) {
			$update = "UPDATE nguoi_dung SET matkhau = '$mk2', ngaycapnhat = '$dateFix' WHERE maKH = $customerId";
			$this->db->exec($update);
			return 1;
		} else {
			$_SESSION['passwordErrorChangePassword'] = "Mật khẩu không đúng";
			return 0;
		}
	}

	public function getInvoiceByCustomerId($customerId)
	{
		$select = "SELECT * FROM hoa_don WHERE maKH = $customerId and trangthai = 1 ORDER BY maHD DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function addWishlist($customerId, $productId)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$select = "SELECT * FROM yeu_thich WHERE maKH = $customerId and maSP = $productId";
		$checkExists = $this->db->getInstance($select);
		if (empty($checkExists)) {
			$insert = "INSERT INTO yeu_thich (maSP, maKH, ngay) VALUES ($productId, $customerId, '$dateFix')";
			$result = $this->db->exec($insert);
			return $result;
		} else {
			echo "<script>alert('Sản phẩm đã tôn tại trong mục yêu thích của bạn')</script>";
		}
	}

	public function getWishlist($customerId)
	{
		$select = "SELECT maYT,b.* FROM yeu_thich as a, sanpham as b WHERE a.maSP = b.maSP and a.maKH = $customerId";

		$result = $this->db->getList($select);

		return $result;
	}

	public function deleteWishlist($wishlistId, $customerId)
	{
		$delete = "DELETE FROM yeu_thich WHERE maYT = $wishlistId and maKH = $customerId";

		$result = $this->db->exec($delete);

		return $result;
	}

	public function resetPassword($email, $password)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$update = "UPDATE nguoi_dung SET matkhau = '$mk', ngaycapnhat = '$dateFix' WHERE email = '$email'";

		$this->db->exec($update);
	}

	public function emailSubscribe($email)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$insert = "INSERT INTO email_dktruoc (email, ngaydk) 
		VALUES ('$email', '$dateFix')";

		$result = $this->db->exec($insert);
		return $result;
	}
}
