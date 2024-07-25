
	<!-- contact section end -->
	<!-- section footer start -->
	<div class="section_footer">
		<div class="container">
			<div class="mail_section">
				<div class="row">
					<div class="col-sm-6 col-lg-2">
    					<div><a href="#"><img src="<?= base_url("images/footer-logo.png")?>"></a></div>
					</div>
					<div class="col-sm-6 col-lg-2">
    					<div class="footer-logo"><img src="<?= base_url("images/phone-icon.png")?>"><span class="map_text">(+90) 1234567890</span></div>
					</div>
					<div class="col-sm-6 col-lg-3">
    					<div class="footer-logo"><img src="<?= base_url("images/email-icon.png")?>"><span class="map_text">pollo@gmail.com</span></div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="social_icon">
							<ul>
    							<li><a href="#"><img src="<?= base_url("images/fb-icon.png"		);?>"></a></li>
    							<li><a href="#"><img src="<?= base_url("images/twitter-icon.png"	);?>"></a></li>
    							<li><a href="#"><img src="<?= base_url("images/in-icon.png"		);?>"></a></li>
    							<li><a href="#"><img src="<?= base_url("images/google-icon.png"	);?>"></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</div>
			<div class="footer_section_2">
				<div class="row">
					<div class="col-sm-4 col-lg-2">
						<p class="dummy_text"> ipsum dolor sit amet, consectetur ipsum dolor sit amet, consectetur ipsum dolor sit amet,</p>
					</div>
					<div class="col-sm-4 col-lg-2">
						<h2 class="shop_text">Konum </h2>
    		        	<div class="image-icon"><img src="<?= base_url("images/map-icon.png");?>"><span class="pet_text">Kırklareli / Merkez .... .. .. . . . . .<</span></div>
					</div>
					<div class="col-sm-4 col-md-6 col-lg-3">
						<h2 class="shop_text">Şirketimiz </h2>
						<div class="delivery_text">
							<ul>
								<li>Ulaşım</li>
								<li>Yasal Dilekçeler</li>
								<li>Bizim Hakkımızda</li>
								<li>Güvenli Alışveriş</li>
								<li>Bize ulaşın</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<h2 class="adderess_text">Ürünler</h2>
						<div class="delivery_text">
							<ul>
								<li class="goInLink" style="cursor:pointer" name="ourPackages">İndirimdekiler</li>
								<li class="goInLink" style="cursor:pointer" name="ourPackages">Yeni Çıkanlar</li>
								<li class="goInLink" style="cursor:pointer" name="ourPackages">En çok satan</li>
								<li class="goInLink" style="cursor:pointer" name="ourPackages">Sizin için seçilmiş ürünler</li>
								<li>Sitemap</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-lg-2">
						<h2 class="adderess_text">Bülten</h2>
						<div class="form-group">
							<input type="text" class="enter_email" placeholder="E-mail adresinizi giriniz" name="Name">
						</div>
						<button class="subscribr_bt">Abone Ol</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- section footer end -->
	<div class="copyright">2024 Pollo C</div>

<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<script src="js/userAccount.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<!-- javascript -->
<script src="js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
	$(document).ready(function() {
		$(".fancybox").fancybox({
			openEffect: "none",
			closeEffect: "none"
		});


		$('#myCarousel').carousel({
			interval: false
		});

		//scroll slides on swipe for touch enabled devices

		$("#myCarousel").on("touchstart", function(event) {

			var yClick = event.originalEvent.touches[0].pageY;
			$(this).one("touchmove", function(event) {

				var yMove = event.originalEvent.touches[0].pageY;
				if (Math.floor(yClick - yMove) > 1) {
					$(".carousel").carousel('next');
				} else if (Math.floor(yClick - yMove) < -1) {
					$(".carousel").carousel('prev');
				}
			});
			$(".carousel").on("touchend", function() {
				$(this).off("touchmove");
			});
		})
	});
</script>

<?php echo view('alert'); ?>
