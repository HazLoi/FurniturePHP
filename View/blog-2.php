<?php
$news = new news();
$newsAll = $news->getAllNews();
$count = $newsAll->rowCount();

$p = new page();
$limit = 4;
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
	<div class="auto-container">
		<h2>Tin tức</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Tin tức</li>
		</ul>
	</div>
</section>
<!--End Page Title-->

<!-- Our Blogs Section -->
<section class="our-blogs-section">
	<div class="auto-container">
		<div class="row clearfix">
			<?php
			$news = new news();
		$result = $news->getNewsOnePage($start, $limit);
			while ($get = $result->fetch()) {
			?>
				<!--News Block Two -->
				<div class="news-block-two style-two col-lg-6 col-md-12 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><img src="assets/images/resource/<?php echo $get['anh'] ?>" alt="" /></a>
						</div>
						<div class="lower-content">
							<div class="upper-box clearfix">
								<div class="posted-date">
									<?php
									$date = new DateTime($get['ngay']);
									$dateFix = $date->format('d / m / Y');
									echo $dateFix;
									?>
								</div>
								<ul class="post-meta">
									<li>Nội thất</li>
								</ul>
							</div>
							<div class="lower-box">
								<h3><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><?php echo $get['tenTT'] ?></a></h3>
								<div class="text"><?php echo $get['noidung'] ?></div>
								<a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>" class="theme-btn read-more">Chi tiết</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<!--Styled Pagination-->
		<?php if (empty($_GET['act']) || isset($_GET['act']) && $_GET['act'] == 'page') { ?>
			<div class="shop-pagination">
				<ul class="clearfix">
					<?php
					if ($currentPage > 1 && $page > 1) :
					?>
						<li class="first"><a href="index.php?action=blog-2&act=page&page=1"><i class="fa fa-angle-double-left"></i></a></li>
						<li class="prev"><a href="index.php?action=blog-2&act=page&page=<?php echo $currentPage - 1 ?>"><i class="fa fa-angle-left"></i></a></li>
					<?php endif; ?>

					<?php if($page > 1) { ?>
						<li class="active"><a href=""><?php echo $currentPage ?></a></li>
					<?php } ?>

					<?php if ($currentPage < $page && $page > 1) : ?>
						<li class="next"><a href="index.php?action=blog-2&act=page&page=<?php echo $currentPage + 1 ?>"><i class="fa fa-angle-right"></i></a></li>
						<li class="last"><a href="index.php?action=blog-2&act=page&page=<?php echo $page ?>"><i class="fa fa-angle-double-right"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php } else { ?>

		<?php } ?>
		<!--End Styled Pagination-->

	</div>
</section>
<!-- End Our Blogs Section -->