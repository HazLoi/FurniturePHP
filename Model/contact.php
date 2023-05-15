<?php
class contact
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllContact()
	{
		$select = "SELECT * FROM lienhe";

		$result = $this->db->getList($select);

		return $result;
	}

	public function insertContact($fullname, $email, $subject, $content)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$insert = "INSERT INTO lienhe (tacgia, email, chude, noidung, ngaygui) VALUES ('$fullname', '$email', '$subject', '$content', '$dateFix')";

		$result = $this->db->exec($insert);

		return $result;
	}
}
