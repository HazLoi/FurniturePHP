<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
// Tạo đối tượng đọc file excel
$reader = IOFactory::createReader('Xlsx');


if (isset($_SESSION['role']) && $_SESSION['role'] != 0) {
	$act = "admin-page";
	if (isset($_GET['act'])) {
		$act = $_GET['act'];
	}

	switch ($act) {
		case 'admin-page':
			include_once "View/Admin/admin-page.php";
			break;
		case 'productList':
			if (isset($_GET['get'])) {
				if ($_GET['get'] == 'deleteProduct') {
					$admin = new admin();
					$admin->deleteProductDatabase($_POST['masp']);
				}
			}
			include_once "View/Admin/productList.php";
			break;
		case 'addProduct':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == "add") {
						$productName = $_POST['productName'];
						$category = $_POST['category'];
						$price = $_POST['price'];
						$sale = $_POST['sale'];
						$instock = $_POST['instock'];
						$selled = $_POST['selled'];
						$rate = $_POST['rate'];
						$like = $_POST['like'];
						$descriptionShort = $_POST['descriptionShort'];
						$descriptionLong = $_POST['descriptionLong'];

						$validate = new validate();
						$result = $validate->adminAddProduct($productName, $_FILES['image']['name'], $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong);

						if ($result == 1) {
							$checkExistsProductName = $validate->checkAddProductName($productName);
							if (empty($checkExistsProductName)) {
								$nameImage = preg_replace("/[^A-Za-z0-9]/", "", $_POST['productName']);
								$imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
								$image = $nameImage . "." . $imageExtension;

								$admin = new admin();
								$admin->addProductDatabase($productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong);

								$saveImage = new addImageProduct();
								$saveImage->saveImageProduct($_FILES['image'], $productName);
								echo "<script> alert('Thêm sản phẩm thành công') </script>";
								echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=addProduct"/>';
							} else {
								echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
								include_once "View/Admin/addProduct.php";
							}
						}
					}
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			include_once "View/Admin/addProduct.php";
			break;
		case 'editProduct':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) {
				if (isset($_GET['maSP']) && intval($_GET['maSP']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsProduct($_GET['maSP']);
					if (!empty($check)) {
						$admin = new admin();
						$result = $admin->findProductById($_GET['maSP']);

						$productName = $result['ten'];
						$categoryId = $result['loai'];
						$categoryName = $result['tenloai'];
						$instock = $result['tonkho'];
						$sale = $result['giamgia'];
						$price = $result['dongia'];
						$rate = $result['danhgia'];
						$like = $result['yeuthich'];
						$descriptionShort = $result['motangan'];
						$descriptionLong = $result['mota'];

						if (isset($_GET['get'])) {
							if ($_GET['get'] == 'edit') {
								$productName = $_POST['productName'];
								$category = $_POST['category'];
								$price = $_POST['price'];
								$sale = $_POST['sale'];
								$instock = $_POST['instock'];
								$selled = $_POST['selled'];
								$rate = $_POST['rate'];
								$like = $_POST['like'];
								$descriptionShort = $_POST['descriptionShort'];
								$descriptionLong = $_POST['descriptionLong'];

								$validate = new validate();
								$result = $validate->adminEditProduct($productName, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong);
								if ($result == 1) {
									if (!empty($_FILES['image']['name']) && !empty($_FILES['image']['name']) != null) {

										$checkExistsProductName = $validate->checkExistsProductName($_GET['maSP'], $productName);
										if (empty($checkExistsProductName)) {
											$nameImage = preg_replace("/[^A-Za-z0-9]/", "", $_POST['productName']);
											$imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
											$image = $nameImage . "." . $imageExtension;

											$admin = new admin();
											$admin->editProductDatabase($_GET['maSP'], $productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong);

											$saveImage = new addImageProduct();
											$saveImage->saveImageProduct($_FILES['image'], $productName);
											echo "<script> alert('Cập nhật sản phẩm thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
										} else {
											echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
											include_once "View/Admin/editProduct.php";
										}
									} else {
										$checkExistsProductName = $validate->checkExistsProductName($_GET['maSP'], $productName);
										if (empty($checkExistsProductName)) {

											$admin = new admin();
											$admin->editProductDatabaseNoImage($_GET['maSP'], $productName, $category, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong);

											echo "<script> alert('Cập nhật sản phẩm thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
										} else {
											echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
											include_once "View/Admin/editProduct.php";
										}
									}
								} else {
									include_once "View/Admin/productList.php";
								}
							}
						}
						include_once "View/Admin/editProduct.php";
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'adminList':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'deleteAdmin') {
						$admin = new admin();
						$admin->deleteCustomer($_POST['maKH']);
						echo "<script> alert('Xóa tài khoản thành công') </script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
					}
				}
				include_once "View/Admin/adminList.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'editAdmin':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['maKH']) && intval($_GET['maKH']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsCustomer($_GET['maKH']);
					if (!empty($check)) {
						$admin = new admin();
						$result = $admin->findCustomerById($_GET['maKH']);

						$fname = $result['ho'];
						$lname = $result['ten'];
						$emailBefore = $result['email'];
						$phone = $result['sdt'];
						$roleId = $result['maQuyen'];
						$roleName = $result['quyen'];
						if (isset($_GET['get'])) {
							if ($_GET['get'] == 'edit') {
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$fname = $_POST['fname'];
								$lname = $_POST['lname'];
								$role = $_POST['role'];

								if ($emailBefore == $email) {
									$validate = new validate();
									$check = $validate->adminEditCustomer($fname, $lname, $email, $phone);
									if ($check == 1) {
										$admin = new admin();
										$admin->updateCustomer($_GET['maKH'], $email, $phone, $fname, $lname, $role);
										echo "<script> alert('Cập nhật tài khoản Quản trị thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
									} else {
										include_once "View/Admin/editAdmin.php";
									}
								} else {
									$user = new user();
									$checkExists = $user->existsEmailAccount($email);
									if (empty($checkExists)) {
										$validate = new validate();
										$check = $validate->adminEditCustomer($fname, $lname, $email, $phone);
										if ($check == 1) {
											$admin = new admin();
											$admin->updateCustomer($_GET['maKH'], $email, $phone, $fname, $lname, $rolee);
											echo "<script> alert('Cập nhật tài khoản Quản trị thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
										} else {
											include_once "View/Admin/editAdmin.php";
										}
									} else {
										echo "<script> alert('Email đã tồn tại') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
									}
								}
							}
						}
						include_once "View/Admin/editAdmin.php";
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'customerList':
			if (isset($_GET['get'])) {
				if ($_GET['get'] == 'deleteCustomer') {
					$admin = new admin();
					$admin->deleteCustomer($_POST['maKH']);
					echo "<script> alert('Xóa tài khoản thành công') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
				}
			}
			include_once "View/Admin/customerList.php";
			break;
		case 'editCustomer':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) {

				if (isset($_GET['maKH']) && intval($_GET['maKH']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsCustomer($_GET['maKH']);
					if (!empty($check)) {
						$admin = new admin();
						$result = $admin->findCustomerById($_GET['maKH']);

						$fname = $result['ho'];
						$lname = $result['ten'];
						$emailBefore = $result['email'];
						$phone = $result['sdt'];
						$roleId = $result['maQuyen'];
						$roleName = $result['quyen'];
						if (isset($_GET['get'])) {
							if ($_GET['get'] == 'edit') {
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$fname = $_POST['fname'];
								$lname = $_POST['lname'];
								$role = $_POST['role'];

								if ($emailBefore == $email) {
									$validate = new validate();
									$check = $validate->adminEditCustomer($fname, $lname, $email, $phone);
									if ($check == 1) {
										$admin = new admin();
										$admin->updateCustomer($_GET['maKH'], $email, $phone, $fname, $lname, $role);
										echo "<script> alert('Cập nhật tài khoản thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
									} else {
										include_once "View/Admin/editCustomer.php";
									}
								} else {
									$user = new user();
									$checkExists = $user->existsEmailAccount($email);
									if (empty($checkExists)) {
										$validate = new validate();
										$check = $validate->adminEditCustomer($fname, $lname, $email, $phone);
										if ($check == 1) {
											$admin = new admin();
											$admin->updateCustomer($_GET['maKH'], $email, $phone, $fname, $lname, $rolee);
											echo "<script> alert('Cập nhật tài khoản thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
										} else {
											include_once "View/Admin/editCustomer.php";
										}
									} else {
										echo "<script> alert('Email đã tồn tại') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
									}
								}
							}
						}
						include_once "View/Admin/editCustomer.php";
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'categories':
			if (isset($_GET['get'])) {
				if ($_GET['get'] == 'add') {
					$validate = new validate();
					$check = $validate->checkAddCategory($_POST['categoryName']);
					if (!empty($check)) {
						$admin = new admin();
						$admin->addCategory($_POST['categoryName']);
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
					} else {
						include_once "View/Admin/categories.php";
					}
				}

				if ($_GET['get'] == 'deleteCategory') {
					$admin = new admin();
					$admin->deleteCategory($_POST['maLoai']);
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
				}

				if (isset($_GET['id']) && intval($_GET['id']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsCategory($_GET['id']);
					if (!empty($check)) {
						if ($_GET['get'] == 'edit') {
							$admin = new admin();
							$getCategoryName = $admin->getCategoryById($_GET['id']);
							$categoryName = $getCategoryName['tenloai'];
							if (isset($_GET['active']) && $_GET['active'] == 'edit') {
								$validate = new validate();
								$check = $validate->checkEditCategory($_POST['categoryName']);
								if ($check == 1) {
									$checkExistsCategoryName = $validate->checkExistsCategoryName($_GET['id'], $_POST['categoryName']);
									if (empty($checkExistsCategoryName)) {
										$admin = new admin();
										$admin->editCategory($_GET['id'], $_POST['categoryName']);
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
									} else {
										$_SESSION['categoryNameErrorEditCategory'] = 'Tên loại đã tồn tại';
										include_once "View/Admin/categories.php";
									}
								} else {
									include_once "View/Admin/categories.php";
								}
							}
						} else {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
						}
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
				}
			}
			include_once "View/Admin/categories.php";
			break;
		case 'invoiceList':
			if (isset($_GET['get']) && $_GET['get'] == 'deleteInvoice') {
				$admin = new admin();
				$admin->deleteInvoice($_POST['maHD']);
			}
			include_once "View/Admin/invoiceList.php";
			break;
		case 'editInvoice':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 6) {

				if (isset($_GET['id']) && intval($_GET['id']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsInvoice($_GET['id']);
					if (!empty($check)) {
						$admin = new admin();
						$result = $admin->getInvoiceById($_GET['id']);
						$maHD = $result['maHD'];
						$hovaten = $result['hovaten'];
						$tinhtrang = $result['tinhtrang'];
						$tongtien = $result['tongtien'];
						$sdt = $result['sdt'];
						$email = $result['email'];
						$ngay = $result['ngay'];
						if (isset($_GET['get'])) {
							if ($_GET['get'] == 'edit') {
								$edit =  $admin->editInvoice($maHD, $_POST['maSP'], $_POST['soluong'], $_POST['dongia']);
								if ($edit == -1) {
									echo "<script> alert('Cập nhật thành công') </script>";
									echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=editInvoice&id=' . $maHD . '"/>';
								} else {
									echo "<script> alert('Cập nhật số lượng phải < $edit') </script>";
									echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=editInvoice&id=' . $maHD . '"/>';
								}
							}
							if ($_GET['get'] == 'delete') {
								$delete = $admin->deleteProductInInvoice($maHD, $_POST['maSP']);
								if ($delete == 1) {
									echo "<script> alert('Xóa sản phẩm thành công) </script>";
									echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=editInvoice&id=' . $maHD . '"/>';
								} else {
									echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=invoiceList"/>';
								}
							}
						}

						include_once "View/Admin/editInvoice.php";
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=invoiceList"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=invoiceList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'newsList':
			if (isset($_GET['get'])) {
				if ($_GET['get'] == 'deleteNews') {
					$admin = new admin();
					$admin->deleteNews($_POST['maTT']);
					echo "<script> alert('Xóa tin tức thành công') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
				}
			}
			include_once "View/Admin/newsList.php";
			break;
		case 'addNews':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
				if (isset($_GET['get']) && $_GET['get'] == 'add') {
					$title = $_POST['title'];
					$date = $_POST['date'];
					$image = $_FILES['image']['name'];
					$content = $_POST['content'];
					$tt = $_POST['tt'];


					$validate = new validate($title, $date, $image, $content);
					$result = $validate->checkAddNews($title, $date, $image, $content);
					if ($result == 1) {
						$nameImage = preg_replace("/[^A-Za-z0-9]/", "", $title);
						$imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
						$imageName = $nameImage . "." . $imageExtension;

						$admin = new admin();
						$admin->addNews($title, $date, $imageName, $content, $tt);

						$saveImage = new addImageProduct();
						$saveImage->saveImageNews($_FILES['image'], $title);
						die;
						echo "<script> alert('Thêm tin tức thành công') </script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
					}
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			include_once "View/Admin/addNews.php";
			break;
		case 'editNews':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) {
				if (isset($_GET['maTT']) && intval($_GET['maTT']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsNews($_GET['maTT']);
					if (!empty($check)) {
						$admin = new admin();
						$result = $admin->getNewsById($_GET['maTT']);

						$title = $result['tenTT'];
						$content = $result['noidung'];
						$detail = $result['chitiet'];
						$date = $result['ngay'];

						if (isset($_GET['get'])) {
							if ($_GET['get'] == 'edit') {
								$title = $_POST['title'];
								$content = $_POST['content'];

								$detail = $_POST['detail'];
								$date = $_POST['date'];
								$tt = $_POST['tt'];
								$validate = new validate();
								$check = $validate->checkEditNews($title, $date, $content, $detail);
								if ($check == 1) {
									if (!empty($_FILES['image']['name']) && !empty($_FILES['image']['name']) != null) {
										$code = '';
										$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
										$charactersLength = strlen($characters);
										$codeLength = 8;
										for ($i = 0; $i < $codeLength; $i++) {
											$code .= $characters[rand(0, $charactersLength - 1)];
										}
										$imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
										$saveImageName = $code . "." . $imageExtension;

										$admin = new admin();
										$admin->editNews($_GET['maTT'], $title, $date, $saveImageName, $content, $tt, $detail);

										$saveImage = new addImageProduct();
										$saveImage->saveImageNews($_FILES['image'], $code);
										// echo "<script> alert('Cập nhật tin tức thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
									} else {
										$admin->editNewsNoImage($_GET['maTT'], $title, $date, $content, $tt, $detail);
										// echo "<script> alert('Cập nhật tin tức thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
									}
								} else {
									include_once "View/Admin/editNews.php";
								}
							}
						}
						include_once "View/Admin/editNews.php";
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'commentList':
			if (isset($_GET['id']) && intval($_GET['id']) != null) {
				$validate = new validate();
				$check = $validate->checkExistsProduct($_GET['id']);
				if (!empty($check)) {
					if (isset($_GET['get'])) {
						if ($_GET['get'] == 'deleteComment') {
							$admin = new admin();
							$result = $admin->deleteComment($_POST['maBL'], $_GET['id']);
							if ($result) {
								echo "<script> alert('Xóa bình luận sản phẩm thành công') </script>";
								echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=commentList&id=' . $_GET['id'] . '"/>';
							} else {
								echo "<script> alert('Đã xãy ra lỗi') </script>";
								echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=commentList&id=' . $_GET['id'] . '"/>';
							}
						}
					}
				} else {
					echo "<script> alert('Kiểm tra thất bại') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
				}
			} else {
				echo "<script> alert('Sản phẩm không tồn tại') </script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
			}
			include_once "View/Admin/commentList.php";
			break;
		case 'thongke':
			if ($_SESSION['role'] == 1) {
				include_once "View/Admin/thongke.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'findAdminDeleted':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'submit') {
						$admin = new admin();
						$result = $admin->restoreAdmin($_GET['id']);
						if ($result) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findAdminDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findAdminDeleted"/>';
						}
					}
					if ($_GET['get'] == 'delete') {
						$admin = new admin();
						$result1 = $admin->dropAdmin($_GET['id']);
						if ($result1) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findAdminDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findAdminDeleted"/>';
						}
					}
				}
				include_once "View/Admin/findAdminDeleted.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'findCustomerDeleted':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'submit') {
						$admin = new admin();
						$result = $admin->restoreCustomer($_GET['id']);
						if ($result) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCustomerDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCustomerDeleted"/>';
						}
					}

					if ($_GET['get'] == 'delete') {
						$admin = new admin();
						$result1 = $admin->dropCustomer($_GET['id']);
						if ($result1) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCustomerDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCustomerDeleted"/>';
						}
					}
				}
				include_once "View/Admin/findCustomerDeleted.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'findProductDeleted':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'submit') {
						$admin = new admin();
						$result = $admin->restoreProduct($_GET['id']);
						if ($result) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findProductDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findProductDeleted"/>';
						}
					}
					if ($_GET['get'] == 'delete') {
						$admin = new admin();
						$result1 = $admin->dropProduct($_GET['id']);
						if ($result1) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findProductDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findProductDeleted"/>';
						}
					}
				}
				include_once "View/Admin/findProductDeleted.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'findInvoiceDeleted':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'submit') {
						$admin = new admin();
						$result = $admin->restoreInvoice($_GET['id']);
						if ($result) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findInvoiceDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findInvoiceDeleted"/>';
						}
					}
					if ($_GET['get'] == 'delete') {
						$admin = new admin();
						$result1 = $admin->dropInvoice($_GET['id']);
						if ($result1) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findInvoiceDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findInvoiceDeleted"/>';
						}
					}
				}
				include_once "View/Admin/findInvoiceDeleted.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'findCategoryDeleted':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'submit') {
						$admin = new admin();
						$result = $admin->restoreCategory($_GET['id']);
						if ($result) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCategoryDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCategoryDeleted"/>';
						}
					}
					if ($_GET['get'] == 'delete') {
						$admin = new admin();
						$result1 = $admin->dropCategory($_GET['id']);
						if ($result1) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCategoryDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findCategoryDeleted"/>';
						}
					}
				}
				include_once "View/Admin/findCategoryDeleted.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'findContactDeleted':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'submit') {
						$admin = new admin();
						$result = $admin->restoreContact($_GET['id']);
						if ($result) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findContactDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findContactDeleted"/>';
						}
					}
					if ($_GET['get'] == 'delete') {
						$admin = new admin();
						$result1 = $admin->dropContact($_GET['id']);
						if ($result1) {
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findContactDeleted"/>';
						} else {
							echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=findContactDeleted"/>';
						}
					}
				}
				include_once "View/Admin/findContactDeleted.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'contactList':
			if ($_SESSION['role'] == 1) {
				if (isset($_GET['get'])) {
					if ($_GET['get'] == 'deleteContact') {
						$admin = new admin();
						$result = $admin->deleteContact($_POST['maLH']);
						if ($result) {
							echo "<script> alert('Xóa thư thành công') </script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=contactList"/>';
						} else {
							echo "<script> alert('Đã xãy ra lỗi khi xóa') </script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=contactList"/>';
						}
					}
				}
				include_once "View/Admin/contactList.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'importProducts':
			if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
				// echo "<pre>";
				// print_r($_FILES);
				// echo "</pre>";
				// die;
				$file = $_FILES['fileImport']['name'];
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension !== 'xlsx') {
					echo "<script>alert('Đây không phải là file excel')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
				} else {

					// Đọc file excel
					$spreadsheet = $reader->load($_FILES['fileImport']['tmp_name']);

					// Chọn sheet cần đọc dữ liệu
					$worksheet = $spreadsheet->getActiveSheet();

					// Lấy số dòng và số cột
					$rowCount = $worksheet->getHighestRow();
					$columnCount = $worksheet->getHighestColumn();

					// Khởi tạo mảng chứa dữ liệu
					$data = array();

					// Đọc dữ liệu từ sheet
					for ($row = 2; $row <= $rowCount; $row++) {
						$productImage = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$productName = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$category = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						$price = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
						$instock = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
						$descriptionShort = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
						$descriptionLong = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

						// Thêm dữ liệu vào mảng
						$data[] = array(
							'productImage' => $productImage,
							'productName' => $productName,
							'category' => $category,
							'price' => $price,
							'instock' => $instock,
							'descriptionShort' => $descriptionShort,
							'descriptionLong' => $descriptionLong,
						);
					}

					// In ra mảng dữ liệu
					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";
					// die;

					$check = 0;
					$admin = new admin();
					foreach ($data as $key => $item) {
						$getCategoryByName = $admin->getCategoryByName($item['category']);
						$categoryId = $getCategoryByName['maLoai'];

						$validate = new validate();
						$check = $validate->checkAddProductName($item['productName']);
						//Kiểm tra tên tồn tại
						if (empty($check)) {
							$result = $admin->importProducts($item['productImage'], $item['productName'], $categoryId, $item['price'], $item['instock'], $item['descriptionShort'], $item['descriptionLong']);
							if ($result) {
								$check += 1;
							} else {
								$check -= 1;
							}
						} else {
							$ten = $item['productName'];
							echo "<script>alert('$ten đã tồn tại')</script>";
							break;
						}
					}
					// thêm thành công - thất bại
					if ($check > 0) {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
					} else {
						echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
					}
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;
		case 'importAdmin':
			if ($_SESSION['role'] == 1) {
				// echo "<pre>";
				// print_r($_FILES);
				// echo "</pre>";
				// die;
				$file = $_FILES['fileImport']['name'];
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension !== 'xlsx') {
					echo "<script>alert('Đây không phải là file excel')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
				} else {

					// Đọc file excel
					$spreadsheet = $reader->load($_FILES['fileImport']['tmp_name']);

					// Chọn sheet cần đọc dữ liệu
					$worksheet = $spreadsheet->getActiveSheet();

					// Lấy số dòng và số cột
					$rowCount = $worksheet->getHighestRow();
					$columnCount = $worksheet->getHighestColumn();

					// Khởi tạo mảng chứa dữ liệu
					$data = array();

					// Đọc dữ liệu từ sheet
					for ($row = 2; $row <= $rowCount; $row++) {
						$fname = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$lname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$email = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						$password = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
						$phone = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
						$role = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

						// Thêm dữ liệu vào mảng
						$data[] = array(
							'fname' => $fname,
							'lname' => $lname,
							'email' => $email,
							'password' => $password,
							'phone' => $phone,
							'role' => $role,
						);
					}

					// In ra mảng dữ liệu
					// echo "<pre>";
					// print_r($data);
					// echo "</pre>";
					// die;

					$check = 0;
					$admin = new admin();
					foreach ($data as $key => $item) {
						$getRoleByName = $admin->getRoleByName($item['role']);
						// var_dump($getRoleByName);
						// die;
						$roleId = $getRoleByName['maQuyen'];
						$validate = new validate();
						$check = $validate->checkExistsEmail($item['email']);
						//Kiểm tra tên tồn tại
						if (empty($check)) {
							$result = $admin->importAdmin($item['fname'], $item['lname'], $item['email'], $item['password'], $item['phone'], $roleId);
							if ($result) {
								$check += 1;
							} else {
								$check -= 1;
							}
						} else {
							$a = $item['email'];
							echo "<script>alert('$a đã tồn tại')</script>";
							break;
						}
					}
					// thêm thành công - thất bại
					if ($check > 0) {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
					} else {
						echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
					}
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
			break;

		default:
			include_once "View/Admin/404.php";
			break;
	}
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
}
