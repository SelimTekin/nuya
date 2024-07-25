<?php
  use App\Models\SettingModel;
  $Setting  = new SettingModel();
  $settings = $Setting->getSettings();

  helper("fonksiyonlar"); 
?>

<footer class="bg-dark text-center text-white">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    <?= RestoreTransformations($settings->siteCopyright); ?>
  </div>
</footer>
