<!doctype html>
<html lang="tr">

<head>

    <?php include 'includes/header.php'; ?>
    <!-- IK CSS -->
    <!-- IK JS -->
    <!-- <script src="<?= base_url("js/Fpanel/categoryFligran.js"); ?>"></script> -->
    <?php helper("category"); ?>

</head>


<body onload="fligranActive(this)" hrf="<?= base_url("img/serverLogo/" . $settings->siteLogo); ?>">
    <div class="bg-dark" style="background-color:black;border-bottom:2px dashed grey">
        <div class="d-flex container" style="width:100%;height:120px;">
            <div class="col-3 col-mg-2 col-lg-1" style="line-height:120px"><img style="height:100px;line-height:120px" src="<?= base_url("img/serverLogo/" . $settings->siteLogo) ?>" alt="Site Logo" title="Site Logo"></div>
            <div class="text-center" style="width:100%;font-size:30px;color:white;line-height:120px">
                <?= $settings->siteName; ?>
            </div>
        </div>
    </div>
    <div class=" container" style="z-index:10000;position:relative">
        <?= mainWritePage($myData); ?>
    </div>
    <!-- <?php include 'includes/footer.php' ?> -->
</body>

</html>