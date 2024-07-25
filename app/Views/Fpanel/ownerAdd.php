<?= helper("form"); ?>
<!doctype html>
<html lang="tr">  <!-- HTML -->

	<?php include 'includes/header.php' ?> <!-- Head -->

	<body> <!-- Body -->

		<?php include 'includes/pluginAlert.php' ?> <!-- Plugin Alert -->

        <?php include 'includes/topBar.php' ?> <!-- Top Bar -->

		<div class="row  gradient-custom d-flex"> <!-- Body Area -->

			<?php include 'includes/leftBar.php' ?>  <!-- Left Bar -->

			<div class="col-7 col-md-9 col-lg-10 centerOwner" style="margin-left:auto">   <!-- Center Bar -->
			
				<?php include 'includes/whichExtra.php' ?> <!-- Extra Locations -->

				<div class="pb-5 mt-3 p-2"> <!-- Reel Body -->
					<form action="<?= base_url("Fpanel/owner/add_result"); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="uyegirisformkapsamaalaniyapisi">
								<div class="mb-3 formAllBlocks">
									<span class="formInfoBlocks">Yeni çalışan ekle</span>
									<?php
										$rankArray = [];
										foreach ($ranks as $rank) {
											$rankArray[] = [$rank->id,$rank->name];
										}
										$myForms = [
											["simple", "text", "userName", "Kullanıcı Adı", "Kullanici adı giriniz..."], 
											["simple", "password", "password", "Kullanıcı Şifre", "Şifre giriniz..."], 
											["simple", "text", "name", "İsim soyisim", "İsim ve soyisim giriniz..."], 
											["simple", "email", "email", "Email Adresi", "Email adresi giriniz..."],
											["select", "rank", "Yönetici seviyesi", $rankArray], 
										];
										echo myFormItems($myForms);
									?>
								</div>
								<div class="mb-3 text-end">
									<div onclick="newWaiterSettings()" class="btn btn-dark px-5" value="Güncelle"> Gönder
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
	
			</div>
		
		</div>
		<?php include 'includes/footer.php' ?>  <!-- Footer -->

	</body>
</html>