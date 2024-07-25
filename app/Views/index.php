<!DOCTYPE html>
<html lang="en">


<head>

    <?php include 'includes/header.php'; ?>
    <!-- IK CSS -->
    <!-- IK JS -->

</head>
<!-- body -->

<body class="main-layout">
	<!-- header section start -->
	<div class="header_section">
		<?php
			require "includes/navbar.php";
		?>
		<div class="banner_section">
			<div class="container-fluid">
				<section class="slide-wrapper">
					<div class="container-fluid">
						<div id="myCarousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1"></li>
								<li data-target="#myCarousel" data-slide-to="2"></li>
								<li data-target="#myCarousel" data-slide-to="3"></li>
							</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="carousel-item active">
									<div class="row">
										<div class="col-sm-5">
											<div class="banner_taital">
												<h1 class="banner_text">Yeni Koşu Ayakkabıları</h1>
												<h1 class="mens_text"><strong>Erkekler rahatlığı sever</strong></h1>
												<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
												<button class="buy_bt goInLink" name="ourPackages">Ürünleri İncele</button>
												<button class="more_bt">Daha Fazlası</button>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="shoes_img"><img src="<?= base_url("images/running-shoes.png");?>"></div>
										</div>
									</div>
								</div>
								<div class="carousel-item">
									<div class="row">
										<div class="col-sm-2 padding_0">
											<p class="mens_taital">Men Shoes</p>
											<div class="page_no">0/2</div>
											<p class="mens_taital_2">Men Shoes</p>
										</div>
										<div class="col-sm-5">
											<div class="banner_taital">
												<h1 class="banner_text">New Running Shoes </h1>
												<h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
												<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
												<button class="buy_bt goInLink" name="ourPackages">Ürünleri İncele</button>
												<button class="more_bt">See More</button>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="shoes_img"><img src="images/running-shoes.png"></div>
										</div>
									</div>
								</div>
								<div class="carousel-item">
									<div class="row">
										<div class="col-sm-2 padding_0">
											<p class="mens_taital">Men Shoes</p>
											<div class="page_no">0/2</div>
											<p class="mens_taital_2">Men Shoes</p>
										</div>
										<div class="col-sm-5">
											<div class="banner_taital">
												<h1 class="banner_text">New Running Shoes </h1>
												<h1 class="mens_text"><strong>Men's Like Plex</strong></h1>
												<p class="lorem_text">ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
												<button class="buy_bt goInLink" name="ourPackages">Ürünleri İncele</button>
												<button class="more_bt">See More</button>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="shoes_img"><img src="<?= base_url("images/running-shoes.png");?>"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<!-- header section end -->
	<!-- new collection section start -->
	<div class="layout_padding collection_section">
		<div class="container">
			<h1 class="new_text"><strong>Yeni Koleksiyonlar</strong></h1>
			<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
			<div class="collection_section_2">
				<div class="row">
					<div class="col-md-6">
						<div class="about-img">
							<button class="new_bt">Yepyeni !</button>
							<div class="shoes-img"><img src="<?= base_url("images/shoes-img1.png");?>"></div>
							<p class="sport_text">Spor Ayakkabıları</p>
							<div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
							<div class="star_icon">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
						</div>
						<button class="seemore_bt goInLink" name="ourPackages">Daha Fazlası</button>
					</div>
					<div class="col-md-6">
						<div class="about-img2">
							<div class="shoes-img2"><img src="<?= base_url("images/shoes-img2.png")?>"></div>
							<p class="sport_text">Spor Ayakkabıları</p>
							<div class="dolar_text">$<strong style="color: #f12a47;">90</strong> </div>
							<div class="star_icon">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="collection_section">
		<div class="container">
			<h1 class="new_text"><strong>Yarış Botları</strong></h1>
			<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
		</div>
	</div>
	<div class="collectipn_section_3 layuot_padding">
		<div class="container">
			<div class="racing_shoes">
				<div class="row">
					<div class="col-md-8">
						<div class="shoes-img3"><img src="<?= base_url("images/shoes-img3.png")?>"></div>
					</div>
					<div class="col-md-4">
						<div class="sale_text"><strong>Satılık <br><span style="color: #0a0506;">RAPRAHAT</span> <br>AYAKKABILAR</strong></div>
						<div class="number_text"><strong>$ <span style="color: #0a0506">100</span></strong></div>
						<button class="seemore goInLink" name="ourPackages">Daha Fazlası</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="collection_section layout_padding">
		<div class="container">
			<h1 class="new_text"><strong>Yakında çıkmış ürünler</strong></h1>
			<p class="consectetur_text">consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
		</div>
	</div>
	<!-- new collection section end -->
	<!-- New Arrivals section start -->
	<div class="layout_padding gallery_section">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">Çok Satan Spor Ayakkabıları</p>
						<div class="shoes_icon"><img src="<?= base_url("images/shoes-img4.png");?>"></div>
						<div class="star_text">
							<div class="left_part">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
							<div class="right_part">
								<div class="shoes_price">$ <span style="color: #ff4e5b;">60</span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">Çok Satan Spor Ayakkabıları</p>
						<div class="shoes_icon"><img src="<?= base_url("images/shoes-img5.png"); ?>"></div>
						<div class="star_text">
							<div class="left_part">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
							<div class="right_part">
								<div class="shoes_price">$ <span style="color: #ff4e5b;">400</span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">Çok Satan Spor Ayakkabıları</p>
						<div class="shoes_icon"><img src="<?= base_url("images/shoes-img6.png");?>"></div>
						<div class="star_text">
							<div class="left_part">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
							<div class="right_part">
								<div class="shoes_price">$ <span style="color: #ff4e5b;">50</span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">Çok Satan Spor Ayakkabıları</p>
						<div class="shoes_icon"><img src="<?= base_url("images/shoes-img7.png"); ?>"></div>
						<div class="star_text">
							<div class="left_part">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
							<div class="right_part">
								<div class="shoes_price">$ <span style="color: #ff4e5b;">70</span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">Çok Satan Spor Ayakkabıları</p>
						<div class="shoes_icon"><img src="<?= base_url("images/shoes-img8.png"); ?>"></div>
						<div class="star_text">
							<div class="left_part">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png"); ?>"></a></li>
								</ul>
							</div>
							<div class="right_part">
								<div class="shoes_price">$ <span style="color: #ff4e5b;">100</span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="best_shoes">
						<p class="best_text">Çok Satan Spor Ayakkabıları</p>
						<div class="shoes_icon"><img src="<?= base_url("images/shoes-img9.png"); ?>"></div>
						<div class="star_text">
							<div class="left_part">
								<ul>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png");?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png");?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png");?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png");?>"></a></li>
									<li><a href="#"><img src="<?= base_url("images/star-icon.png");?>"></a></li>
								</ul>
							</div>
							<div class="right_part">
								<div class="shoes_price">$ <span style="color: #ff4e5b;">90</span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="buy_now_bt">
				<button class="buy_text goInLink" name="ourPackages">Ürünlere Bak</button>
			</div>
		</div>
	</div>
	<!-- New Arrivals section end -->
	<!-- contact section start -->
		<?php
			require "includes/footer.php";
		?>


</body>

</html>