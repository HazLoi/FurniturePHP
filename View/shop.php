<?php
$ac = 0;
if (isset($_GET['act'])) {
    if ($_GET['act'] == "search") {
        $ac = 1;
    }
    if ($_GET['act'] == "category") {
        $ac = 2;
    }
}

$product = new product();
$allProduct = $product->getAllProduct();
$count = $allProduct->rowCount();
$limit = 8;

$p = new page();
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<!--Shop Banner Section-->
<section class="shop-banner-section" style="background-image:url(assets/images/background/8.jpg);">
    <div class="auto-container">

        <!-- Content Box -->
        <div class="content-box">
            <div class="box-inner">
                <h2>Nội thất hiện đại</h2>
                <!-- <div class="text">Leverage agile frameworks to provide a robust synopsis for high level overviews.
                    Iterative approaches to corporate strategy foster collaborative.</div> -->
                <div class="text">Tận dụng các khuôn khổ linh hoạt để cung cấp một bản tóm tắt mạnh mẽ cho các tổng quan cấp cao. Các cách tiếp cận lặp đi lặp lại đối với chiến lược của công ty thúc đẩy sự hợp tác.</div>
                <!-- <a href="index.php?action=product-detail" class="theme-btn btn-style-one"><span class="txt">Mua ngay</span></a> -->
            </div>
        </div>

    </div>
</section>
<!--End Shop Banner Section-->

<!--Shop Features Section-->
<section class="shop-features-section">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Feature Block-->
            <div class="shop-feature-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="icon-box">
                        <span class="icon flaticon-delivery-truck"></span>
                    </div>
                    <h3><a href="index.php?action=404">Miến phí giao hàng</a></h3>
                    <div class="text">Duis aute irure dolor in reprehend erit in voluptate velit esse cillu.</div>
                </div>
            </div>

            <!--Feature Block-->
            <div class="shop-feature-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="icon-box">
                        <span class="icon flaticon-tag"></span>
                    </div>
                    <h3><a href="index.php?action=404">Giảm giá 15%</a></h3>
                    <div class="text">Duis aute irure dolor in reprehend erit in voluptate velit esse cillu.</div>
                </div>
            </div>

            <!--Feature Block-->
            <div class="shop-feature-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="icon-box">
                        <span class="icon flaticon-store-new-badges"></span>
                    </div>
                    <h3><a href="index.php?action=404">Mới nhất</a></h3>
                    <div class="text">Duis aute irure dolor in reprehend erit in voluptate velit esse cillu.</div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Shop Features Section-->

