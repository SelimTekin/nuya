<?php helper("fonksiyonlar"); ?>
<?php helper("form"); ?>

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
					<form action="<?= base_url("Fpanel/owner/update_result/" . $incomingId); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="uyegirisformkapsamaalaniyapisi">
								<div class="mb-4 formAllBlocks ">
									<span class="formInfoBlocks">Kullanıcı detayları</span>
									
									<?php
										
										$myForms = [
											["simple", "text", "userName", "Kullanıcı Adı", "Kullanici adı giriniz..."	, RestoreTransformations($contentInfo->userName)], 
											["simple", "password", "password", "Kullanıcı Şifre", "Şifre giriniz... (Eğer şifre değiştirilmeyecekse dokunmayın)"	, ""],
											["simple", "text", "name", "İsim soyisim", "İsim ve soyisim giriniz..."		, RestoreTransformations($contentInfo->name)], 
											["simple", "email", "email", "Email Adresi", "Email adresi giriniz..."		, RestoreTransformations($contentInfo->email)],
										];
										if ($owner->rankID == 1 and ($owner->userName != RestoreTransformations($contentInfo->userName))) {
											$rankArray = [];
											foreach ($ranks as $rank) {
												$rankArray[] = [$rank->id,$rank->name];
											}
											$myForms[] = ["select", "rank", "Yönetici seviyesi", $rankArray, RestoreTransformations($contentInfo->rankID)];
										}
										echo myFormSelectedItems($myForms);
									?>
								</div>

								<div class="mb-3 text-end">
									<button class="btn btn-dark px-5">Güncelle
									</button>
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