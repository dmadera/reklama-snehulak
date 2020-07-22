<?php
$DIR_MEDIA = realpath(dirname(__FILE__)) . "/../media/";
$ANIMATION_FILE = $DIR_MEDIA . "animation.gif";
$LOCK_FILE = $DIR_MEDIA . "lock";
$SIZE_FILE = $DIR_MEDIA . "size-animation";
$REPS = array(40, 20, 10, 0);
$SLOT_LIMIT = 10;
$SLOTS_COUNT = 40;
$SLOT_COUNT = $SLOTS_COUNT / $SLOT_LIMIT;
$INTERVAL = 9;
$WIDTH = 1120;
$HEIGHT = 640;

function get_files($reps)
{
    global $DIR_MEDIA;

    $files = array_diff(scandir($DIR_MEDIA), array('..', '.'));
    return array_values(array_filter($files, function ($element) use ($reps) {
        return strpos($element, 'img-' . $reps . '-') === 0;
    }));
}

function get_filename_index($filename)
{
    preg_match('/img-[0-9]+-([0-9]+)\.jpg/', $filename, $matches);
    return (int) $matches[1];
}

function get_filename_reps($filename)
{
    preg_match('/img-([0-9]+)-[0-9]+\.jpg/', $filename, $matches);
    return (int) $matches[1];
}

function get_filename($reps, $index)
{
    return 'img-' . $reps . '-' . $index . '.jpg';
}

function get_filename_new($reps)
{
    $files = get_files($reps);
    if (count($files) == 0) {
        return 0;
    }
    $last_num = get_filename_index(end($files));
    return get_filename($reps, $last_num + 1);
}

function find_start_index(&$slots)
{
    global $SLOT_LIMIT, $SLOT_COUNT, $SLOTS_COUNT;

    $counts_slots = array_fill(0, $SLOT_COUNT, 0);
    $index = 0;
    foreach ($slots as $key => $slot) {
        if ($slot !== -1) {
            $counts_slots[$index] += 1;
        }
        if (($key + 1) % $SLOT_LIMIT === 0) {
            $index++;
        }
    }

    $max = $SLOT_LIMIT;
    for ($i = count($counts_slots) - 1; $i >= 0; $i--) {
        if ($counts_slots[$i] <= $max) {
            $start_index = $counts_slots[$i] + $i * $SLOT_LIMIT;
            $max = $counts_slots[$i];
        }
    }
    return $start_index >= $SLOTS_COUNT ? false : $start_index;
}

function get_slots()
{
    global $REPS, $SLOTS_COUNT, $SLOT_LIMIT;

    $slots = array_fill(0, $SLOTS_COUNT, -1);

    foreach ($REPS as $reps) {
        if ($reps == 0) continue;

        $files = get_files($reps);
        $slots_reps = (int) $reps / $SLOT_LIMIT;

        foreach ($files as $file) {
            $s_index = find_start_index($slots);
            if ($s_index === false) {
                return $slots;
            }
            for ($i = 0; $i < $slots_reps; $i++) {
                $index = $s_index + $i * ($SLOTS_COUNT / $slots_reps);
                if ($slots[$index] === -1) {
                    $slots[$index] = $file;
                } else {
                    throw new Exception("nepovolený přepis hodnoty, start_index: $s_index, index: $index");
                }
            }
        }
    }
    return $slots;
}

function get_count_free_slots(&$slots)
{
    $count = 0;
    foreach ($slots as $slot) {
        if ($slot === -1) {
            $count++;
        }
    }
    return $count;
}

function move_slot_vals(&$slots, $index)
{
    global $SLOTS_COUNT;

    $free_next_index = -1;
    for ($i = $index; $i < $SLOTS_COUNT; $i++) {
        if ($slots[$i] == -1) {
            $free_next_index = $i;
            break;
        }
    }

    if ($free_next_index === -1) return false;

    for ($i = $free_next_index; $i > $index; $i--) {
        $slots[$i] = $slots[$i - 1];
    }
    $slots[$index] = -1;

    return $slots;
}

