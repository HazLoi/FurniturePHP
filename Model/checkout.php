<?php

class checkout
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function insertInvoice($maKH)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$query = "INSERT INTO hoa_don (maHD, maKH, ngay, tongtien, tinhtrang)
		VALUES (null, $maKH, '$dateFix', 0, 'Chưa thanh toán')";

		$this->db->exec($query);
		// lấy mã hóa đơn mới nhất
		$select = "SELECT maHD FROM hoa_don ORDER BY maHD DESC limit 1";
		$int = $this->db->getInstance($select);
		return $int[0];
	}

	public function insertInvoiceDetails($maHD, $maSP, $tenSP, $soluongmua, $dongia, $thanhtien)
	{
		$insert = "INSERT INTO ct_hoadon (maHD, maSP, tenSP, soluongmua, dongia, thanhtien) 
		VALUES ($maHD, $maSP, '$tenSP', '$soluongmua', $dongia, $thanhtien)";

		$result = $this->db->exec($insert);
		return $result;
	}

	public function updateInvoiceTotal($maHD, $tongtien)
	{
		$query = "UPDATE hoa_don SET tongtien = '$tongtien' WHERE maHD = $maHD";

		array_splice($_SESSION['productCart'], 0, count($_SESSION['productCart']));
		$this->db->exec($query);
	}

	public function saveInvoiceInfomation($idInvoice, $idCustomer, $fullname, $phone, $email, $companyName, $address1, $address2, $city, $zip, $total, $note)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$insert = "INSERT INTO thanh_toan (maHD, maKH, tenKH, sdt, email, congty, diachi1, diachi2, thanhpho, zip, ngay, tongtien, ghichu)
		VALUES ($idInvoice, $idCustomer, '$fullname', '$phone', '$email', '$companyName', '$address1', '$address2', '$city' , '$zip', '$dateFix', $total, '$note')";

		$result =  $this->db->exec($insert);
		return $result;
	}
}
