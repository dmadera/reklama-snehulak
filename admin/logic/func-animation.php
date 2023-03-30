<?php
require_once(realpath(dirname(__FILE__)) . "/../.config.php");

function generate_animation($slots, $delay, $dest)
{
    global $DIR_MEDIA, $SLOT_LIMIT;
    $tmp_animations = array();
    $input_images = array();
    foreach ($slots as $key => $slot) {
        if ($slot !== -1) {
            array_push($input_images, $DIR_MEDIA . $slot);
        }
        if (($key + 1) % $SLOT_LIMIT === 0) {
            $input_images_str = implode(" ", $input_images);
            $target = tempnam(sys_get_temp_dir(), 'animation') . ".gif";
            array_push($tmp_animations, $target);
            $cmd = sprintf("convert -delay %d %s -loop 0 '%s'", $delay * 100, $input_images_str, $target);
            $result = shell_exec($cmd);
            $input_images = array();
            if (!empty($result)) throw new Exception($result);
        }
    }

    $input_images_str = implode(" ", $tmp_animations);
    $cmd = sprintf("convert %s -loop 0 '%s'", $input_images_str, $dest);
    $result = shell_exec($cmd);
    foreach ($tmp_animations as $tmpfile) {
        if (is_file($tmpfile))
            unlink($tmpfile);
    }

    if (!empty($result)) throw new Exception($result);
}