-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 15, 2023 lúc 09:16 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `furniture`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `maAdmin` int(11) NOT NULL,
  `ho` varchar(20) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `hovaten` varchar(100) NOT NULL,
  `gioitinh` varchar(5) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `tendn` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `maQuyen` int(1) NOT NULL,
  `ngaysinh` date NOT NULL,
  `diachi` text NOT NULL,
  `zip` int(6) NOT NULL,
  `ngaytao` date NOT NULL,
  `ngaysua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `maBL` int(11) NOT NULL,
  `maSP` int(10) NOT NULL,
  `tacgia` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `binhluan` text NOT NULL,
  `ngay` datetime NOT NULL,
  `danhgia` int(1) NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `binh_luan`
--

INSERT INTO `binh_luan` (`maBL`, `maSP`, `tacgia`, `email`, `binhluan`, `ngay`, `danhgia`, `trangthai`) VALUES
(88, 5, 'Lợi Lý', 'admin@gmail.com', 'test 1', '2000-05-05 14:50:34', 1, 1),
(89, 5, 'Lợi Lý', 'admin@gmail.com', 'test 2', '2022-05-08 14:52:07', 2, 1),
(90, 5, 'Lợi Lý', 'admin@gmail.com', 'test 3', '2023-05-02 14:57:03', 3, 1),
(91, 6, 'Lợi Lý', 'otakushi01@gmail.com', '123', '2021-05-06 16:29:15', 3, 1),
(92, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 1, 1),
(98, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 2, 1),
(103, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 3, 1),
(104, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 4, 1),
(105, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 5, 1),
(106, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 4, 0),
(107, 2, 'Lợi Lý', 'otakushi01@gmail.com', 'bình luận', '2023-05-06 16:31:12', 5, 0),
(108, 76, 'Lợi Lý', 'admin@gmail.com', 'Vip\r\n', '2023-05-13 15:47:58', 5, 1);

--
-- Bẫy `binh_luan`
--
DELIMITER $$
CREATE TRIGGER `autoUpdateRatingCTSP` AFTER INSERT ON `binh_luan` FOR EACH ROW BEGIN
  UPDATE sanpham
  SET danhgia = CEILING((SELECT AVG(danhgia) FROM binh_luan WHERE maSP = new.maSP))
  WHERE maSP = new.maSP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ct_hoadon`
--

