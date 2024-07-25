<!doctype html>
<html lang="tr">

<head>

    <?php include 'includes/header.php'; ?>
    <!-- IK CSS -->
    <link rel="stylesheet" href="<?= base_url("css/ourPackages.css") ?>">
    <!-- IK JS -->
    <script src="<?= base_url("js/ourPackages.js") ?>"></script>

</head>


<body>
    <div class="header_section header_main">
        <?php include 'includes/navbar.php' ?>
    </div>
    <?php include 'includes/pluginLoader.php' ?>

    <div class="center">
        <div class="mb-3 pb-2 searchProductArea" style="margin-top:40px;">
            <div class="d-flex justify-content-center searchProductInArea">
                <div class="container d-flex justify-content-center" style="position: relative;">
                    <input type="text" class="form-control text-muted" aria-describedby="helpId" placeholder="<?= "Ürün Ara" ?>" name="word" id="word" onkeyup="lookup(this.value);" style="width:90%">
                </div>
            </div>
        </div>
        <div class="topCategoryArea">
            <div class="container topCategoryAreaContainer">
                <div class="topCategoryInArea d-flex">
                    <?php
                    foreach ($menus as $menu) {
                        if ($menu->MenuID != 1) {
                            $menuName = $menu->name;
                    ?>
                            <div class="p-2 topCategoryMenuArea" onclick="menuActive(this)" name="<?= $menu->MenuID ?>">
                                <div>
                                    <img src="<?= base_url("img/categoryImg/" . $menu->image); ?>" class="topCategoryMenuImg">
                                </div>
                                <span><?= $menuName ?></span>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <span class="absoluteGoCarousel leftGo" onclick="leftGoCarousel()"><i class="fa-solid fa-angle-left" style="font-size: 40px;"></i></span>
                <span class="absoluteGoCarousel rightGo" onclick="rightGoCarousel()"><i class="fa-solid fa-angle-right" style="font-size: 40px;"></i></span>
            </div>
        </div>
        <div class="container">
            <div class="mainProductArea">
                <?php
                if (($showProducts != "") and ($showProducts != "Not Found")) {
                    foreach ($showProducts as $showProduct) {
                        date_default_timezone_set("Europe/Istanbul");
                        $productDetails = $showProduct->productDetails;
                        $productName    = $productDetails->productName;
                        $productText    = $productDetails->productText;
                        $productPrice   = $productDetails->productPrice;
                        $productCount   = $productDetails->productCount;
                        $createDate     = $productDetails->productCreateDate;
                        $createDate     = date('d-m-Y', $createDate);
                ?>
                        <div class="d-flex mainProducts">
                            <?php
                            if ($productDetails->productImg != "") {
                            ?>
                                <div class="col-3 p-2 goInLink mainProductsImgArea" name="<?= $productDetails->productLink ?>">
                                    <img class="mainProductsImg" src="<?= base_url("img/productImg/" .  $productDetails->productImg) ?>">
                                </div>
                            <?php
                                $otherPart = "col-9";
                            } else {
                                $otherPart = "col-12";
                            }
                            ?>
                            <div class="<?= $otherPart; ?> mainContentProductsDetailsArea">
                                <div class="d-flex mainContentTitle">
                                    <span name="<?= $productDetails->productLink ?>" class="goInLink"><?= $productName ?></span>
                                </div>
                                <div class="mainContentText goInLink" name="<?= $productDetails->productLink ?>"><?= $productText ?></div>
                                <div class="d-flex justify-content-end text-muted">
                                    <div style="font-size:20px;"><?= $productPrice; ?> ₺</div>
                                    <div iv class="ml-auto"><?= $createDate; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="d-flex mainProducts">
                        <span class="mx-auto" style="font-size: 25px;">Ürün Bulunamadı</span>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>

    <?php include 'includes/footer.php' ?>
</body>

</html>