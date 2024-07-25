<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo"><a href="#"><img src="<?= base_url("images/logo.png") ?>"></a></div>
        </div>
        <div class="col-sm-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="<?= base_url(); ?>">Pullo</a>
                        <a class="nav-item nav-link" href="<?= base_url("home/collection") ?>">Koleksiyonlar</a>
                        <a class="nav-item nav-link" href="<?= base_url("ourPackages") ?>">Ürünler</a>
                        <?php
                        if (isset($userDetails)) {
                        ?>
                            <a class="nav-item nav-link" href="<?= base_url("hesabim-form") ?>">Hesabım</a>
                            <a class="nav-item nav-link" href="<?= base_url("cikis-yap") ?>">Çıkış Yap</a>

                        <?php
                        } else {
                        ?>
                            <a class="nav-item nav-link" href="<?= base_url("login") ?>">Giriş</a>
                            <a class="nav-item nav-link" href="<?= base_url("signup") ?>">Üye Ol</a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($userDetails)) {
                        ?>
                            <a class="nav-item nav-link last" href="<?= base_url("basket") ?>"><img src="<?= base_url("images/shop_icon.png") ?>"></a>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <?php
                if (isset($activeLanguages)) {
                ?>
                    <div class="btn-group my-2">
                        <button class="btn btn-secondary dropdown-toggle insetButton px-3" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Language
                        </button>
                        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
                            <?php
                            foreach ($activeLanguages as $language) {
                            ?>
                                <div class="dropdown-item" onclick="languageChange('<?= $language->languageCode; ?>')" style="cursor:pointer"><?= $language->name; ?></div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }

                ?>
            </nav>
        </div>
    </div>
</div>