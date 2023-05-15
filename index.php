<?php
include_once "Controller/a-dhModel.php";
?>

<?php if (!isset($_GET['action']) || isset($_GET['action']) && $_GET['action'] != "admin-page") { ?>
	<!DOCTYPE html>
	<html lang="en">

	<!-- stella-orre/  30 Nov 2019 03:42:43 GMT -->

	<head>
		<meta charset="utf-8">
		<title>Furniture Shop</title>
		<!-- Stylesheets -->
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/responsive.css" rel="stylesheet">
		<link href="assets/css/fontawesome-all.css" rel="stylesheet">

		<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
		<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

		<!-- Responsive -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	</head>

	<body>
		<div id="mainContent">

			<?php include_once "View/header.php"; ?>
			<div class="page-wrapper">

				<?php include_once "Controller/a-dhView.php"; ?>

			</div>
			<?php include_once "View/footer.php"; ?>

		</div>


		<script src="assets/js/test.js"></script>
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.fancybox.js"></script>
		<script src="assets/js/isotope.js"></script>
		<script src="assets/js/owl.js"></script>
		<script src="assets/js/wow.js"></script>
		<script src="assets/js/appear.js"></script>
		<script src="assets/js/jquery.bootstrap-touchspin.js"></script>
		<script src="assets/js/scrollbar.js"></script>
		<script src="assets/js/mixitup.js"></script>
		<script src="assets/js/script.js"></script>

	</body>

	</html>
<?php }
if (isset($_GET['action']) && $_GET['action'] === "admin-page" && $_SESSION['idCustomer'] != 0) { ?>

	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Admin Furniture Shop</title>

		<!-- Custom fonts for this template-->

		<!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Custom styles for this template-->
		<link href="assets/Admin/css/sb-admin-2.min.css" rel="stylesheet">
		<!-- bootstrap 4 -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://cdn.tiny.cloud/1/w14jmso7use3srii5jgm9yccylyxyglthet7nrd7z9o6gedh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	</head>

	<body id="page-top">

		<div id="wrapper">

			<?php
			include_once 'View/Admin/sidebarAdmin.php';
			?>
			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">

				<!-- Main Content -->
				<div id="content">
					<?php
					include_once 'View/Admin/navbarAdmin.php';
					?>
					<div class="container-fluid">
						<?php
						include_once 'Controller/a-dhView.php';
						?>
					</div>
				</div>
			</div>
		</div>


		<!-- Bootstrap core JavaScript-->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

		<!-- Custom scripts for all pages-->
		<script src="assets/Admin/js/sb-admin-2.min.js"></script>

		<!-- Page level plugins -->
		<script src="vendor/chart.js/Chart.min.js"></script>

		<!-- Page level custom scripts -->
		<script src="assets/Admin/js/demo/chart-area-demo.js"></script>
		<script src="assets/Admin/js/demo/chart-pie-demo.js"></script>
		<script>
			tinymce.init({
				selector: '#description',
				plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
				toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
				tinycomments_mode: 'embedded',
				tinycomments_author: 'Author name',
				mergetags_list: [{
						value: 'First.Name',
						title: 'First Name'
					},
					{
						value: 'Email',
						title: 'Email'
					},
				]
			});
		</script>
	</body>

	</html>
<?php }
if (isset($_GET['action']) && $_GET['action'] === "admin-page" && $_SESSION['idCustomer'] == 0) {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
} ?>


<!-- dự định thêm ảnh vào textarea mà thất bại rồi -->
<!-- <script>
	ClassicEditor
		.create(document.querySelector('#editor'), {
			toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'imageUpload', 'undo', 'redo'],
			image: {
				toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side'],
				styles: [
					'full',
					'side'
				]
			},
			// Tùy chỉnh plugin imageUpload
			ckfinder: {
				uploadUrl: '../assets/images/esource/',
				options: {
					resourceType: 'Images'
				}
			}
		})
		.then(editor => {
			editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
				return {
					upload: function() {
						return loader.file
							.then(file => new Promise((resolve, reject) => {
								const xhr = new XMLHttpRequest();
								xhr.open('POST', '../assets/images/esource/');
								xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
								xhr.addEventListener('load', () => {
									const response = JSON.parse(xhr.responseText);
									if (response && response.url) {
										resolve({
											default: response.url
										});
									} else {
										reject(response && response.message ? response.message : 'Failed to upload');
									}
								});
								const formData = new FormData();
								formData.append('upload', file);
								xhr.send(formData);
							}));
					},
					abort: function() {
						// User canceled the upload.
					}
				};
			};
		})
		.then(editor => {
			editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
				return {
					upload: function() {
						return loader.file
							.then(file => new Promise((resolve, reject) => {
								const xhr = new XMLHttpRequest();
								xhr.open('POST', '../assets/images/esource/');
								xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
								xhr.addEventListener('load', () => {
									const response = JSON.parse(xhr.responseText);
									if (response && response.url) {
										resolve({
											default: response.url
										});
									} else {
										reject(response && response.message ? response.message : 'Failed to upload');
									}
								});
								const formData = new FormData();
								formData.append('upload', file);
								xhr.send(formData);
							}));
					},
					abort: function() {
						// User canceled the upload.
					}
				};
			};
			editor.model.document.on('change:data', () => {
				const imageElements = Array.from(editor.model.document.getRoot().getElementsByType('image'));
				for (const imageElement of imageElements) {
					if (!imageElement.getAttribute('src')) {
						continue;
					}
					const viewFragment = editor.data.processor.toView(imageElement);
					editor.model.insertContent(viewFragment);
				}
			});
		})
	document.getElementById('editNewsDatabase').addEventListener('submit', (event) => {
		// Lấy dữ liệu trong CKEditor
		const data = editor.getData();

		// Gán dữ liệu vào textarea để submit form
		document.querySelector('#editor').value = data;
	});
</script> -->