CREATE TABLE `ct_hoadon` (
  `maHD` int(11) NOT NULL,
  `maSP` int(10) NOT NULL,
  `tenSP` varchar(50) NOT NULL,
  `soluongmua` varchar(50) NOT NULL,
  `mausac` varchar(50) NOT NULL,
  `kichthuoc` varchar(50) NOT NULL,
  `dongia` float NOT NULL,
  `thanhtien` float NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `ct_hoadon`
--

INSERT INTO `ct_hoadon` (`maHD`, `maSP`, `tenSP`, `soluongmua`, `mausac`, `kichthuoc`, `dongia`, `thanhtien`, `trangthai`) VALUES
(147, 3, 'Mona Linen-Look Fabric Sofa - Blue', '3', '', '', 60, 180, 1),
(149, 3, 'Mona Linen-Look Fabric Sofa - Blue', '5', '', '', 60, 300, 1),
(156, 3, 'Mona Linen-Look Fabric Sofa - Blue', '3', '', '', 60, 180, 1),
(157, 3, 'Mona Linen-Look Fabric Sofa - Blue', '1', '', '', 60, 60, 1),
(157, 4, 'Mona Linen-Look Fabric Sofa - Dark Grey', '1', '', '', 60, 60, 1),
(157, 5, 'Merrigan Linen-Look Fabric Sofa - Taupe', '1', '', '', 60, 60, 1),
(157, 6, 'Merrigan Linen-Look Fabric Sofa - Grey', '1', '', '', 60, 60, 1),
(157, 7, 'Merrigan Linen-Look Fabric Sofa - Blue', '1', '', '', 40, 40, 1),
(157, 8, 'Booker Velvet Sofa - Green', '1', '', '', 50, 50, 1),
(157, 9, 'Booker Velvet Sofa - Blue', '1', '', '', 50, 50, 1),
(158, 23, 'Graz Dining Table', '3', '', '', 60, 180, 1),
(159, 5, 'Merrigan Linen-Look Fabric Sofa - Taupe', '1', '', '', 60, 60, 1),
(160, 5, 'Merrigan Linen-Look Fabric Sofa - Taupe', '10', '', '', 60, 600, 1);

--
-- Bẫy `ct_hoadon`
--
DELIMITER $$
CREATE TRIGGER `autoUpdateQtyProduct` AFTER INSERT ON `ct_hoadon` FOR EACH ROW BEGIN
	UPDATE sanpham SET daban = daban + new.soluongmua, tonkho = tonkho - new.soluongmua WHERE maSP = new.maSP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dich_vu`
--

CREATE TABLE `dich_vu` (
  `idService` int(11) NOT NULL,
  `image` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `des` text NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dich_vu`
--

INSERT INTO `dich_vu` (`idService`, `image`, `name`, `des`, `trangthai`) VALUES
(1, 'service-1.jpg', 'Nội thất nhà ở', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(2, 'service-2.jpg', 'Nội thất thương mại', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(3, 'service-3.jpg', 'Nội thất văn phòng', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(4, 'service-11.jpg', 'Thiết kế khách sạn', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(5, 'service-12.jpg', 'Nội thất hiện đại', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(6, 'service-13.jpg', 'Nhà bếp kiểu mô-đun (Module)', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(7, 'service-14.jpg', 'Wordrobe', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1),
(8, 'service-15.jpg', 'False Celling Design', 'Override the digital divide with additional clickthroughs from DevOps. Nanotech Nology imme rsion along the information highway will close the loop.', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `email_dktruoc`
--

CREATE TABLE `email_dktruoc` (
  `maDKTruoc` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ngaydk` date NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `email_dktruoc`
--

INSERT INTO `email_dktruoc` (`maDKTruoc`, `email`, `ngaydk`, `trangthai`) VALUES
(3, 'otakushi01@gmail.com', '2023-05-12', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `maHD` int(11) NOT NULL,
  `maKH` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `tongtien` float NOT NULL,
  `tinhtrang` varchar(100) NOT NULL,
  `ngaycapnhat` date NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`maHD`, `maKH`, `ngay`, `tongtien`, `tinhtrang`, `ngaycapnhat`, `trangthai`) VALUES
(147, 36, '2023-05-06', 180, 'Chưa thanh toán', '0000-00-00', 1),
(149, 36, '2023-05-11', 300, 'Chưa thanh toán', '0000-00-00', 1),
(156, 36, '2023-05-11', 180, 'Chưa thanh toán', '0000-00-00', 1),
(157, 36, '2023-05-11', 380, 'Chưa thanh toán', '0000-00-00', 1),
(158, 36, '2023-05-11', 180, 'Chưa thanh toán', '0000-00-00', 1),
(159, 36, '2023-05-11', 60, 'Chưa thanh toán', '0000-00-00', 1),
(160, 36, '2023-05-11', 600, 'Chưa thanh toán', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `maLH` int(11) NOT NULL,
  `tacgia` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `chude` text NOT NULL,
  `noidung` text NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1,
  `ngaygui` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`maLH`, `tacgia`, `email`, `chude`, `noidung`, `trangthai`, `ngaygui`) VALUES
(1, 'Lợi Lý', 'lyducloi@gmail.com', 'a', 'hihi', 0, '0000-00-00'),
(2, 'Lợi Lý', 'lyducloi@gmail.com', 'b', 'Test 1', 0, '0000-00-00'),
(3, 'Lợi Lý', 'lyducloi@gmail.com', 'c', 'Test 2', 0, '0000-00-00'),
(4, 'Lợi Lý', 'lyducloi@gmail.com', 'a', 'Test 3', 1, '0000-00-00'),
(5, 'Lợi Lý', 'lyducloi123@gmail.com', 'a', 'Test 4', 1, '0000-00-00'),
(6, 'Lợi Lý', 'lyducloi1@gmail.com', 'b', 'Test 5', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sanpham`
--

CREATE TABLE `loai_sanpham` (
  `maLoai` int(11) NOT NULL,
  `tenloai` varchar(20) NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loai_sanpham`
--

INSERT INTO `loai_sanpham` (`maLoai`, `tenloai`, `trangthai`) VALUES
(1, 'LivingRoom', 1),
(2, 'Kitchen', 1),
(3, 'DiningRoom', 1),
(91, 'Test', 1),
(94, 'test', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `maKH` int(11) NOT NULL,
  `ho` varchar(20) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `hovaten` varchar(100) NOT NULL,
  `gioitinh` varchar(5) NOT NULL,
  `sdt` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `maQuyen` int(1) NOT NULL,
  `ngaysinh` date NOT NULL,
  `diachi` text NOT NULL,
  `zip` int(6) NOT NULL,
  `ngaydk` date NOT NULL,
  `ngaycapnhat` date NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1,
  `anh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`maKH`, `ho`, `ten`, `hovaten`, `gioitinh`, `sdt`, `email`, `matkhau`, `maQuyen`, `ngaysinh`, `diachi`, `zip`, `ngaydk`, `ngaycapnhat`, `trangthai`, `anh`) VALUES
(1, 'Lý', 'Lợi', 'Lợi Lý', 'Nam', '09123193857', 'lyducloi@gmail.com', 'fe51642f21c511b1094400923451ca68', 0, '2023-05-03', 'TPHCM', 700000, '0000-00-00', '2023-05-11', 1, ''),
(36, 'Lý', 'Lợi', 'Admin', 'Nam', '0987654321', 'admin@gmail.com', '949e3dfbcfcd234ae884f6117867e9c2', 1, '2003-01-01', 'Tp.HCM', 700000, '0000-00-00', '2023-05-11', 1, ''),
(41, 'Lý', 'Lợi', 'Lợi Lý', 'Nam', '09123193857', 'lyducloi2@gmail.com', 'fe51642f21c511b1094400923451ca68', 2, '2023-05-02', 'Tp.HCM', 700000, '0000-00-00', '0000-00-00', 1, ''),
(42, 'Lý', 'Lợi', 'Lợi Lý', 'Khác', '09123193857', 'lyducloi3@gmail.com', 'fe51642f21c511b1094400923451ca68', 3, '0000-00-00', '', 0, '0000-00-00', '0000-00-00', 1, ''),
(43, 'Lý', 'Lợi', 'Lợi Lý', 'Khác', '09123193857', 'lyducloi4@gmail.com', 'fe51642f21c511b1094400923451ca68', 4, '0000-00-00', '', 0, '0000-00-00', '0000-00-00', 1, ''),
(44, 'Lý', 'Lợi', 'Lợi Lý', 'Khác', '09123193857', 'lyducloi5@gmail.com', 'fe51642f21c511b1094400923451ca68', 5, '0000-00-00', '', 0, '0000-00-00', '0000-00-00', 1, ''),
(45, 'Lý', 'Lợi', 'Lợi Lý', 'Khác', '09123193857', 'lyducloi6@gmail.com', 'fe51642f21c511b1094400923451ca68', 6, '0000-00-00', '', 0, '0000-00-00', '0000-00-00', 0, ''),
(52, 'Lý', 'Anh', 'Anh Lý', '', '0987485376', 'lyducanh@gmail.com', 'fe51642f21c511b1094400923451ca68', 4, '0000-00-00', '', 0, '2023-05-15', '0000-00-00', 1, ''),
(53, 'Lý', 'Bạch', 'Lý Tiểu Bạch', 'Nam', '0987654321', 'tieubach@gmail.com', 'a37b1df20c16b0d30b4cfd8af6df9e68', 1, '1111-11-11', 'TPHCM', 700000, '2023-05-15', '2023-05-15', 1, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_quyen`
--

CREATE TABLE `phan_quyen` (
  `maQuyen` int(11) NOT NULL,
  `quyen` varchar(50) NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phan_quyen`
--

INSERT INTO `phan_quyen` (`maQuyen`, `quyen`, `trangthai`) VALUES
(0, 'Người dùng', 1),
(1, 'Admin', 1),
(2, 'Xem thông tin', 1),
(3, 'Thêm/xóa/sửa', 1),
(4, 'Thêm thông tin', 1),
(5, 'Xóa thông tin', 1),
(6, 'Sửa thông tin', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `maSP` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `loai` varchar(20) NOT NULL,
  `anh` varchar(150) NOT NULL,
  `dongia` float NOT NULL,
  `giamgia` float NOT NULL,
  `motangan` text NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem',
  `mota` text NOT NULL,
  `mausac` varchar(20) NOT NULL,
  `kichthuoc` varchar(3) NOT NULL,
  `tonkho` varchar(10) NOT NULL,
  `daban` varchar(10) NOT NULL,
  `danhgia` int(1) NOT NULL,
  `yeuthich` varchar(10) NOT NULL,
  `ngaythem` date NOT NULL,
  `ngaycapnhat` date NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`maSP`, `ten`, `loai`, `anh`, `dongia`, `giamgia`, `motangan`, `mota`, `mausac`, `kichthuoc`, `tonkho`, `daban`, `danhgia`, `yeuthich`, `ngaythem`, `ngaycapnhat`, `trangthai`) VALUES
(2, 'Mona Linen-Look Fabric Sofa - Light Grey', '1', 'sofa1.jpg', 200, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem\n', 'blue', 'M', '0', '1', 3, '125', '2023-05-05', '0000-00-00', 1),
(3, 'Mona Linen-Look Fabric Sofa - Blue', '1', 'sofa2.jpg', 210, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '1', '31', 4, '111', '2023-05-05', '0000-00-00', 1),
(4, 'Mona Linen-Look Fabric Sofa - Dark Grey', '1', 'sofa3.jpg', 200, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '50', '7', 3, '123', '2023-05-05', '0000-00-00', 1),
(5, 'Merrigan Linen-Look Fabric Sofa - Taupe', '1', 'sofa4.jpg', 190, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'green', 'M', '588', '12', 2, '412', '2023-05-05', '0000-00-00', 1),
(6, 'Merrigan Linen-Look Fabric Sofa - Grey', '1', 'sofa5.jpg', 130, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'brown', 'L', '40', '2', 3, '134', '2023-05-05', '0000-00-00', 1),
(7, 'Merrigan Linen-Look Fabric Sofa - Blue', '1', 'sofa6.jpg', 200, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'red', 'XL', '40', '1', 4, '313', '2023-05-05', '0000-00-00', 1),
(8, 'Booker Velvet Sofa - Green', '1', 'sofa7.jpg', 230, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'blue', 'M', '599', '1', 5, '523', '2023-05-05', '0000-00-00', 1),
(9, 'Booker Velvet Sofa - Blue', '1', 'sofa8.jpg', 220, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '599', '1', 5, '344', '2023-05-05', '0000-00-00', 1),
(10, 'Booker Velvet Sofa - Dark Grey', '1', 'sofa9.jpg', 100, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '600', '0', 5, '3452', '0000-00-00', '0000-00-00', 1),
(11, 'Caledon Linen-Look Futon - Steel', '1', 'sofa10.jpg', 120, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'green', 'M', '599', '1', 3, '234', '0000-00-00', '0000-00-00', 1),
(12, 'Mothel Leather-Look Fabric Power Reclining Loveseat with Console - Black', '1', 'loveseats01.jpg', 150, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'brown', 'L', '600', '0', 3, '1233', '0000-00-00', '0000-00-00', 1),
(13, 'Mothel Leather-Look Fabric Power Reclining Loveseat - Black', '1', 'loveseats02.jpg', 190, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'red', 'XL', '600', '0', 3, '344', '0000-00-00', '0000-00-00', 1),
(14, 'Ariss Chenille Reclining Loveseat - Grey', '1', 'loveseats03.jpg', 300, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'blue', 'M', '597', '3', 4, '456', '0000-00-00', '0000-00-00', 1),
(15, 'Greycliff Chenille Loveseat - Charcoal', '1', 'loveseats04.jpg', 400, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '600', '0', 4, '234', '0000-00-00', '0000-00-00', 1),
(16, 'Greycliff Chenille Loveseat - Platinum', '1', 'loveseats05.jpg', 310, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '600', '0', 4, '1346', '0000-00-00', '0000-00-00', 1),
(17, 'Greycliff Chenille Loveseat - Toffee', '1', 'loveseats06.jpg', 320, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'green', 'M', '600', '0', 5, '145', '0000-00-00', '0000-00-00', 1),
(18, 'Sandford Genuine Leather Power Reclining Loveseat - Black', '1', 'loveseats07.jpg', 100, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'brown', 'L', '600', '0', 5, '7544', '0000-00-00', '0000-00-00', 1),
(19, 'Ballenas Linen-Look Fabric Loveseat - Charcoal Grey', '1', 'loveseats08.jpg', 140, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'red', 'XL', '600', '0', 5, '2345', '0000-00-00', '0000-00-00', 1),
(20, 'Hohen Genuine Leather Power Reclining Loveseat with Power Headrest - Charcoal', '1', 'loveseats09.jpg', 160, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'blue', 'M', '600', '0', 3, '234', '0000-00-00', '0000-00-00', 1),
(21, 'Hohen Chenille Power Reclining Loveseat with Power Headrest - Muslin', '1', 'loveseats10.jpg', 190, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '595', '5', 3, '134', '0000-00-00', '0000-00-00', 1),
(22, 'Masail Dining Table', '3', 'diningtable01.jpg', 180, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '600', '0', 3, '156', '0000-00-00', '0000-00-00', 1),
(23, 'Graz Dining Table', '3', 'diningtable02.jpg', 70, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'green', 'M', '597', '3', 4, '1357', '0000-00-00', '0000-00-00', 1),
(24, 'Sorlyn Dining Table - Glass', '3', 'diningtable03.jpg', 80, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'brown', 'L', '600', '0', 4, '6234', '0000-00-00', '0000-00-00', 1),
(25, 'Graham Dining Table', '3', 'diningtable04.jpg', 86, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'red', 'XL', '600', '0', 4, '64537', '0000-00-00', '0000-00-00', 1),
(26, 'Silvermoon Counter-Height Dining Table', '3', 'diningtable05.jpg', 74, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'blue', 'M', '600', '0', 5, '3467', '0000-00-00', '0000-00-00', 1),
(27, 'Greyson Counter-Height Dining Table', '3', 'diningtable06.jpg', 60, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '600', '0', 5, '243', '0000-00-00', '0000-00-00', 1),
(28, 'Zuchelli Dining Table', '3', 'diningtable07.jpg', 80, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '600', '0', 5, '1234', '0000-00-00', '0000-00-00', 1),
(29, 'Coventry Counter-Height Dining Table - Walnut', '3', 'diningtable08.jpg', 86, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'green', 'M', '600', '0', 3, '257', '0000-00-00', '0000-00-00', 1),
(30, 'Evant Round Drop-Leaf Dining Table - White', '3', 'diningtable09.jpg', 100, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'brown', 'L', '600', '0', 3, '256', '0000-00-00', '0000-00-00', 1),
(31, 'Evant Dining Table - White', '3', 'diningtable10.jpg', 120, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'red', 'XL', '600', '0', 3, '1234', '0000-00-00', '0000-00-00', 1),
(32, 'Café 6.2 Cu. Ft. Smart Commercial-Style 6-Burner Gas Range - CGY366P4TW2', '2', 'ranges01.jpg', 1345, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'blue', 'M', '600', '0', 4, '245', '0000-00-00', '0000-00-00', 1),
(33, 'Café 6.2 Cu. Ft. Smart Commercial-Style 6-Burner Gas Range - CGY366P3TD1', '2', 'ranges02.jpg', 2304, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '600', '0', 4, '12345', '0000-00-00', '0000-00-00', 1),
(34, 'Café 5.75 Cu. Ft. Commercial-Style 6-Burner Dual Fuel Range - C2Y366P4TW2', '2', 'ranges03.jpg', 1334, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '600', '0', 4, '56', '0000-00-00', '0000-00-00', 1),
(35, 'Café 5.75 Cu. Ft. Commercial-Style 6-Burner Dual Fuel Range - C2Y366P3TD1', '2', 'ranges04.jpg', 2198, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'green', 'M', '600', '0', 5, '7356', '0000-00-00', '0000-00-00', 1),
(36, 'Café 5.75 Cu. Ft. Commercial-Style 6-Burner Dual Fuel Range - C2Y366P2TS1', '2', 'ranges05.jpg', 2345, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'brown', 'L', '600', '0', 5, '342', '0000-00-00', '0000-00-00', 1),
(37, 'Café 6.7 Cu. Ft. Smart Front-Control Double Oven Electric Range - CES750P4MW2', '2', 'ranges06.jpg', 4385, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'red', 'XL', '600', '0', 5, '2134', '0000-00-00', '0000-00-00', 1),
(38, 'Café Slide-In Electric Range with Warming Drawer - CCHS900P4MW2', '2', 'ranges07.jpg', 4376, 20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'blue', 'M', '600', '0', 3, '234', '0000-00-00', '0000-00-00', 1),
(39, 'Café Slide-In Gas Range with Convection - CCGS700P4MW2', '2', 'ranges08.jpg', 1245, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'yellow', 'L', '600', '0', 4, '345', '0000-00-00', '0000-00-00', 1),
(40, 'Café 30\" Slide-In Dual-Fuel Convection Range - CC2S900P4MW2', '2', 'ranges09.jpg', 2134, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', 'pink', 'XL', '600', '0', 5, '2346', '0000-00-00', '0000-00-00', 1),
(41, 'Café Slide-In Gas Range with Convection - CCGS700P2MS1', '2', 'ranges10.jpg', 5432, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', '<p style=\"text-align: center;\"><em><strong><img src=\"assets/images/product/cuncon.png\" alt=\"\" width=\"300\" height=\"225\"></strong></em></p>\r\n<p style=\"text-align: center;\"><em><strong>Sản&nbsp;phẩm đang được b&aacute;n chạy nhất thị trường hiện nay</strong></em></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem</p>', 'pink', 'XL', '1', '1', 5, '2346', '0000-00-00', '2023-05-13', 1),
(45, 'test', '1', 'test.jpg', 10000, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tem', '1', '', '', '1', '1', 1, '1', '0000-00-00', '0000-00-00', 0),
(72, 'sản phẩm 1', '2', 'haha.jpg', 30, 0, 'Đây là sản phẩm thử nghiệm', 'Úy tín, chất lượng, sản phẩm được tin dùng hàng đầu số 1 Việt Nam', '', '', '1', '', 0, '', '2023-05-13', '0000-00-00', 0),
(73, 'sản phẩm 2', '2', 'haha.jpg', 30, 0, 'Đây là sản phẩm thử nghiệm', 'Úy tín, chất lượng, sản phẩm được tin dùng hàng đầu số 1 Việt Nam', '', '', '1', '', 0, '', '2023-05-13', '0000-00-00', 0),
(74, 'sản phẩm 3', '2', 'haha.jpg', 30, 0, 'Đây là sản phẩm thử nghiệm', 'Úy tín, chất lượng, sản phẩm được tin dùng hàng đầu số 1 Việt Nam', '', '', '1', '', 0, '', '2023-05-13', '0000-00-00', 1),
(75, 'sản phẩm 4', '2', 'haha.jpg', 30, 0, 'Đây là sản phẩm thử nghiệm', 'Úy tín, chất lượng, sản phẩm được tin dùng hàng đầu số 1 Việt Nam', '', '', '1', '', 0, '', '2023-05-13', '0000-00-00', 0),
(76, 'sản phẩm 5', '91', 'haha.jpg', 30, 0, 'Đây là sản phẩm thử nghiệm', '<p>&Uacute;y t&iacute;n, chất lượng, sản phẩm được tin d&ugrave;ng h&agrave;ng đầu số 1 Việt Nam</p>', '', '', '1', '', 5, '', '2023-05-13', '2023-05-13', 0),
(78, 'sản phẩm 6', '2', 'snphm6.png', 30, 0, '<p>Đ&acirc;y l&agrave; sản phẩm thử nghiệm</p>', '<p>&Uacute;y t&iacute;n, chất lượng, sản phẩm được tin d&ugrave;ng h&agrave;ng đầu số 1 Việt Nam</p>', '', '', '1', '', 0, '', '2023-05-15', '2023-05-15', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanh_toan`
--

CREATE TABLE `thanh_toan` (
  `maTT` int(11) NOT NULL,
  `maHD` int(11) NOT NULL,
  `maKH` int(10) NOT NULL,
  `tenKH` varchar(80) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `congty` text NOT NULL,
  `diachi1` text NOT NULL,
  `diachi2` text NOT NULL,
  `tinh/thanhpho` varchar(20) NOT NULL,
  `zip` varchar(6) NOT NULL,
  `ngay` date NOT NULL,
  `tongtien` float NOT NULL,
  `ghichu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tin_tuc`
--

CREATE TABLE `tin_tuc` (
  `maTT` int(11) NOT NULL,
  `tenTT` text NOT NULL,
  `anh` varchar(100) NOT NULL,
  `ngay` date NOT NULL,
  `noidung` text NOT NULL,
  `chitiet` text NOT NULL,
  `tinhtrang` int(50) NOT NULL,
  `ngaythem` date NOT NULL,
  `ngaycapnhat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tin_tuc`
--

INSERT INTO `tin_tuc` (`maTT`, `tenTT`, `anh`, `ngay`, `noidung`, `chitiet`, `tinhtrang`, `ngaythem`, `ngaycapnhat`) VALUES
(1, 'Cách tự làm nội thất nhà đẹp nhất', 's4zDiWqi.jpg', '2023-04-29', '<p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.</p>', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 0, '0000-00-00', '2023-05-13'),
(2, 'Cách tự làm nội thất nhà đẹp nhất', 'news-10.jpg', '2023-05-01', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 0, '0000-00-00', '2023-05-13'),
(10, 'Cách tự làm nội thất nhà đẹp nhất', 'news-11.jpg', '2023-05-02', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, '0000-00-00', '2023-05-13'),
(11, 'Cách tự làm nội thất nhà đẹp nhất', 'news-12.jpg', '2023-05-03', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, '0000-00-00', '2023-05-13'),
(12, 'Cách tự làm nội thất nhà đẹp nhất', 'news-13.jpg', '2023-05-04', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, '0000-00-00', '2023-05-13'),
(13, 'Cách tự làm nội thất nhà đẹp nhất', 'news-14.jpg', '2023-05-05', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, '0000-00-00', '2023-05-13'),
(16, 'Cách tự làm nội thất nhà đẹp nhất', 'news-15.jpg', '2023-05-05', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, '0000-00-00', '2023-05-13'),
(17, 'Cách tự làm nội thất nhà đẹp nhất', 'news-16.jpg', '2023-05-05', 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. dolore magna aliqua. Ut enim ad minim veniam.', '<h3>How to make best home interior ourself</h3>\r\n<div>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur velit esse cillum dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n<h4>Text Sample</h4>\r\n<div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n<div>\r\n<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est.</p>\r\n</div>\r\n</div>\r\n<p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat&nbsp;<a href=\"#\">here is link</a>&nbsp;cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</div>', 1, '0000-00-00', '2023-05-13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeu_thich`
--

CREATE TABLE `yeu_thich` (
  `maYT` int(11) NOT NULL,
  `maSP` int(11) NOT NULL,
  `maKH` int(11) NOT NULL,
  `ngay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `yeu_thich`
--

INSERT INTO `yeu_thich` (`maYT`, `maSP`, `maKH`, `ngay`) VALUES
(41, 3, 36, '2023-05-06'),
(42, 2, 1, '2023-05-11'),
(43, 6, 1, '2023-05-11');

--
-- Bẫy `yeu_thich`
--
DELIMITER $$
CREATE TRIGGER `autoDecreaseLike` BEFORE DELETE ON `yeu_thich` FOR EACH ROW BEGIN
	UPDATE sanpham SET yeuthich = yeuthich - 1 WHERE maSP = old.maSP;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `autoIncreaseLike` AFTER INSERT ON `yeu_thich` FOR EACH ROW BEGIN
	UPDATE sanpham SET yeuthich = yeuthich + 1 WHERE maSP = new.maSP;
END
$$
DELIMITER ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`maAdmin`);

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`maBL`),
  ADD KEY `fk_binhluan_sp` (`maSP`);

--
-- Chỉ mục cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD PRIMARY KEY (`maHD`,`maSP`,`mausac`,`kichthuoc`),
  ADD KEY `mahh` (`maSP`);

--
-- Chỉ mục cho bảng `dich_vu`
--
ALTER TABLE `dich_vu`
  ADD PRIMARY KEY (`idService`);

--
-- Chỉ mục cho bảng `email_dktruoc`
--
ALTER TABLE `email_dktruoc`
  ADD PRIMARY KEY (`maDKTruoc`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`maHD`),
  ADD KEY `fk_hoadon_user` (`maKH`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`maLH`);

--
-- Chỉ mục cho bảng `loai_sanpham`
--
ALTER TABLE `loai_sanpham`
  ADD PRIMARY KEY (`maLoai`);

--
-- Chỉ mục cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`maKH`);

--
-- Chỉ mục cho bảng `phan_quyen`
--
ALTER TABLE `phan_quyen`
  ADD PRIMARY KEY (`maQuyen`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`maSP`);

--
-- Chỉ mục cho bảng `thanh_toan`
--
ALTER TABLE `thanh_toan`
  ADD PRIMARY KEY (`maTT`);

--
-- Chỉ mục cho bảng `tin_tuc`
--
ALTER TABLE `tin_tuc`
  ADD PRIMARY KEY (`maTT`);

--
-- Chỉ mục cho bảng `yeu_thich`
--
ALTER TABLE `yeu_thich`
  ADD PRIMARY KEY (`maYT`),
  ADD KEY `fk_yeuthich_user` (`maKH`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `maAdmin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `maBL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT cho bảng `dich_vu`
--
ALTER TABLE `dich_vu`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `email_dktruoc`
--
ALTER TABLE `email_dktruoc`
  MODIFY `maDKTruoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `maHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `maLH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `loai_sanpham`
--
ALTER TABLE `loai_sanpham`
  MODIFY `maLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `maKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `phan_quyen`
--
ALTER TABLE `phan_quyen`
  MODIFY `maQuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `maSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `thanh_toan`
--
ALTER TABLE `thanh_toan`
  MODIFY `maTT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tin_tuc`
--
ALTER TABLE `tin_tuc`
  MODIFY `maTT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `yeu_thich`
--
ALTER TABLE `yeu_thich`
  MODIFY `maYT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `fk_binhluan_sp` FOREIGN KEY (`maSP`) REFERENCES `sanpham` (`maSP`);

--
-- Các ràng buộc cho bảng `ct_hoadon`
--
ALTER TABLE `ct_hoadon`
  ADD CONSTRAINT `fk_cthd_mahd` FOREIGN KEY (`maHD`) REFERENCES `hoa_don` (`maHD`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `fk_hoadon_user` FOREIGN KEY (`maKH`) REFERENCES `nguoi_dung` (`maKH`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `yeu_thich`
--
ALTER TABLE `yeu_thich`
  ADD CONSTRAINT `fk_yeuthich_user` FOREIGN KEY (`maKH`) REFERENCES `nguoi_dung` (`maKH`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
