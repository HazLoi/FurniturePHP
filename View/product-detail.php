<?php
$ac = 0;
if (isset($_GET['act'])) {
    if ($_GET['act'] == 'page') {
        $ac = 1;
    }
}

$comment = new comment();
$getAllCommentByProductId =  $comment->getCommentByProductId($_GET['maSP']);
$count =  $getAllCommentByProductId->rowCount();

$p = new page();
$limit = 5;
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<style>
    .star-rating {
        margin: 25px 0 0px;
        font-size: 0;
        white-space: nowrap;
        display: inline-block;
        width: 175px;
        height: 35px;
        overflow: hidden;
        position: relative;
        background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
        background-size: contain;
    }

    .star-rating i {
        opacity: 0;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 20%;
        z-index: 1;
        background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
        background-size: contain;
    }

    .star-rating input {
        /* -moz-appearance: none; */
        /* -webkit-appearance: none; */
        opacity: 0;
        display: inline-block;
        width: 20%;
        height: 100%;
        margin: 0;
        padding: 0;
        z-index: 2;
        position: relative;
    }

    .star-rating input:hover+i,
    .star-rating input:checked+i {
        opacity: 1;
    }

    .star-rating i~i {
        width: 40%;
    }

    .star-rating i~i~i {
        width: 60%;
    }

    .star-rating i~i~i~i {
        width: 80%;
    }

    .star-rating i~i~i~i~i {
        width: 100%;
    }
</style>
<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
    <div class="auto-container">
        <h2>Chi tiết sản phẩm</h2>
        <ul class="page-breadcrumb">
            <li><a href="index.php?action=home">home</a></li>
            <li>Chi tiết sản phẩm</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Shop Single Section-->
