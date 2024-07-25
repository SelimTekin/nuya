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
					<form action="<?= base_url("Fpanel/setting/update_result"); ?>" method="post" enctype="multipart/form-data">
						<div class="container">
							<div class="uyegirisformkapsamaalaniyapisi">
								<div class="mb-3 formAllBlocks">
									<span class="formInfoBlocks">Sistem ayarları</span>
									
									<?php
										$myForms = [
											["simple", "text", "siteName"			, "Site Adı"					, "Site adını giriniz..."						, RestoreTransformations($settings->siteName)			], 
											["simple", "text", "siteTitle"			, "Site Metni"					, "Site metnini giriniz..."						, RestoreTransformations($settings->siteTitle)			], 
											["simple", "text", "siteDescription"	, "Site Açıklaması"				, "Site açıklamasını giriniz..."				, RestoreTransformations($settings->siteDescription)	], 
											["simple", "text", "siteKeywords"		, "Site İçin Kilit Kelimeler"	, "Site için kilit kelimeler giriniz..."		, RestoreTransformations($settings->siteKeywords)		], 
											["simple", "text", "siteCopyright"		, "Site Telif Hakkı ©"			, "Site telif hakkı metnini giriniz..."			, RestoreTransformations($settings->siteCopyright)		], 
											["simple", "file", "siteLogo"			, "Site Temel Logo Ekle"		, "Siteye temel logo resmi ekleyiniz..."		, ""													], 
											["simple", "file", "siteFaviconLogo"	, "Site Üst Logo Ekle (Favicon)", "Siteye üst logo resmi ekleyiniz..."			, ""													], 
											["simple", "file", "siteLoadingLogo"	, "Siteye Yüklenme Resmi Ekle"	, "Siteye yüklenme logosu resmi ekleyiniz..."	, ""													], 
											["simple", "file", "siteFooterLogo"		, "Siteye Footer Resmi Ekle"	, "Siteye footer resmi ekleyiniz..."			, ""													], 
											["simple", "text", "phone"				, "Şirket Telefon Numarası"		, "Şirket telefon numarasını giriniz..."		, RestoreTransformations($settings->phone)				], 
											["simple", "text", "address"			, "Şirket Adresi"				, "Şirket adresini giriniz..."					, RestoreTransformations($settings->address)			], 
											["simple", "text", "socialLinkEmail"	, "Şirket Email Adresi"			, "Şirket email adresini giriniz..."			, RestoreTransformations($settings->socialLinkEmail)	], 
											["simple", "text", "socialLinkFacebook"	, "Şirket Facebook Adresi"		, "Şirket facebook adresini giriniz..."			, RestoreTransformations($settings->socialLinkFacebook)	], 
											["simple", "text", "socialLinkTwitter"	, "Şirket Twitter Adresi"		, "Şirket twitter adresini giriniz..."			, RestoreTransformations($settings->socialLinkTwitter)	], 
											["simple", "text", "socialLinkInstagram", "Şirket Instagram Adresi"		, "Şirket instagram adresini giriniz..."		, RestoreTransformations($settings->socialLinkInstagram)], 
											["simple", "text", "socialLinkLinkedin"	, "Şirket Linkedin Adresi"		, "Şirket linkedin adresini giriniz..."			, RestoreTransformations($settings->socialLinkLinkedin)	], 
										];
										echo myFormSelectedItems($myForms);
									?>
								</div>
								<div class="mb-3 text-end">
									<input type="submit" class="btn btn-dark px-5" value="Güncelle">
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