<div class="w-100 d-flex" style="background-color:#393A47;height: 50px;position:relative;z-index: 999;">
    <div class="rightMenu" name="false" style="margin-left:20px;line-height: 50px;">
        <span class="rightMenuSpan"> <i class="fa-solid fa-circle-chevron-left"></i></span>
    </div>
    <div class="fpanelLogo text-light" style="margin-left:25px;line-height: 50px;">
    <?php
        if(isset($whichLocations)){
            $myClass = "whichLocations";
        }else{
            $myClass = "whichLocationsSelected";
        }
    ?>
        <a class="<?= $myClass; ?>" href="<?= base_url("Fpanel/Panel") ?>">Panel</a>
        <span>
            <?php
            if (isset($whichLocations)) {
                $myLenght = count($whichLocations);
                foreach ($whichLocations as $key => $whichLocation) {
                    $name       = $whichLocation[0];
                    $location   = $whichLocation[1];
                    if(($key +1) == $myLenght){
                        $myClass = "whichLocationsSelected";
                    }else{
                        $myClass = "whichLocations";
                    }
            ?>
                    <i class="fa-solid fa-greater-than mx-2"></i>
                    <a class="<?= $myClass; ?>" href="<?= base_url("Fpanel/" . $location); ?>"><?= $name ?></a>
            <?php
                }
            }
            ?>
        </span>
    </div>
    <?php
        if(isset($activeLanguages)){
            $otherMargin = "";
            ?>
                <div style="margin-left:auto;margin-right:10px;line-height: 40px;margin-top:5px;margin-bottom:5px;padding:0px 10px!important;border-color:#636579" class="text-light btn btn-outline-secondary">
                <button class="dropdown-toggle dropdownAfterClear px-3" style="background-color: transparent;height:100%;border:0;color:white;line-height:40px" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa-solid fa-language" title="Dil"></i>  <?= "Dil"; ?>
                </button>
                <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
                    <?php
                    foreach($activeLanguages as $language){
                        ?>
                        <a class="dropdown-item" onclick="languageChange('<?= $language->languageCode; ?>')" style="cursor:pointer"><?= $language->name; ?></a>
                        <?php
                    }          
                    ?>
                </div>
                </div>
            <?php
        }else{
            $otherMargin = "margin-left:auto";
        }
    ?>
    <div style="<?= $otherMargin; ?>;margin-right:10px;line-height: 40px;margin-top:5px;margin-bottom:5px;padding:0px 10px!important;border-color:#636579" class="text-light btn btn-outline-secondary goInLink" name="/">
        <i class="fa-solid fa-house" style="color:#F4F5FD"></i>
    </div>
    <div style="margin-right:10px;line-height: 40px;margin-top:5px;margin-bottom:5px;padding:0px 10px!important;border-color:#636579" class="text-light btn btn-outline-secondary goInLink" name="Fpanel/Admin/leave">
        <i class="fa-solid fa-arrow-right-from-bracket" style="color:#F4F5FD"></i>
    </div>
</div>