function get_complete_slots()
{
    $slots = get_slots();
    return $slots;
}

function get_output_slots(&$slots)
{
    $out = "";
    foreach ($slots as $key => $slot) {
        $out .= $slot . " | ";
        if (($key + 1) % 10 === 0) {
            $out .= "<br>";
        }
    }
    return $out;
}

function generate_animation($slots, $delay, $dest)
{
    global $DIR_MEDIA, $SLOT_LIMIT, $SLOTS_COUNT;
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

function rename_files_by_array($reps, &$files)
{
    global $DIR_MEDIA;

    $index = 0;
    foreach ($files as &$file) {
        if (file_exists($DIR_MEDIA . $file)) {
            rename($DIR_MEDIA . $file, $DIR_MEDIA . $file . ".bak");
        }
    }

    foreach ($files as &$file) {
        $new_filename = get_filename($reps, $index);
        if (file_exists($DIR_MEDIA . $file . ".bak")) {
            rename($DIR_MEDIA . $file . ".bak", $DIR_MEDIA . $new_filename);
        }
        $file = $new_filename;
        $index++;
    }
}

function make_space_between_files($reps, $position)
{
    $files = get_files($reps);
    if ($position > count($files)) $position = count($files);
    $new_filename = get_filename($reps, $position);
    array_splice($files, $position, 0, array($new_filename . ".new"));
    rename_files_by_array($reps, $files);
    return $new_filename;
}

function rename_filename($src_filename, $dest_filename)
{
    global $DIR_MEDIA;

    $src_path = $DIR_MEDIA . $src_filename;
    $dest_path = $DIR_MEDIA . $dest_filename;
    if (!file_exists($src_path)) {
        throw new Exception("invalid files to move");
    }

    if (file_exists($dest_filename)) {
        throw new Exception("destination exists");
    }

    rename($src_path, $dest_path);
}

function duplicate_filename($src_filename, $dest_filename)
{
    global $DIR_MEDIA;

    $src_path = $DIR_MEDIA . $src_filename;
    $dest_path = $DIR_MEDIA . $dest_filename;
    if (!file_exists($src_path)) {
        throw new Exception("invalid files to copy");
    }

    if (file_exists($dest_filename)) {
        throw new Exception("destination exists");
    }

    copy($src_path, $dest_path);
}

function remove_filename($filename)
{
    global $DIR_MEDIA;

    $path = $DIR_MEDIA . $filename;
    if (file_exists($path)) {
        unlink($path);
    } else {
        throw new Exception("Soubor nebyl nalezen.");
    }
}

function move_filename($src_filename, $dest_reps, $dest_pos)
{
    $dest_filename = make_space_between_files($dest_reps, $dest_pos);
    // check if make_space_between_files is changed source file
    $src_index = get_filename_index($src_filename);
    $src_reps = get_filename_reps($src_filename);
    if ($src_reps == $dest_reps && $dest_pos < $src_index) {
        $src_filename = get_filename($src_reps, $src_index + 1);
    }
    rename_filename($src_filename, $dest_filename);
}

function copy_filename($src_filename, $dest_reps, $dest_pos)
{
    $dest_filename = make_space_between_files($dest_reps, $dest_pos);
    // check if make_space_between_files is changed source file
    $src_index = get_filename_index($src_filename);
    $src_reps = get_filename_reps($src_filename);
    if ($src_reps == $dest_reps && $dest_pos < $src_index) {
        $src_filename = get_filename($src_reps, $src_index + 1);
    }
    duplicate_filename($src_filename, $dest_filename);
}

function resize_file($file)
{
    global $WIDTH, $HEIGHT;

    $cmd = sprintf("convert '%s' -resize %dx%d\! '%s'", $file, $WIDTH, $HEIGHT, $file . ".bak");
    $result = shell_exec($cmd);
    if (!file_exists($file . ".bak")) throw new Exception("File $file.bak doesn't exist.");

    if (file_exists($file)) unlink($file);

    rename($file . ".bak", $file);

    if (!empty($result)) throw new Exception($result);
}