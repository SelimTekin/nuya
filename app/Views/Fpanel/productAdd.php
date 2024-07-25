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
					<form action="<?= base_url("Fpanel/product/add_result"); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="mb-3 formAllBlocks">
								<span class="formInfoBlocks">Ürün ekle</span>
								<?php
									$categoryArray 	= [];
									foreach ($categories as $category) {
										$categoryArray[] = [$category->MenuID,$category->name];
									}
									$myForms = [
										["select", "MenuID", "Kategori Seçiniz", $categoryArray], 
										["simple", "file", "image", "Ürün Resmi", "Resim Ekle"], 
										["simple", "text", "name", "Ürün Adı", "Ürünün adını giriniz..."], 
										["simple", "number", "price", "Ürün Fiyatı", "Ürünün fiyatını giriniz..."], 
										["simple", "number", "count", "Ürün Miktarı", "Ürünün miktarını giriniz..."], 
										["textArea", "text", "Ürün Metni", "Ürünün metnini giriniz..."], 
										["simple", "text", "link", "Ürün Linki", "Ürünün linkini giriniz..."], 
									];
									echo myFormItems($myForms);
								?>
							</div>
							<div class="mb-3 text-end">
								<input type="submit" class="btn btn-dark px-5">
							</div>
						</div>
					</form>
				</div>
				
			</div>
		
		</div>
		<?php include 'includes/footer.php' ?>  <!-- Footer -->

	</body>
</html>