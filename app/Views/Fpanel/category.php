<?php helper("category"); ?>

<!doctype html>
<html lang="tr">  <!-- HTML -->

	<?php include 'includes/header.php' ?> <!-- Head -->

    <body>  <!-- Body -->

        <?php include 'includes/pluginAlert.php' ?> <!-- Plugin Alert -->

        <?php include 'includes/topBar.php' ?> <!-- Top Bar -->

        <div id="myModal" class="modal fade" tabindex="-1"> <!-- Category Modal For Category -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="modal-quantity-product"></span> adet ürün bulundu. </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center modal-body-product" style="height:400px;overflow-y: scroll;">

                    </div>
                    <div class="modal-footer d-flex justify-content-center" name="">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="categoryModelComplateIndex()">Tamamla</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModalCategory" class="modal fade" tabindex="-1"> <!-- Category Modal For Product -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="modal-quantity-category"></span> adet ürün bulundu. </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center modal-body-category" style="height:400px;overflow-y: scroll;">

                    </div>
                    <div class="modal-footer d-flex justify-content-center" name="">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="menuModelComplateIndex()">Tamamla</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModalInCategory" class="modal fade" tabindex="-1"> <!-- Category Modal For Product -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="modal-quantity-in-category"></span> adet ürün bulundu. </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center modal-body-in-category" style="height:400px;overflow-y: scroll;">

                    </div>
                    <div class="modal-footer d-flex justify-content-center" name="">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="menuModelMenuComplateIndex()">Tamamla</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>

		<div class="row  gradient-custom d-flex"> <!-- Body Area -->

			<?php include 'includes/leftBar.php' ?>  <!-- Left Bar -->

			<div class="col-7 col-md-9 col-lg-10 centerOwner" style="margin-left:auto">   <!-- Center Bar -->
            
                <?php include 'includes/whichExtra.php' ?> <!-- Extra Locations -->

                <div class="pb-5 mt-3 p-2"> <!-- Reel Body -->
                    <div class="bg-dark text-white p-3 categoryArea">
                        <?= menuWrite($myData["bottomData"]); ?>
                    </div>
                </div>
            </div>
            
        </div>

        <?php include 'includes/footer.php' ?>  <!-- Footer -->

    </body>
</html>