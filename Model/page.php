<?php
class page
{
	private $db = null;
	public function __construct()
	{
		$this->db = new connect();
	}

	public function findPage($count, $limit)
	{
		$page = (($count % $limit) == 0) ? $count / $limit : ceil($count / $limit);

		return $page;
	}

	public function findStart($limit)
	{
		if (!isset($_GET['page']) || $_GET['page'] == 1) {
			$start = 0;
		} else {
			$start = ($_GET['page'] - 1) * $limit;
		}
		return $start;
	}
}
