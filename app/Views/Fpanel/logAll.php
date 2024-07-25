<?php helper("fonksiyonlar"); ?>

<!doctype html>
<html lang="tr">  <!-- HTML -->

	<?php include 'includes/header.php' ?> <!-- Head -->

	<body>  <!-- Body -->

        <?php include 'includes/pluginAlert.php' ?> <!-- Plugin Alert -->

        <?php include 'includes/topBar.php' ?> <!-- Top Bar -->

		<div class="row  gradient-custom d-flex"> <!-- Body Area -->

			<?php include 'includes/leftBar.php' ?>  <!-- Left Bar -->

			<div class="col-7 col-md-9 col-lg-10 centerOwner" style="margin-left:auto">   <!-- Center Bar -->
			
				<?php include 'includes/whichExtra.php' ?> <!-- Extra Locations -->

				<div class="pb-5 mt-3 p-2"> <!-- Reel Body -->
					<?php
					if ($Logs) {
						foreach ($Logs as $key => $Log) {
							if ($key == 0) {
								$ownerName = $Log->ownerName;
					?>
								<div class="logOneDayInfo">
									<span class="logOneDayInfoS text-muted">
										<?= $ownerName; ?>
									</span>
								</div>
								<div class="logOneDay">
									<div class="logOneDayItems d-flex">
										<div class="col-4 logOneItems"><?= $Log->ownerName; ?></div>
										<div class="col-4 logOneItems" title="<?= $Log->ownerWhere; ?>"><?= $Log->ownerCan; ?></div>
										<div class="col-4 logOneItems"><?= $Log->ownerWhen; ?></div>
									</div>
									<?php
								} else {
									$ownerN = $Log->ownerName;
									if ($ownerName == $ownerN) {
									?>
										<div class="logOneDayItems d-flex">
											<div class="col-4 logOneItems"><?= $Log->ownerName; ?></div>
											<div class="col-4 logOneItems" title="<?= $Log->ownerWhere; ?>"><?= $Log->ownerCan; ?></div>
											<div class="col-4 logOneItems"><?= $Log->ownerWhen; ?></div>
										</div>
									<?php
									} else {
										$ownerName = $ownerN;
									?>
								</div>
								<div class="logOneDayInfo">
									<span class="logOneDayInfoS text-muted">
										<?= $ownerName; ?>
									</span>
								</div>
								<div class="logOneDay">
									<div class="logOneDayItems d-flex">
										<div class="col-4 logOneItems"><?= $Log->ownerName; ?></div>
										<div class="col-4 logOneItems" title="<?= $Log->ownerWhere; ?>"><?= $Log->ownerCan; ?></div>
										<div class="col-4 logOneItems"><?= $Log->ownerWhen; ?></div>
									</div>
							<?php
									}
								}
							?>
						<?php
						}
						?>
								</div>
							<?php
						} else {
							?>
								<div class="p-5 border border-secondary">Kayıtlı Log içeriği bulunmamaktadır.</div>
							<?php
						}
							?>
				</div>

			</div>

		</div>
		<?php include 'includes/footer.php' ?>  <!-- Footer -->

	</body>
</html>