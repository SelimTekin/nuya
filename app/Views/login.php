<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/header.php'; ?>
    <!-- IK CSS -->
    <!-- IK JS -->
</head>
<!-- body -->

<body class="main-layout">
    <!-- header section start -->
    <div class="header_section header_main">
        <?php
        require "includes/navbar.php";
        ?>
    </div>
    <!-- contact section start -->
    <div class="layout_padding contact_section">
        <div class="container">
            <h1 class="new_text text-center"><strong>Giriş Yap</strong></h1>
        </div>
        <div class=" ram">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="email_box bg-white" style="width:100%">
                        <div class="container" style="display:flex;justify-content:center">
                            <div class="input_main w-50">
                                <form action="<?= base_url("login"); ?>" method="post">
                                    <div class="form-group pt-4">
                                        <input type="email" class="email-bt" placeholder="Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="email-bt" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group w-100 d-flex" style="justify-content:center;margin-bottom:0">
                                        <button type="submit" class="main_bt bg-dark" style="border-radius: 15px">Login</button>
                                    </div>
                                    <div class="form-group">
                                        <a href="<?= base_url("sifremi-unuttum-form"); ?>" style="color:#000;justify-content:center" class="d-flex" >Şifremi unuttum</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact section end -->
    <?php
    require "includes/footer.php";
    ?>

</body>

</html>