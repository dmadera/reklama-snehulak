<?php
    set_time_limit(60);
    require_once("../func.php");
    try {
        generate_animation(get_complete_slots(), $INTERVAL, $ANIMATION_FILE);
        header("Location: ../player.php");
    } catch(Exception $e) {
        echo "Generování animace neproběhlo v pořádku.<br>";
        echo $e->getMessage();
    }
?>