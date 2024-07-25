<link rel="stylesheet" href="<?= base_url("css/Fpanel/leftbar.css") ?>">
<?php
if (isset($_COOKIE["openLeft"])) {
  $incomingLeft = $_COOKIE["openLeft"];
} else {
  $incomingLeft = "true";
}
if ($incomingLeft == "false") {
  $rightName        = "false";
  $leftAreaStyle    = "100%";
  $leftMenuSpan     = "inline-block";
  $rightMenuRotate  = 'rotate(0deg)';
  $leftOwner      = 'col-5 col-md-3 col-lg-2';
  $centerOwner    = 'col-7 col-md-9 col-lg-10 centerOwner';
} else if ($incomingLeft == "true") {
  $rightName        = "true";
  $leftAreaStyle    = "75px";
  $leftMenuSpan     = "none";
  $rightMenuRotate  = 'rotate(180deg)';
  $leftOwner      = 'col-2 col-lg-1';
  $centerOwner    = 'col-10 col-lg-11 centerOwner';
} else {
  $rightName        = "none";
  $leftAreaStyle    = "75px";
  $leftMenuSpan     = "none";
  $rightMenuRotate  = 'rotate(-90deg)';
  $leftOwner        = 'col-0';
  $centerOwner      = 'col-12 centerOwner';
}
?>
<script>
  $(document).ready(function() {
    $(".rightMenu").attr("name", '<?= $rightName ?>');
    $(".rightMenu").children(".rightMenuSpan").children("i").css("transform", '<?= $rightMenuRotate; ?>');
    $(".centerOwner").attr("class", '<?= $centerOwner ?>');
  });
</script>
<?php // [name, url, Icon]
$webSetting       = [
  ["Panel",  "Fpanel/Panel", "fa-solid fa-square-poll-vertical"],
  ["Site Ayarları", "Fpanel/Setting", "fa-solid fa-gears"],
];
$menuSetting      = [
  ["Kategoriler", "Fpanel/Category", "fa-solid fa-folder-tree"],
  ["Siparişler", "Fpanel/Orders", "fa-solid fa-file-lines"],
];
$ownerSetting     = [
  ["Dil", "Fpanel/Language", "fa-solid fa-language"],
  ["Yönetim", "Fpanel/Owner", "fa-solid fa-ticket"],
];
$allLeftSettings      = [$webSetting, $menuSetting, $ownerSetting];
?>
<div class="leftOwner <?= $leftOwner; ?>" <?php if ($incomingLeft == "none") {
                                            echo "style='display:none'";
                                          } ?>>
  <div class="leftArea ik_bg_blue_four" style="width:<?= $leftAreaStyle; ?>">
    <?php
    foreach ($allLeftSettings as $settingsTopKey => $leftSettings) {
      foreach ($leftSettings as $leftSetting) {
    ?>
        <div class="leftMenu">
          <a class="rightMenuA" href="<?= base_url($leftSetting[1]) ?>">
            <i class="<?= $leftSetting[2]; ?>" title="<?= $leftSetting[0]; ?>"></i> <span style="display:<?= $leftMenuSpan ?>"><?= $leftSetting[0]; ?></span>
          </a>
        </div>
      <?php
      }
      if ($settingsTopKey != (count($allLeftSettings) - 1)) {

      ?>

        <hr style="color:white">
    <?php
      }
    }
    ?>
  </div>
</div>