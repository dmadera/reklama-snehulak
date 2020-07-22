<?php session_start(); ?>
<!DOCTYPE html>
<html>

<?php require_once("layout/header.php"); ?>

<body>
    <?php
    require_once("logic/func-files.php");
    require_once("layout/navbar.php");
    ?>
    <div class="container-fluid">
        <div class="p-2 animation text-center">
            <img src="../media/animation.gif?time=<?php echo time(); ?>" class="m-5 border w-50" />
            <div class="d-flex mb-5 flex-wrap flex-row align-items-center">
                <?php
                $slots = get_complete_slots();
                foreach ($slots as $key => $slot) {
                    if ($slot !== -1) {
                        echo sprintf('<img src="../media/%s?time=%d" class="mr-1 mb-1 d-block thumbnail-animation" />', $slot, time());
                    }
                    if (($key + 1) % $SLOT_LIMIT === 0) {
                        echo '<div class="break"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>