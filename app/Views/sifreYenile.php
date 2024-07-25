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
            <h1 class="new_text"><strong>Şifre Yenile</strong></h1>
        </div>
        <div class="container-fluid ram">
            <div class="row">
                <div class="col-md-6">
                    <div class="email_box">
                        <div class="input_main">
                            <div class="container">
                                <form action="<?= base_url('sifre-yenile/') . $email . '/' . $activationCode ?>" method="post">
                                    <div class="form-group">
                                        <input type="password" class="email-bt" placeholder="Şifre" name="password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="email-bt" placeholder="Şifre Tekrar" name="passwordAgain">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="main_bt">Şifre Yenile</button>
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