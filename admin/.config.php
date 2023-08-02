<?php
$DIR_MEDIA = realpath(dirname(__FILE__)) . "/../media/";
$ANIMATION_FILE = $DIR_MEDIA . "animation.gif";
$LOCK_FILE = $DIR_MEDIA . "lock";
$REPS = array(60, 30, 15, 0);
$SLOT_LIMIT = 15;
$SLOTS_COUNT = 60;
$SLOT_COUNT = $SLOTS_COUNT / $SLOT_LIMIT;
$INTERVAL = 7.5;
$WIDTH = 1120;
$HEIGHT = 640;

$FILE_INTERVAL = realpath(dirname(__FILE__))."/.config.interval"; 
if(is_file($FILE_INTERVAL)) {
    $i  = (float) file_get_contents($FILE_INTERVAL);
    if ($i >= 1 && $i <= 60) {
        $INTERVAL = $i;
    }
}
