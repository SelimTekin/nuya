<!doctype html>
<html lang="tr">

<head>

    <?php include 'includes/header.php'; ?>
    <link rel="stylesheet" href="<?= base_url("css/basket.css") ?>">
    <script src="<?= base_url("js/basket.js") ?>"></script>

    <!-- IK CSS -->
    <!-- IK JS -->

</head>

<body>
    <!-- header section start -->
    <div class="header_section header_main mb-5">
        <?php
        require "includes/navbar.php";
        ?>
    </div>

    <!-----------------------------------Main Content--------------------------------------------->
    <div class="container basket-container mt-5 mb-5">

        <?php
        if ($productsInBasket['totalProductCount'] > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Ürün Resmi</th>
                            <th class="text-center">Ürün Adı</th>
                            <th class="text-center">Fiyatı</th>
                            <th class="text-center">Adeti</th>
                            <th class="text-center">Toplam</th>
                            <th class="text-center">Sepetten Çıkar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productsInBasket['result'] as $product) {
                            if ($product['productCount']) {
                        ?>
                                <tr class="row-<?= $product['productId'] ?>">
                                    <td class="text-center align-items-center" width="120">
                                        <img src="<?= base_url("img/productImg/" . $product['image']) ?>" alt="" width="50">
                                    </td>
                                    <td class="text-center align-middle"><?php echo $product['name']; ?></td>
                                    <td class="text-center align-middle "><?php echo $product['price']; ?></td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-around align-items-center">
                                            <div class="btn btn-xs btn-success" name="incCount" data-product-id="<?= $product['productId'] ?>">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                            <span class="product-count-<?= $product['productId']; ?>"><?= $product['productCount']; ?></span>
                                            <div class="btn btn-xs btn-danger" name="decCount" data-product-id="<?= $product['productId'] ?>">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="text-center align-middle"><span class="total-product-price-<?= $product['productId']; ?>"><?= $product['productCount'] * $product['price']; ?></span></td>
                                    <td class="align-middle" width="120">
                                        <button class="btn btn-sm btn-danger" name="remove" data-product-id="<?php echo $product['productId']; ?>">
                                            <span class="glyphicon glyphicon-remove"></span> Sepetten Çıkar
                                        </button>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-right">Toplam Ürün : <span class="color-danger total-all-product-count"><?= $productsInBasket['totalProductCount']; ?></span></th>
                            <th colspan="4" class="text-right">Toplam Fiyat : <span class="color-danger total-all-product-price"><?= $productsInBasket['totalProductPrice']; ?></span></th>
                        </tr>
                    </tfoot>
                </table>

                <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
                    <button class="btn btn-secondary mb-2 mb-md-0" id="continue-shopping">Alışverişe Devam Et</button>
                    <button class="btn btn-success" id="checkout"><a href="<?= base_url("payment/paymentDetails"); ?>">Ödeme Yap</a></button>
                </div>

            </div>
        <?php } else { ?>
            <div class="alert alert-info text-center">
                <strong>Sepetinizde ürün bulunmamaktadır. Eklemek için <a href="<?= base_url('ourPackages'); ?>">tıklayınız.</a></strong>
            </div>
        <?php } ?>
    </div>

    <?php include 'includes/footer.php' ?>

    <!-----------------------------------#Main Content--------------------------------------------->
    <script src="custom.js"></script>
    <script src="https://kit.fontawesome.com/58fa979664.js" crossorigin="anonymous"></script>
</body>

</html>