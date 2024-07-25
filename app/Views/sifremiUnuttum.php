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
            <h1 class="new_text text-center"><strong>Şifremi Unuttum</strong></h1>
        </div>
        <div class="container-fluid ram">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="email_box bg-white" style="width:100%">
                    <div class="container" style="display:flex;justify-content:center">
                        <div class="input_main w-50">
                                <form action="<?= base_url("sifremi-unuttum"); ?>" method="post">
                                    <div class="form-group pt-4">
                                        <input type="email" class="email-bt" placeholder="E-posta" name="email">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="main_bt bg-dark w-100" style="border-radius: 15px">Aktivasyon Kodu Gönder</button>
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

</body>

</html>