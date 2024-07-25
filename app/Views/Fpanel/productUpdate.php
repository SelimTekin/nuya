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
					<form action="<?= base_url("Fpanel/product/update_result/" . $contentInfo->ProductID); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="mb-3 formAllBlocks">
								<span class="formInfoBlocks"><span style="font-weight: bold;"><?= RestoreTransformations($contentInfo->name)?></span> <span class="text-muted" style="font-size:20px;">adlı ürünü düzeltme</span></span>
								<?php
									$categoryArray 	= [];
									foreach ($categories as $category) {
										$categoryArray[] = [$category->MenuID,$category->name];
									}
									$myForms = [
										["select", "MenuID", "Kategori Seçiniz", $categoryArray						, $contentInfo->MenuID], 
										["simple", "file", "image", "Ürün Resmi", "Resim Ekle"						, ""], 
										["simple", "text", "name", "Ürün Adı", "Ürünün adını giriniz..."			, RestoreTransformations($contentInfo->name)], 
										["simple", "number", "price", "Ürün Fiyatı", "Ürünün fiyatını giriniz..."	, RestoreTransformations($contentInfo->price)], 
										["simple", "number", "count", "Ürün Miktarı", "Ürünün miktarını giriniz..."	, RestoreTransformations($contentInfo->count)], 
										["textArea", "text", "Ürün Metni", "Ürünün metnini giriniz..."				, RestoreTransformations($contentInfo->text)], 
										["simple", "text", "link", "Ürünün Linki", "Ürünün linkini giriniz..."		, RestoreTransformations($contentInfo->link)], 
									];
									echo myFormSelectedItems($myForms);
								?>
							</div>
							<div class="mb-3 text-end">
								<input type="submit" class="btn btn-dark px-5" value="Güncelle">
							</div>
						</div>
					</form>
				</div>

			</div>
		
		</div>
		<?php include 'includes/footer.php' ?>  <!-- Footer -->

	</body>
</html>