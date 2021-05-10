<?php
session_start();
if ($_SESSION["login"] !== true) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<?php require_once("layout/header.php"); ?>

<body>
    <?php
    require_once(".config.php");
    require_once("logic/func-files.php");
    require_once("layout/navbar.php");

    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        print("<script>alert('" . $_SESSION['message'] . "');</script>");
        unset($_SESSION['message']);
    }
    foreach ($REPS as $reps) {
        $files = get_files($reps);
        rename_files_by_array($reps, $files);
    }
    $slots = get_slots();
    $free_slots = get_count_free_slots($slots);
    ?>
    <div class="container-fluid">
        <?php foreach ($REPS as $reps) : ?>
        <div class="row p-3">
            <?php
                if ($reps == 0) $title = "Vyřazené reklamy";
                else $title = $reps . "x za hodinu <small class='float-right'>volných pozic: " . floor($free_slots / ($reps / 2)) . "</small>";
                ?>
            <h3 class="d-block w-100"><?php echo $title; ?></h3>
            <div class="d-flex flex-wrap flex-row align-items-center">
                <?php foreach (get_files($reps) as $key => $filename) : ?>
                <div class="drop mb-2" data-position="<?php echo $key; ?>" data-reps="<?php echo $reps; ?>"
                    droppable="<?php echo $free_slots >= $reps / 10 || $reps == 0 ? "true" : "false"; ?>"></div>
                <div class="rounded thumbnail mb-2 border">
                    <img src="<?php echo "../media/" . $filename . "?" . time(); ?>" alt="<?php echo $filename; ?>"
                        draggable="true">
                    <div class="overlay <?php echo $reps == 0 ? "notactive" : ""; ?>" draggable="false">
                        <form method="POST" action="form-handles/remove-handle.php" enctype="multipart/form-data">
                            <input type="hidden" name="remove-img" value="<?php echo $filename; ?>" />
                            <button class="button-control button-remove" type="submit" title="Smazat">x</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="drop mb-2" data-position="<?php echo ++$key; ?>" data-reps="<?php echo $reps; ?>"
                    droppable="<?php echo $free_slots >= $reps / 10 || $reps == 0 ? "true" : "false"; ?>"></div>
                <?php if ($free_slots >= $reps / 10 || $reps == 0) : ?>
                <div class="rounded thumbnail mb-2 mr-3 border">
                    <div class="overlay no-transition">
                        <form method="POST" action="form-handles/upload-handle.php" enctype="multipart/form-data">
                            <input type="hidden" name="reps" value="<?php echo $reps; ?>" />
                            <input type="file" name="upload-img" class="d-none" />
                            <button class="button-control button-add" type="button" title="Přidat">+</button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>