<section class="shop-single-section">
    <div class="auto-container">

        <div class="shop-single">
            <div class="product-details">

                <!--Basic Details-->
                <form action="index.php?action=cart-page&act=addToCart&maSP=<?php echo $maSP ?>" method="post">
                    <input type="hidden" name="maSP" id="" value="<?php echo $maSP ?>">
                    <input type="hidden" name="mausac" id="" value="<?php echo $mausac ?>">
                    <input type="hidden" name="kichthuoc" id="" value="<?php echo $kichthuoc ?>">
                    <div class="basic-details">
                        <div class="row clearfix">
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <figure class="image-box"><a href="assets/images/product/<?php echo $anh ?>" class="lightbox-image" title="Image Caption Here"><img src="assets/images/product/<?php echo $anh ?>" alt=""></a></figure>
                            </div>
                            <div class="info-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h4><?php echo $ten ?></h4>
                                    <div class="text"><?php echo $motangan ?></div>
                                    <div class="price">Đơn giá :
                                        <span>$<?php echo $dongia ?></span>
                                    </div>
                                    <!-- <div class="price">Màu sắc :
                                        <span><?php echo $mausac ?></span>
                                    </div>
                                    <div class="price">Kích thước :
                                        <span><?php echo $kichthuoc ?></span>
                                    </div> -->
                                    <?php
                                    if ($tonkho > 0) {
                                    ?>
                                        <div class="other-options clearfix">
                                            <div class="item-quantity"><label class="field-label">Số lượng :</label><input class="quantity-spinner bg-light" type="text" style="font-size: 22px" value="1" name="soluong"></div>
                                            <button class="theme-btn cart-btn">Thêm vào giỏ hàng</button>
                                        </div>
                                    <?php } else { ?>
                                        <a class="btn text-light p-3" style="font-size: 20px; background: #dfb162">Hết hàng</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Basic Details-->

                <!--Product Info Tabs-->
                <div class="product-info-tabs">
                    <!--Product Tabs-->
                    <div class="prod-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-details" class="tab-btn <?php if (empty($_GET['get']) && empty($_GET['act'])) echo 'active-btn' ?>">Mô tả sản phẩm</li>
                            <!-- <li data-tab="#prod-spec" class="tab-btn">Specification</li> -->
                            <li data-tab="#prod-reviews" class="tab-btn <?php if (($_GET['get'] == 'comment') || ($_GET['act'] == 'page')) echo 'active-btn' ?>">Bình luận (<?php $comment = new comment();
                                                                                                                                                                            $quantityComment = $comment->getQtyCommentByProductId($maSP);
                                                                                                                                                                            echo $quantityComment['soluong'] ?>)</li>
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">

                            <!--Tab / Active Tab-->
                            <div class="tab <?php if (empty($_GET['get']) && empty($_GET['act'])) echo 'active-tab' ?>" id="prod-details">
                                <div class="content">
                                    <p><?php echo $mota ?></p>
                                </div>
                            </div>

                            <!--Tab-->
                            <!-- <div class="tab" id="prod-spec">
                                <div class="content">
                                    <p><?php echo $mota ?></p>
                                </div>
                            </div> -->

                            <!--Tab-->
                            <div class="tab <?php if ((isset($_GET['get']) && $_GET['get'] == 'comment') || (isset($_GET['act']) && $_GET['act'] == 'page')) echo 'active-tab' ?>" id="prod-reviews">
                                <h2 class="title">Có <?php $comment = new comment();
                                                        echo $comment->getCommentByProductId($maSP)->rowCount(); ?> bình luận về sản phẩm</h2>
                                <!--Reviews Container-->
                                <div class="comments-area">
                                    <div class="d-flex justify-content-end">
                                        <?php if (empty($_GET['act']) || isset($_GET['act']) && $_GET['act'] == 'page') { ?>
                                            <div class="shop-pagination">
                                                <ul class="clearfix">
                                                    <?php
                                                    if ($currentPage > 1 && $page > 1) :
                                                    ?>
                                                        <li class="first"><a href="index.php?action=product-detail&act=page&page=1&maSP=<?= $maSP ?>"><i class="fa fa-angle-double-left"></i></a></li>
                                                        <li class="prev"><a href="index.php?action=product-detail&act=page&page=<?php echo $currentPage - 1 ?>&maSP=<?= $maSP ?>"><i class="fa fa-angle-left"></i></a></li>
                                                    <?php endif; ?>

                                                    <?php if ($page > 1) { ?>
                                                        <li class="active"><a href=""><?php echo $currentPage ?></a></li>
                                                    <?php } ?>

                                                    <?php if ($currentPage < $page && $page > 1) : ?>
                                                        <li class="next"><a href="index.php?action=product-detail&act=page&page=<?php echo $currentPage + 1 ?>&maSP=<?= $maSP ?>"><i class="fa fa-angle-right"></i></a></li>
                                                        <li class="last"><a href="index.php?action=product-detail&act=page&page=<?php echo $page ?>&maSP=<?= $maSP ?>"><i class="fa fa-angle-double-right"></i></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php } else { ?>

                                        <?php } ?>
                                    </div>
                                    <!--Comment Box-->
                                    <?php
                                    $comment = new comment();
                                    $result = $comment->getCommentByProductIdOnePage($maSP, $start, $limit);
                                    while ($get = $result->fetch()) {
                                    ?>
                                        <div class="comment-box">
                                            <div class="comment">
                                                <div class="author-thumb">
                                                    <!-- <img src="assets/images/resource/author-1.jpg" alt=""> -->
                                                </div>
                                                <div class="comment-inner">
                                                    <div class="comment-info clearfix">
                                                        <?php
                                                        $dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                                                        $dateNowFix = $dateNow->format('d/m/Y');
                                                        $dateComment = new DateTime($get['ngay'], new DateTimeZone('Asia/Ho_Chi_Minh'));
                                                        $dateCommentFix = $dateComment->format("d/m/Y");
                                                        //Tính khoảng cách giữa ngày hiện tại và ngày viết bình luận sản phẩm
                                                        $diff = $dateNow->diff($dateComment);
                                                        $days = $diff->days;
                                                        if ($days == 0) {
                                                            $h = $diff->h;
                                                            $m = $diff->i;
                                                            if ($h == 0) {
                                                                if ($m == 0) {
                                                                    $dateShow = '1 phút trước';
                                                                } else {
                                                                    $dateShow = $m . ' phút trước';
                                                                }
                                                            } else {
                                                                $dateShow = $h . ' giờ ' . $m . ' phút trước';
                                                            }
                                                        } else if ($days > 0 && $days < 30) {
                                                            $dateShow = $days . ' ngày trước';
                                                        } else if ($days >= 30 && $days < 365) {
                                                            $days = floor($days / 30);
                                                            $dateShow = $days . ' tháng trước';
                                                        } else if ($days >= 365) {
                                                            $days = floor($days / 365);
                                                            $dateShow = $days . ' năm trước';
                                                        }
                                                        echo $get['tacgia'] . " - " . $dateCommentFix . " - " . $dateShow;
                                                        ?>
                                                    </div>
                                                    <div class="rating">
                                                        <?php for ($i = 0; $i < $get['danhgia']; $i++) { ?>
                                                            <span class="fa fa-star"></span>
                                                        <?php  } ?>
                                                    </div>
                                                    <div class="text"><?php echo $get['binhluan'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <!-- Comment Form -->
                                <?php if (isset($_SESSION['idCustomer'])) { ?>
                                    <div class="shop-comment-form">
                                        <h2>Thêm bình luận của bạn</h2>
                                        <form method="post" action="index.php?action=product-detail&maSP=<?php echo $maSP ?>&get=comment">
                                            <div class="rating-box">
                                                <div class="text"> Đánh giá:</div>
                                                <span class="star-rating">
                                                    <input type="radio" name="rating" value="1"><i></i>
                                                    <input type="radio" name="rating" value="2"><i></i>
                                                    <input type="radio" name="rating" value="3"><i></i>
                                                    <input type="radio" name="rating" value="4"><i></i>
                                                    <input type="radio" name="rating" value="5"><i></i>
                                                </span><br>
                                                <span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "comment") echo $_SESSION['ratingErrorComment']; ?></span>
                                            </div>

                                            <div class="row clearfix">
                                                <input type="hidden" name="fname" id="" value="<?= $_SESSION['fname'] ?>">
                                                <input type="hidden" name="lname" id="" value="<?= $_SESSION['lname'] ?>">
                                                <input type="hidden" name="email" id="" value="<?= $_SESSION['email'] ?>">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label>Nội dung <sup class="text-danger">*</sup></label>
                                                    <textarea name="content" placeholder="Nội dung"><?php if (isset($_GET['get']) && $_GET['get'] == 'comment') echo $_POST['fname']; ?></textarea>
                                                    <span class="error text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "comment") echo $_SESSION['contentErrorComment']; ?></span>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <button class="theme-btn btn-style-four" type="submit" name="submit-form"><span class="txt">Submit now</span></button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                <?php } else {  ?>
                                    <div class="shop-comment-form">
                                        <h2>Thêm bình luận của bạn</h2>
                                        <form method="post" action="index.php?action=product-detail&maSP=<?php $maSP ?>&get=comment">
                                            <div class="rating-box">
                                                <div class="text"> Đánh giá:</div>
                                                <span class="star-rating">
                                                    <input type="radio" name="rating" value="1"><i></i>
                                                    <input type="radio" name="rating" value="2"><i></i>
                                                    <input type="radio" name="rating" value="3"><i></i>
                                                    <input type="radio" name="rating" value="4"><i></i>
                                                    <input type="radio" name="rating" value="5"><i></i>
                                                </span>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label>Họ <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="fname" placeholder="Họ" value="">
                                                </div>

                                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                                    <label>Tên <sup class="text-danger">*</sup></label>
                                                    <input type="email" name="lname" placeholder="Tên" value="">
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label>Email <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="email" placeholder="Email" value="">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <label>Nội dung <sup class="text-danger">*</sup></label>
                                                    <textarea name="content" placeholder="Nội dung"></textarea>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                    <button class="theme-btn btn-style-four" type="submit" name="submit-form"><span class="txt">Submit now</span></button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Product Info Tabs-->
            </div>
        </div>
    </div>
</section>
<!--End Shop Single Section-->

<!-- Related Products -->
<section class="related-products">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="title-box">
            <h2>Sản phẩm khác</h2>
        </div>

        <div class="row clearfix">

            <?php
            $sp = new product();
            $result = $sp->relatedProducts($loai, $_GET['maSP']);
            while ($get = $result->fetch()) {
            ?>
                <div class="shop-item col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img src="assets/images/product/<?php echo $get['anh'] ?>" alt="" /></a>
                            <div class="overlay-box">
                                <ul class="option-box">
                                    <li><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><span class="far fa-heart"></span></a></li>
                                    <li><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><span class="fa fa-shopping-bag"></span></a></li>
                                    <li><a href="assets/images/product/<?php echo $get['anh'] ?>" class="lightbox-image" data-fancybox="products"><span class="fa fa-search"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="lower-content">
                            <h3><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><?php echo $get['ten'] ?></a></h3>
                            <div class="price">$<?php echo $get['dongia'] ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</section>