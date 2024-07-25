<?php
if (isset($whichExtras)) {
?>
    <div class="whichExtra text-light d-flex justify-content-end">
        <div style="background-color: rgba(57, 58, 71, 0.8);padding:10px;display:inline-block;padding-left:20px;border-top-left-radius:10px;border-bottom-left-radius:10px" class="d-flex">
            <?php
            foreach ($whichExtras as $key => $whichExtra) {
                $extraStyle = "";
                if($key != 0){
                    $extraStyle = "border-left:1px dashed white";
                }
            ?>
                <div class="goInLink mx-2" style="<?= $extraStyle; ?>;padding-left:20px;font-weight:bold" name="Fpanel/<?= $whichExtra[1] ?>">
                    <?= $whichExtra[0] ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
}
?>