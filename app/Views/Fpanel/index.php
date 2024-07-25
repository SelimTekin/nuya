<!doctype html>
<html lang="tr">  <!-- HTML -->

	<?php include 'includes/header.php' ?> <!-- Head -->
	<script src="<?= base_url("js/Fpanel/login.js"); ?>"></script>

	<body>  <!-- Body -->

		<?php include 'includes/kaosIK.php'; ?> <!-- Kaos IK -->
        <?php include 'includes/pluginAlert.php'; ?> <!-- Plugin Alert -->

		<section class="vh-100 gradient-custom"> <!-- Reel Body -->
			
			
			<div class="container py-5 h-100">
				<div class="row d-flex justify-content-center align-items-center h-100">
					<div class="col-12 col-md-8 col-lg-6 col-xl-5">
						<div class="card bg-dark text-white" style="border-radius: 1rem;position: relative;">
							<span style="width: 200px;height:200px;position:absolute;top:-100px;left:-100px;background-color:#FFF9F2;text-align:center;border-radius:50%;line-height:200px" >
								<img src="<?= base_url("img/serverLogo/creatorLogo.png");?>" width="150" height="150" class="hourSpin">
							</span>
							<div class="card-body p-5 text-center">
								<div class="mb-md-5 mt-md-4 pb-5">
									<form action="<?= base_url("Fpanel/admin/login")?>" method="POST">
									
										<h2 class="fw-bold mb-2 text-uppercase">Giriş <i class="fa-solid fa-lock"></i></h2>
										<p class="text-white-50 mb-5">Lütfen giriş yapınız</p>

										<div class="form-outline form-white mb-4">
											<input type="text" id="Fname" name="Fname" class="form-control form-control-lg" placeholder="Kullanici Adı"/>
										</div>

										<div class="form-outline form-white mb-4">
											<input type="password" id="Fpassword" name="Fpassword" class="form-control form-control-lg" placeholder="Şifre"/>
										</div>
										<div class="btn btn-outline-light btn-lg px-5 mt-3" type="submit" onclick="loginCookie()">Giriş yap <i class="fa-solid fa-location-arrow"></i></div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</body>
</html>