<!doctype html>
<html lang="tr">

<head>

    <?php include 'includes/header.php'; ?>
    <!-- IK CSS -->
    <!-- IK JS -->

</head>

<body>
    <div class="header_section header_main">
        <?php include 'includes/navbar.php' ?>
    </div>
    <?php include 'includes/pluginLoader.php' ?>
    <?php

    $productDetails = $product->productDetails;
    $productLink    = $productDetails->productLink;
    $productName    = $productDetails->productName;
    $productText    = $productDetails->productText;
    $productPrice   = $productDetails->productPrice;
    $productCount   = $productDetails->productCount;
    $productId      = $productDetails->productId;

    ?>
    <div class="center container">
        <section class="row">
            <article class="col-12" style="margin-top:50px">
                <div class="card mb-3 mt-2 p-4" style="position:relative">
                    <div style="position:absolute;right:10px;bottom:10px;font-size:40px"><?= $productPrice ?> ₺</div>
                    <div class="row">
                        <header class="col-12 col-md-4  text-center">
                            <img src="<?= base_url("img/productImg/" . $productDetails->productImg) ?>" class="img-fluid rounded-start" alt="<?= $productDetails->productName; ?>" title="<?= $productDetails->productName; ?>">
                        </header>
                        <section class="col-12 col-md-8">
                            <article class="card-body">
                                <div class="d-flex" style="border-bottom:1px dashed grey;font-size:30px">
                                    <h5 class="card-title" style="font-size:30px;"><?= $productName; ?></h5>
                                    <h5 class="card-title" style="font-size:20px;margin-left:auto"><i class="fa-solid fa-box"></i><?= " : " . $productCount; ?></h5>
                                </div>
                                <p class="card-text"><?= $productText; ?></p>
                            </article>
                        </section>
                    </div>
                </div>
            </article>
            <aside class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-2">
                <a class="btn btn-dark px-5" href="javascript:history.go(-1)" role="button">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    <?= "Geri Git"; ?>
                </a>
            </aside>
            <?php

            if (isset($userDetails)) {
            ?>
                <aside class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-2 ml-auto">
                    <a class="btn btn-dark px-5" href="<?= base_url("addBasket/$productId") ?>" role="button">
                        <?= "Sepete Ekle"; ?>
                    </a>
                </aside>
            <?php
            }
            ?>
            <div class="mt-5">
                Beğenebileceğin ürün (Ai)
                <?php
                    $productImg = $this->data["aiSelected"]->productDetails->productImg;
                    $productName = $this->data["aiSelected"]->productDetails->productName;
                    $productPrice = $this->data["aiSelected"]->productDetails->productPrice;
                    $productText = $this->data["aiSelected"]->productDetails->productText;
                    $productLink = $this->data["aiSelected"]->productDetails->productLink;
                ?>   
                <div class="d-flex p-3 goInLink mb-4" style="border:1px solid grey;" name="<?= $productLink?>">
                    <div class="col-3">
                        <div style="height:100%"> 
                            <img src="<?= base_url("img/productImg/" . $productImg) ?>" class=" w-100" alt="<?= $productName; ?>" title="<?= $productName; ?>">
                            <div><?= $productName; ?></div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex">
                            <div srtle="font-size:30px"><?= $productName?></div>
                            <div style="margin-left:auto;font-size:30px"><?= $productPrice; ?> ₺</div>
                        </div>
                        <div>
                            <?= $productText?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php' ?>
</body>

</html>