<!-- IK ALERT -->
    <?php
    if ($actionName != "") {
    ?>
        <div class="bg-<?= $actionStatus; ?> text-light IKalert">
            <?= $action ?>
        </div>
    <?php
    }
    ?>