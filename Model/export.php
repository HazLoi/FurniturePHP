<?php
// Đường dẫn đến file autoload.php của thư viện PhpSpreadsheet
require 'vendor/autoload.php';

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class export
{
	public function exportDataProducts()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách sản phẩm");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã sản phẩm');
		$sheet->setCellValue('B1', 'Tên sản phẩm');
		$sheet->setCellValue('C1', 'Loại sản phẩm');
		$sheet->setCellValue('D1', 'Ảnh sản phẩm');
		$sheet->setCellValue('E1', 'Đơn giá');
		$sheet->setCellValue('F1', 'Giảm giá');
		$sheet->setCellValue('G1', 'Mô tả ngắn');
		$sheet->setCellValue('H1', 'Mô tả chi tiết');
		$sheet->setCellValue('I1', 'Màu sắc');
		$sheet->setCellValue('J1', 'Kích thước');
		$sheet->setCellValue('K1', 'Tồn kho');
		$sheet->setCellValue('L1', 'Đã bán');
		$sheet->setCellValue('M1', 'Đánh giá');
		$sheet->setCellValue('N1', 'Yêu thích');
		$sheet->setCellValue('O1', 'Ngày thêm');
		$sheet->setCellValue('P1', 'Ngày cập nhật');
		$sheet->setCellValue('Q1', 'Trạng thái');

		$admin = new admin();
		$result = $admin->getAllProductExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maSP']);
			$sheet->setCellValue('B' . $row, $set['ten']);
			$sheet->setCellValue('C' . $row, $set['loai']);
			$sheet->setCellValue('D' . $row, $set['anh']);
			$sheet->setCellValue('E' . $row, $set['dongia']);
			$sheet->setCellValue('F' . $row, $set['giamgia']);
			$sheet->setCellValue('G' . $row, $set['motangan']);
			$sheet->setCellValue('H' . $row, $set['mota']);
			$sheet->setCellValue('I' . $row, $set['mausac']);
			$sheet->setCellValue('J' . $row, $set['kichthuoc']);
			$sheet->setCellValue('K' . $row, $set['tonkho']);
			$sheet->setCellValue('L' . $row, $set['daban']);
			$sheet->setCellValue('M' . $row, $set['danhgia']);
			$sheet->setCellValue('N' . $row, $set['yeuthich']);
			$sheet->setCellValue('O' . $row, $set['ngaythem']);
			$sheet->setCellValue('P' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('Q' . $row, $set['trangthai']);
			$row++;
		}

		// //Cách này thì lại không hiển thị ra Save As
		// // Tạo một đối tượng Writer mới
		// $writer = new Xlsx($spreadsheet);

		// // Thiết lập header để trình duyệt hiển thị hộp thoại Save As
		// ob_start();
		// $filename1 = "productData.xlsx";
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="' . $filename1 . '"');
		// ob_end_clean();

		// // Xuất file Excel sang trình duyệt
		// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// $writer->save('php://output');


		// Cách này thì lại ra tại index.php
		// Tạo một đối tượng Writer mới để xuất dữ liệu ra file .xlsx
		$writer = new Xlsx($spreadsheet);
		$writer->save('productData.xlsx');
	}

	public function exportDataAdmins()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách tài khoản quản lý");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã tài khoản');
		$sheet->setCellValue('B1', 'Họ người dùng');
		$sheet->setCellValue('C1', 'Tên ngươi dùng');
		$sheet->setCellValue('D1', 'Giới tính');
		$sheet->setCellValue('E1', 'Số điện thoại');
		$sheet->setCellValue('F1', 'Email');
		$sheet->setCellValue('G1', 'Quyền');
		$sheet->setCellValue('H1', 'Ngày sinh');
		$sheet->setCellValue('I1', 'Địa chỉ');
		$sheet->setCellValue('J1', 'Zip');
		$sheet->setCellValue('K1', 'Ngày đăng ký');
		$sheet->setCellValue('L1', 'Ngày cập nhật');
		$sheet->setCellValue('M1', 'Trạng thái');
		$sheet->setCellValue('N1', 'Tên ảnh đại diện');

		$admin = new admin();
		$result = $admin->getAllAdminExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maKH']);
			$sheet->setCellValue('B' . $row, $set['ho']);
			$sheet->setCellValue('C' . $row, $set['ten']);
			$sheet->setCellValue('D' . $row, $set['gioitinh']);
			$sheet->setCellValue('E' . $row, $set['sdt']);
			$sheet->setCellValue('F' . $row, $set['email']);
			$sheet->setCellValue('G' . $row, $set['quyen']);
			$sheet->setCellValue('H' . $row, $set['ngaysinh']);
			$sheet->setCellValue('I' . $row, $set['diachi']);
			$sheet->setCellValue('J' . $row, $set['zip']);
			$sheet->setCellValue('K' . $row, $set['ngaydk']);
			$sheet->setCellValue('L' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('M' . $row, $set['trangthai']);
			$sheet->setCellValue('N' . $row, $set['anh']);
			$row++;
		}

		// //Cách này thì lại không hiển thị ra Save As
		// // Tạo một đối tượng Writer mới
		// $writer = new Xlsx($spreadsheet);

		// // Thiết lập header để trình duyệt hiển thị hộp thoại Save As
		// ob_start();
		// $filename1 = "productData.xlsx";
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="' . $filename1 . '"');
		// ob_end_clean();

		// // Xuất file Excel sang trình duyệt
		// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// $writer->save('php://output');


		// Cách này thì lại ra tại index.php
		// Tạo một đối tượng Writer mới để xuất dữ liệu ra file .xlsx
		$writer = new Xlsx($spreadsheet);
		$writer->save('adminData.xlsx');
	}

	public function exportDataCustomers()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách tài khoản khách hàng");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã tài khoản');
		$sheet->setCellValue('B1', 'Họ người dùng');
		$sheet->setCellValue('C1', 'Tên ngươi dùng');
		$sheet->setCellValue('D1', 'Giới tính');
		$sheet->setCellValue('E1', 'Số điện thoại');
		$sheet->setCellValue('F1', 'Email');
		$sheet->setCellValue('G1', 'Quyền');
		$sheet->setCellValue('H1', 'Ngày sinh');
		$sheet->setCellValue('I1', 'Địa chỉ');
		$sheet->setCellValue('J1', 'Zip');
		$sheet->setCellValue('K1', 'Ngày đăng ký');
		$sheet->setCellValue('L1', 'Ngày cập nhật');
		$sheet->setCellValue('M1', 'Trạng thái');
		$sheet->setCellValue('N1', 'Tên ảnh đại diện');

		$admin = new admin();
		$result = $admin->getAllCustomerExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maKH']);
			$sheet->setCellValue('B' . $row, $set['ho']);
			$sheet->setCellValue('C' . $row, $set['ten']);
			$sheet->setCellValue('D' . $row, $set['gioitinh']);
			$sheet->setCellValue('E' . $row, $set['sdt']);
			$sheet->setCellValue('F' . $row, $set['email']);
			$sheet->setCellValue('G' . $row, $set['quyen']);
			$sheet->setCellValue('H' . $row, $set['ngaysinh']);
			$sheet->setCellValue('I' . $row, $set['diachi']);
			$sheet->setCellValue('J' . $row, $set['zip']);
			$sheet->setCellValue('K' . $row, $set['ngaydk']);
			$sheet->setCellValue('L' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('M' . $row, $set['trangthai']);
			$sheet->setCellValue('N' . $row, $set['anh']);
			$row++;
		}

		// //Cách này thì lại không hiển thị ra Save As
		// // Tạo một đối tượng Writer mới
		// $writer = new Xlsx($spreadsheet);

		// // Thiết lập header để trình duyệt hiển thị hộp thoại Save As
		// ob_start();
		// $filename1 = "productData.xlsx";
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="' . $filename1 . '"');
		// ob_end_clean();

		// // Xuất file Excel sang trình duyệt
		// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// $writer->save('php://output');


		// Cách này thì lại ra tại index.php
		// Tạo một đối tượng Writer mới để xuất dữ liệu ra file .xlsx
		$writer = new Xlsx($spreadsheet);
		$writer->save('customerData.xlsx');
	}

	public function exportDataInfoInvoices()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách hóa đơn");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã hóa đơn');
		$sheet->setCellValue('B1', 'Mã khách hàng');
		$sheet->setCellValue('C1', 'Tên khách hàng');
		$sheet->setCellValue('D1', 'Email');
		$sheet->setCellValue('E1', 'Số điện thoại');
		$sheet->setCellValue('F1', 'Công ty');
		$sheet->setCellValue('G1', 'Địa chỉ 1');
		$sheet->setCellValue('H1', 'Địa chỉ 2');
		$sheet->setCellValue('I1', 'Thành phố');
		$sheet->setCellValue('J1', 'Zip');
		$sheet->setCellValue('K1', 'Ngày đặt hàng');
		$sheet->setCellValue('L1', 'Ngày cập nhật');
		$sheet->setCellValue('M1', 'Tổng tiền');
		$sheet->setCellValue('N1', 'Ghi chú');
		$sheet->setCellValue('O1', 'Tình trạng');
		$sheet->setCellValue('P1', 'Trạng thái');

		$admin = new admin();
		$result = $admin->getAllInfoInvoicesExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maHD']);
			$sheet->setCellValue('B' . $row, $set['maKH']);
			$sheet->setCellValue('C' . $row, $set['tenKH']);
			$sheet->setCellValue('D' . $row, $set['email']);
			$sheet->setCellValue('E' . $row, $set['sdt']);
			$sheet->setCellValue('F' . $row, $set['congty']);
			$sheet->setCellValue('G' . $row, $set['diachi1']);
			$sheet->setCellValue('H' . $row, $set['diachi2']);
			$sheet->setCellValue('I' . $row, $set['thanhpho']);
			$sheet->setCellValue('J' . $row, $set['zip']);
			$sheet->setCellValue('K' . $row, $set['ngay']);
			$sheet->setCellValue('L' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('M' . $row, $set['tongtien']);
			$sheet->setCellValue('N' . $row, $set['ghichu']);
			$sheet->setCellValue('O' . $row, $set['tinhtrang']);
			$sheet->setCellValue('P' . $row, $set['trangthai']);
			$row++;
		}

		// //Cách này thì lại không hiển thị ra Save As
		// // Tạo một đối tượng Writer mới
		// $writer = new Xlsx($spreadsheet);

		// // Thiết lập header để trình duyệt hiển thị hộp thoại Save As
		// ob_start();
		// $filename1 = "productData.xlsx";
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="' . $filename1 . '"');
		// ob_end_clean();

		// // Xuất file Excel sang trình duyệt
		// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// $writer->save('php://output');


		// Cách này thì lại ra tại index.php
		// Tạo một đối tượng Writer mới để xuất dữ liệu ra file .xlsx
		$writer = new Xlsx($spreadsheet);
		$writer->save('invoiceData.xlsx');
	}

	public function exportDataNews()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách tin tức");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã tin tức');
		$sheet->setCellValue('B1', 'Tên tin tức');
		$sheet->setCellValue('C1', 'Ảnh tin tức');
		$sheet->setCellValue('D1', 'Ngày thực hiện');
		$sheet->setCellValue('E1', 'Nội dung');
		$sheet->setCellValue('F1', 'Chi tiết');
		$sheet->setCellValue('G1', 'Tình trạng');
		$sheet->setCellValue('H1', 'Ngày thêm');
		$sheet->setCellValue('I1', 'Ngày cập nhật');

		$admin = new admin();
		$result = $admin->getAllNewsExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maTT']);
			$sheet->setCellValue('B' . $row, $set['tenTT']);
			$sheet->setCellValue('C' . $row, $set['anh']);
			$sheet->setCellValue('D' . $row, $set['ngay']);
			$sheet->setCellValue('E' . $row, $set['noidung']);
			$sheet->setCellValue('F' . $row, $set['chitiet']);
			$sheet->setCellValue('G' . $row, $set['tinhtrang']);
			$sheet->setCellValue('H' . $row, $set['ngaythem']);
			$sheet->setCellValue('I' . $row, $set['ngaycapnhat']);
			$row++;
		}

		// //Cách này thì lại không hiển thị ra Save As
		// // Tạo một đối tượng Writer mới
		// $writer = new Xlsx($spreadsheet);

		// // Thiết lập header để trình duyệt hiển thị hộp thoại Save As
		// ob_start();
		// $filename1 = "productData.xlsx";
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="' . $filename1 . '"');
		// ob_end_clean();

		// // Xuất file Excel sang trình duyệt
		// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// $writer->save('php://output');


		// Cách này thì lại ra tại index.php
		// Tạo một đối tượng Writer mới để xuất dữ liệu ra file .xlsx
		$writer = new Xlsx($spreadsheet);
		$writer->save('newsData.xlsx');
	}

	public function exportDataContacts()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách sản phẩm");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã liên hệ');
		$sheet->setCellValue('B1', 'Người liên hệ');
		$sheet->setCellValue('C1', 'Email');
		$sheet->setCellValue('D1', 'Chủ đề');
		$sheet->setCellValue('E1', 'Nội dung');
		$sheet->setCellValue('F1', 'Trạng thái');
		$sheet->setCellValue('G1', 'Ngày gửi');

		$admin = new admin();
		$result = $admin->getAllContactExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maLH']);
			$sheet->setCellValue('B' . $row, $set['tacgia']);
			$sheet->setCellValue('C' . $row, $set['email']);
			$sheet->setCellValue('D' . $row, $set['chude']);
			$sheet->setCellValue('E' . $row, $set['noidung']);
			$sheet->setCellValue('F' . $row, $set['trangthai']);
			$sheet->setCellValue('G' . $row, $set['ngaygui']);
			$row++;
		}

		// //Cách này thì lại không hiển thị ra Save As
		// // Tạo một đối tượng Writer mới
		// $writer = new Xlsx($spreadsheet);

		// // Thiết lập header để trình duyệt hiển thị hộp thoại Save As
		// ob_start();
		// $filename1 = "productData.xlsx";
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="' . $filename1 . '"');
		// ob_end_clean();

		// // Xuất file Excel sang trình duyệt
		// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// $writer->save('php://output');


		// Cách này thì lại ra tại index.php
		// Tạo một đối tượng Writer mới để xuất dữ liệu ra file .xlsx
		$writer = new Xlsx($spreadsheet);
		$writer->save('contactData.xlsx');
	}
}
