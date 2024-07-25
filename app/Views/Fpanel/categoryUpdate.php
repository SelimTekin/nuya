<?php helper("form"); ?>


<!doctype html>
<html lang="tr">  <!-- HTML -->

	<?php include 'includes/header.php' ?> <!-- Head -->

	<body>  <!-- Body -->

		<?php include 'includes/pluginAlert.php' ?>  <!-- Plugin Alert -->

		<?php include 'includes/topBar.php' ?> <!-- Top Bar -->

		<div class="row  gradient-custom d-flex"> <!-- Body Area -->

			<?php include 'includes/leftBar.php' ?>  <!-- Left Bar -->

			<div class="col-7 col-md-9 col-lg-10 centerOwner" style="margin-left:auto">   <!-- Center Bar -->
            
				<?php include 'includes/whichExtra.php' ?> <!-- Extra Locations -->

				<div class="pb-5 mt-3 p-2"> <!-- Reel Body -->
					<form action="<?= base_url("Fpanel/category/update_result/" . $incomingId); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="mb-3 formAllBlocks">
								<span class="formInfoBlocks"><span style="font-weight: bold;"><?= $contentInfo->name?></span> <span class="text-muted" style="font-size:20px;">isimli kategoriyi düzenle</span></span>

								<?php
									$categoryArray = [];
									foreach ($categories as $category) {
										$categoryArray[] = [$category->MenuID,$category->name];
									}
									$myForms = [
										["select", "AltID", "Kategori Başlığı Seçiniz", 	$categoryArray			, $contentInfo->AltID], 
										["simple", "file", "image", "Kategori Resmi Ekle", "Resim Ekleyiniz..."		, ""], 
										["simple", "text", "name", "Kategori İsmi", "Kategori ismi giriniz..."			, RestoreTransformations($contentInfo->name)], 
										["simple", "text", "link", "Kategori Linki", "Kategori için bir link giriniz...", RestoreTransformations($contentInfo->link)],
									];
									echo myFormSelectedItems($myForms);
								?>

							</div>
							<div class="mb-3 text-end">
								<div class="row">
									<div class="col-4 text-start">
										<div class="form-check form-switch px-5">
											<input class="form-check-input" type="checkbox" role="switch" name="rumuz" id="rumuz" <?= $contentInfo->rumuz == 1 ? "checked" : "" ?>>
											<label class="form-check-label" for="rumuz">Ürün kategorisi</label>
										</div>
									</div>
									<div class="col-8 text-end">
										<input type="submit" class="btn btn-dark px-5" value="Güncelle">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
		<?php include 'includes/footer.php' ?> <!-- Footer -->

	</body>
</html>