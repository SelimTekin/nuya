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
					<form action="<?= base_url("Fpanel/category/add_result"); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="mb-3 formAllBlocks">
								<span class="formInfoBlocks">Kategori ekle</span>
								<?php
									$categoryArray = [];
									foreach ($categories as $category) {
										$categoryArray[] = [$category->MenuID, $category->name];
									}
									$myForms = [
										["select", "AltID", "Kategori Başlığı Seçiniz", $categoryArray], 
										["simple", "file", "image", "Kategori Resmi Ekle", "Resim Ekleyiniz..."], 
										["simple", "text", "name", "Kategori İsmi", "Kategori ismi giriniz..."], 
										["simple", "text", "link", "Kategori Linki", "Kategori için bir link giriniz..."],
									];
									echo myFormItems($myForms);
								?>
							</div>
							<div class="mb-3 text-end">
								<div class="row">
									<div class="col-4 text-start">
										<div class="form-check form-switch px-5">
											<input class="form-check-input" type="checkbox" role="switch" name="rumuz" id="rumuz">
											<label class="form-check-label" for="rumuz">Link kategorisi</label>
										</div>
									</div>
									<div class="col-8 text-end">
										<input type="submit" class="btn btn-dark px-4" name="gonder" id="gonder">
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