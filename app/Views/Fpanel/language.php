<?php helper("fonksiyonlar"); ?>
<?php helper("dropDown"); ?>

<!doctype html>
<html lang="tr">  <!-- HTML -->

	<?php include 'includes/header.php' ?> <!-- Head -->

	<body> <!-- Body -->

		<?php include 'includes/pluginAlert.php' ?> <!-- Plugin Alert -->

        <?php include 'includes/topBar.php' ?> <!-- Top Bar -->

		<div class="row  gradient-custom"> <!-- Body Area -->

			<?php include 'includes/leftBar.php' ?>  <!-- Left Bar -->

			<div class="col-7 col-md-9 col-lg-10 centerOwner">   <!-- Center Bar -->
			
				<?php include 'includes/whichExtra.php' ?> <!-- Extra Locations -->

				<div class="pb-5 mt-3 p-2"> <!-- Reel Body -->
					<?php
					if ($Languages) {
						foreach ($Languages as $Language) {
					?>
							<div class="row text-white mt-1 mx-3" style="--bs-gutter-x:0px">
								<div class="col-12 col-md-10 p-3 <?= $Language->active == 1?"bg-success":"bg-secondary"?>">
									<div><b><?= RestoreTransformations($Language->name); ?></b> <span class="text-dark">#<?= RestoreTransformations($Language->languageCode); ?></span></div>
									<div><?= $Language->active == 1?"Aktif":"Aktif değil"?></div>
								</div>
								<div class="col-12 col-md-2 text-center bg-white" style="line-height: 80px;">
									<div class="dropdown">
										<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa-solid fa-sliders"></i>
										</a>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<?php
												$incomingId 	= RestoreTransformations($Language->id);
												$similarText	= "Fpanel/Language/";
												$dropDownItemList = [];
												if(!$Language->active){
													$dropDownItemList[] = [$similarText . "add_result/" . $incomingId, 		"goInLinkLoad adminUpdateColor", "fa-solid fa-highlighter", "Ekle"];
												}else{
													if(!($Language->languageCode == "tr")){
														$dropDownItemList[] = [$similarText . "delete_result/" . $incomingId, "goInDeleteComplete adminDeleteColor", "fa-solid fa-trash-can" ,"Çıkar"];
													}
												}
												
												echo myDropDown($dropDownItemList);
											?>
										</div>
									</div>
								</div>
								
							</div>
						<?php
						}
					} else {
						?>
						<div class="p-5 border border-secondary">Kayıtlı yönetici bulunmamaktadır.</div>
					<?php
					}
					?>
				</div>
	
			</div>
		
		</div>
		<?php include 'includes/footer.php' ?>  <!-- Footer -->

	</body>
</html>