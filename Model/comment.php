<?php
class comment
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function insertComments($productId, $idCustomer, $fname, $lname, $email, $content, $rating)
	{
		$fullname = $lname . " " . $fname;
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		if ($rating > 5) {
			$rating = 5;
		} elseif ($rating < 0) {
			$rating = 1;
		}


		$insert = "INSERT INTO binh_luan (maSP, maTG, tacgia, email, binhluan, ngay, danhgia)
		VALUES ($productId, $idCustomer, '$fullname', '$email', '$content', '$dateFix', $rating)";

		$this->db->exec($insert);
	}

	public function getCommentByProductId($productId)
	{
		$select = "SELECT * FROM binh_luan WHERE maSP = $productId and trangthai = 1 ORDER BY maBL DESC";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getCommentByProductIdOnePage($productId, $start, $limit)
	{
		$select = "SELECT binh_luan.*, anh FROM binh_luan, nguoi_dung WHERE maTG = maKH and maSP = $productId and binh_luan.trangthai = 1 ORDER BY maBL DESC limit $start, $limit";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getQtyCommentByProductId($productId)
	{
		$select = "SELECT count(*) as 'soluong' FROM binh_luan WHERE maSP = $productId and trangthai = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}
}