<!--Shop Section-->
<section class="shop-section">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="title-box">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                        <aside class="sidebar">

                            <!-- Search -->
                            <div class="sidebar-widget search-box">
                                <form method="post" action="index.php?action=shop&act=search">
                                    <div class="form-group">
                                        <input type="search" name="productSearch" placeholder="Tìm kiếm sản phẩm">
                                        <button><span class="icon fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <!--Blog Category Widget-->
                            <div class="sidebar-widget sidebar-blog-category">
                                <div class="sidebar-title">
                                    <h2>Loại sản phẩm</h2>
                                </div>
                                <ul class="cat-list">
                                    <?php
                                    $product = new product();
                                    $categories = $product->getAllCategory();
                                    while ($get = $categories->fetch()) :
                                        $tenloai = $get['tenloai'];
                                    ?>
                                        <li>
                                            <a class="
                                            <?php if (isset($_GET['category']) && $_GET['category'] == "$tenloai") echo "text-warning" ?>" href="index.php?action=shop&act=category&category=<?php echo $get['tenloai'] ?>">
                                                <?php echo $get['tenloai'] ?> - (<?php echo $get['tongSP'] ?>)
                                            </a>
                                        </li>
                                    <?php endwhile; ?>

                                </ul>
                            </div>

                            <!-- Popular Posts -->
                            <div class="sidebar-widget popular-posts">
                                <div class="sidebar-title">
                                    <h2>Tin tức mới nhất</h2>
                                </div>

                                <?php
                                $news = new news();
                                $result = $news->getNewsOnePage(0, 4);
                                while ($get = $result->fetch()) :
                                ?>
                                    <article class="post">
                                        <div class="post-thumb"><a href="index.php?action=blog-detail&id=<?= $get['maTT'] ?>"><img src="assets/images/resource/<?php echo $get['anh'] ?>" alt=""></a></div>
                                        <div class="text"><a href="index.php?action=blog-detail&id=<?= $get['maTT'] ?>"><?php echo $get['tenTT'] ?></a></div>
                                        <div class="post-info">
                                            <?php
                                            $date = new DateTime($get['ngay']);
                                            $dateFix = $date->format('d/m/Y');
                                            echo $dateFix;
                                            ?>
                                        </div>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12 product-container">
                        <div class="row clearfix">
                            <?php
                            $sp = new product();
                            if ($ac == 0) {
                                $result = $sp->getProductOnePage($start, $limit);
                            }
                            if ($ac == 1) {
                                $result = $sp->getProductForSearch(htmlspecialchars($_POST['productSearch'], ENT_QUOTES, 'UTF-8'));
                            }
                            if ($ac == 2) {
                                $result = $sp->getProductForCategory($_GET['category']);
                            }
                            while ($set = $result->fetch()) {

                            ?>
                                <!--Shop Item-->
                                <div class="shop-item col-lg-3 col-md-6 col-sm-12">
                                    <div class="inner-box" style="min-height: 300px">
                                        <div class="image">
                                            <a href="index.php?action=product-detail&maSP=<?php echo $set['maSP'] ?>">
                                                <img style="height: 150px;width: 100%" src="assets/images/product/<?php echo $set['anh'] ?>" alt="" />
                                            </a>
                                            <div class="overlay-box">
                                                <ul class="option-box">
                                                    <li><a href="index.php?action=shop&act=wishlist&maSP=<?= $set['maSP'] ?>"><i class="far fa-heart"></i></a></li>
                                                    <li>
                                                        <form action="index.php?action=cart-page&act=addToCart" method="post">
                                                            <input type="hidden" name="maSP" value="<?= $set['maSP'] ?>">
                                                            <input type="hidden" name="mausac" value="<?= $set['mausac'] ?>">
                                                            <input type="hidden" name="kichthuoc" value="<?= $set['kichthuoc'] ?>">
                                                            <input type="hidden" name="soluong" value="1">
                                                            <button id="btnAddToCartInShop">
                                                                <span class="fa fa-shopping-bag"></span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><a href="index.php?action=product-detail&maSP=<?php echo $set['maSP'] ?>"><span class="fa fa-search"></span></a></li>
                                                </ul>
                                            </div>
                                            <?php
                                            if ($set['loai'] == '1') :
                                            ?>
                                                <div class="tag-banner">New</div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="lower-content">
                                            <h3><a href="index.php?action=product-detail&maSP=<?php echo $set['maSP'] ?>"><?php echo $set['ten'] ?></a></h3>
                                            <div class="price">$<?php echo $set['dongia'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>


                        </div>

                        <?php if (empty($_GET['act']) || isset($_GET['act']) && $_GET['act'] == 'page') { ?>
                            <div class="shop-pagination">
                                <ul class="clearfix">
                                    <?php
                                    if ($currentPage > 1 && $page > 1) :
                                    ?>
                                        <li class="first"><a href="index.php?action=shop&act=page&page=1"><i class="fa fa-angle-double-left"></i></a></li>
                                        <li class="prev"><a href="index.php?action=shop&act=page&page=<?php echo $currentPage - 1 ?>"><i class="fa fa-angle-left"></i></a></li>
                                    <?php endif; ?>

                                    <li class="active"><a href=""><?php echo $currentPage ?></a></li>

                                    <?php if ($currentPage < $page && $page > 1) : ?>
                                        <li class="next"><a href="index.php?action=shop&act=page&page=<?php echo $currentPage + 1 ?>"><i class="fa fa-angle-right"></i></a></li>
                                        <li class="last"><a href="index.php?action=shop&act=page&page=<?php echo $page ?>"><i class="fa fa-angle-double-right"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php } else { ?>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Products Section-->
<!-- <section class="products-section">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="product-column col-lg-6 col-md-12 col-sm-12">
                <div class="row clearfix">
                    <div class="shop-item-two col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="index.php?action=product-detail"><img src="assets/images/resource/products/5.jpg" alt="" /></a>
                            </div>
                            <div class="lower-content">
                                <h3><a href="index.php?action=product-detail">COLD CREWNECK</a></h3>
                                <div class="price">$39.99</div>
                                <a href="index.php?action=product-detail" class="theme-btn cart-btn">Add to cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="shop-item-two col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <a href="index.php?action=product-detail"><img src="assets/images/resource/products/6.jpg" alt="" /></a>
                            </div>
                            <div class="lower-content">
                                <h3><a href="index.php?action=product-detail">MULTI-WAY ULTRA</a></h3>
                                <div class="price">$39.99</div>
                                <a href="index.php?action=product-detail" class="theme-btn cart-btn">Add to cart</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="content-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column">
                    <h2>Best products <span>for home</span></h2>
                    <div class="text">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed
                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. </div>
                    <a href="index.php?action=404" class="theme-btn btn-style-one"><span class="txt">View all products</span></a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--End Products Section-->