<?php
if (isset($_GET['id']) && intval($_GET['id']) != null) {
	$validate = new validate();
	$check = $validate->checkExistsInvoice($_GET['id']);
	if (!empty($check)) {
		include_once 'View/invoiceDetail.php';
	} else {
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
	}
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
}
