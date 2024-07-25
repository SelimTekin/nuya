<link rel="stylesheet" href="<?= base_url("css/topBar.css") ?>">
<nav class="bg-dark">
  <div class="container d-flex justify-content-between">
    <div class="text-light h-100" style="margin-left:5px;line-height:43px">
      <div class="h-100 my-2">
        <button type="button" name="ourPackages" class="insetButton d-flex px-3 goInLink" style="line-height:35px">
          <?= $minLanguage->menu ?>
        </button>
      </div>
    </div>
    <div class="btn-group my-2">
      <button class="btn btn-secondary dropdown-toggle insetButton px-3" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?= $minLanguage->language; ?>
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
    <div class="text-light h-100" style="margin-left:5px;line-height:43px">
      <div class="h-100 my-2">
        <button type="button" name="Fpanel/panel" class="d-flex px-3 goInLink insetButtonDanger" style="line-height:35px">
          <i class="fa-solid fa-user-tie" style="height:35px;line-height:35px"></i>
        </button>
      </div>
    </div>
</nav>