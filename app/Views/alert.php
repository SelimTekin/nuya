<?php

$session = \Config\Services::session();
$alert = $session->get("alert");

if ($alert) {
    if ($alert["type"] === "success") { ?>
        <div class="modal fade" id="modalsuccess">
            <div class="modal-dialog modal-dialog-centered text-center " role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body text-center p-4 pb-5">
                        <h4 class="text-success tx-semibold"><?php echo $alert["title"]; ?></h4>
                        <p class="mg-b-20 mg-x-20"><?php echo $alert["description"]; ?></p><button aria-label="Close" class="btn btn-success pd-x-25" data-dismiss="modal">Tamam</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalsuccess').modal('show');
            });
        </script>

    <?php } else if ($alert["type"] === "error") { ?>
        <div class="modal fade" id="modalerror">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body text-center p-4 pb-5">
                        <h4 class="text-danger"><?php echo $alert["title"]; ?></h4>
                        <p class="mg-b-20 mg-x-20"><?php echo $alert["description"]; ?></p><button aria-label="Close" class="btn btn-danger pd-x-25" data-dismiss="modal">Tamam</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalerror').modal('show');
            });
        </script>

    <?php } else if ($alert["type"] === "warning") { ?>
        <div class="modal fade" id="modalwarning">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-body text-center p-4 pb-5">
                        <h4 class="text-warning"><?php echo $alert["title"]; ?></h4>
                        <p class="mg-b-20 mg-x-20"><?php echo $alert["description"]; ?></p><button aria-label="Close" class="btn btn-warning pd-x-25" data-dismiss="modal">Tamam</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalwarning').modal('show');
            });
        </script>
<?php }


    unset($_SESSION["alert"]); # Session'ı unset etmezsek her sayfa yenilendiğinde bize alert verecektir

} ?>