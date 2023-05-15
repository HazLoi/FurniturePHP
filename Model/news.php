<?php
class news
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllNews()
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getNewsOnePage($start, $limit)
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang != 0 limit $start, $limit";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsDetailPage($start, $limit, $newsId)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT != $newsId and tinhtrang !=0 limit $start, $limit";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsDetail($newsId)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT = $newsId and tinhtrang = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function checkNewsId($newId)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT = $newId and tinhtrang = 1";
		$result = $this->db->getInstance($select);
		return $result;
	}
}
