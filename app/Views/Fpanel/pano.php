<?php helper("fonksiyonlar"); ?>

<!doctype html>
<html lang="tr"> <!-- HTML -->

<?php include 'includes/header.php' ?> <!-- Head -->

<body> <!-- Body -->

	<?php include 'includes/pluginAlert.php' ?> <!-- Plugin Alert -->

	<?php include 'includes/topBar.php' ?> <!-- Top Bar -->

		<div class="row  gradient-custom d-flex"> <!-- Body Area -->

			<?php include 'includes/leftBar.php' ?>  <!-- Left Bar -->

			<div class="col-7 col-md-9 col-lg-10 centerOwner" style="margin-left:auto">   <!-- Center Bar -->

			<?php include 'includes/whichExtra.php' ?> <!-- Extra Locations -->

			<div class="pb-5 mt-3 p-2"> <!-- Reel Body -->
				<div class="row">
					<?php
					foreach ($panels as $key => $panel) {
						if($key % 4 == 1){
							$myBackColor = "background-color:rgb(0, 0, 0, 0.5)";
						}else if($key % 4 == 2){
							$myBackColor = "background-color:rgb(253, 0, 0, 0.5)";
						}else if($key % 4 == 3){
							$myBackColor = "background-color:rgb(0, 0, 253, 0.5)";
						}else{
							$myBackColor = "background-color:rgb(54, 145, 31, 0.5)";
						}
					?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 row justify-content-center p-3" style="margin:0">
							<div class="col-12 p-1" >
								<div style="border:2px dashed white;outline:1px solid white;outline-offset:2px;padding:5px;text-align:right;<?= $myBackColor; ?>">
									<div style="min-height:100px;position:relative;width:100%" class="d-flex">
										<span style="position:absolute;top:calc(50% - 25px);left:calc(10%)"><i class="<?= $panel[2]; ?>" style="font-size:50px;opacity:0.6;color:white"></i></span>
										<div style="margin-left:auto;text-align:left;color:white" class="col-7">
											<div class="h6" style="line-height: 40px;text-align:center;margin-top:8px"><?= RestoreTransformations($panel[0]); ?></div>
											<div style="text-align:center"><?= RestoreTransformations($panel[1]); ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>

		</div>

	</div>
	<?php include 'includes/footer.php' ?> <!-- Footer -->

</body>

</html>