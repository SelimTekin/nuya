<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'includes/header.php'; ?>
    <!-- IK CSS -->
    <!-- IK JS -->
    <script src="<?= base_url("js/userAccount.js") ?>"></script>
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
        <div class="d-flex">
            <div class="col-6">
                <h1 class="new_text px-4"><strong>Hesabım</strong></h1>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link">
                                    Kullanıcı Bilgilerim
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <form id="userInformationForm" action="<?= base_url("save-user-data") ?>" method="post">
                                    <div class="form-group">
                                        <input type="email" class="email-bt" placeholder="E-posta" name="email" value="<?= $userInfo['email'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="İsim" name="name" value="<?= $userInfo["name"] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Soyisim" name="surname" value="<?= $userInfo["surname"] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Telefon Numarası" name="telephoneNumber" value="<?= $userInfo['telephoneNumber'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="nice-select" name="gender" id="gender">
                                            <option value="erkek" <?= $userInfo['gender'] == 'erkek' ? 'selected' : ''; ?>>Erkek</option>
                                            <option value="kadin" <?= $userInfo['gender'] == 'kadin' ? 'selected' : ''; ?>>Kadın</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <h1 class="new_text px-4"><strong>Adresim</strong></h1>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link">
                                    Adres Bilgilerim
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <form id="userInformationForm" action="<?= base_url("save-user-address-data/" . $addressInfo[0]["id"]); ?>" method="post">
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="İsim Soyisim" name="nameSurname" value="<?= $addressInfo[0]['nameSurname'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Address" name="address" value="<?= $addressInfo[0]["address"] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="town" name="town" value="<?= $addressInfo[0]["town"] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="city" name="city" value="<?= $addressInfo[0]['city'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="email-bt" placeholder="Telefon Numarası" name="telephoneNumber" value="<?= $addressInfo[0]['telephoneNumber'] ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
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