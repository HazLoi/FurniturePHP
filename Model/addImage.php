<?php

class addImage
{
	public function saveImageProduct($image, $tensp)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		$tensp = preg_replace("/[^A-Za-z0-9]/", "", $tensp);
		$saveImageMain = $tensp . "." . $imageExtension;

		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/product/' . $saveImageMain;
			move_uploaded_file($imageTempName, $imageDestination);
		}

		return $validImage;


		// Resize the image
		// // Get the original image
		// $original_image = imagecreatefromjpeg('original.jpg');

		// // Specify the new width and height
		// $new_width = 200;
		// $new_height = 300;

		// // Create a new image with the specified width and height
		// $new_image = imagecreatetruecolor($new_width, $new_height);

		// // Copy and resample the original image into the new image
		// imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, imagesx($original_image), imagesy($original_image));

		// // Save the new image as a JPEG
		// imagejpeg($new_image, 'resized.jpg', 100);

		// // Clean up
		// imagedestroy($original_image);
		// imagedestroy($new_image);
	}

	public function saveImageNews($image, $newsName)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		$newsName = preg_replace("/[^A-Za-z0-9]/", "", $newsName);
		$saveImageMain = $newsName . "." . $imageExtension;
		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/resource/' . $saveImageMain;
			move_uploaded_file($imageTempName, $imageDestination);
		}


		return $validImage;
	}

	public function addImageAccount($image, $newsName)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/imageAccount/' . $newsName;
			move_uploaded_file($imageTempName, $imageDestination);
		}


		return $validImage;
	}
}
