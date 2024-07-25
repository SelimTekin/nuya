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
            <h1 class="new_text text-center"><strong>Kayıt Ol</strong></h1>
        </div>
        <div class="container-fluid ram">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="email_box bg-white" style="width:100%">
                        <div class="container" style="display:flex;justify-content:center">
                            <div class="input_main w-50">
                                <form action="<?= base_url("signup")?>" method="post">
                                    <div class="form-group pt-4">
                                        <input type="email" class="email-bt" placeholder="Mail" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="email-bt" placeholder="Şifre" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="İsim" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Soy İsim" name="surname" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Telefon Numarası" name="telephoneNumber" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="nice-select" name="gender" id="gender">
                                            <option value="erkek">Erkek</option>
                                            <option value="kadin">Kadın</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="main_bt bg-dark" style="border-radius:15px">Kayıt ol</button>
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