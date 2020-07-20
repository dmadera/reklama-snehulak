<?php set_time_limit(360); ?>
<!DOCTYPE html>
<html>

<?php require_once("header.php"); ?>

<body>
    <?php
    require_once("func.php");
    require_once("navbar.php");
    require_once("lock.php");
    try {
        if (!FileLocker::lockFile($LOCK_FILE)) {
            throw new Exception("Nepodařilo se získat zámek.");
        }
        generate_animation(get_complete_slots(), $INTERVAL, $ANIMATION_FILE);
        echo '<div class="alert alert-primary" role="alert">Generování proběhlo úspěšně.</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">Generování animace selhalo!</div>';
        echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
    } finally {
        FileLocker::unlockFile($LOCK_FILE);
    }