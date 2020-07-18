<?php
$DIR_MEDIA = realpath(dirname(__FILE__)) . "/../media/";
$ANIMATION_FILE = $DIR_MEDIA . "animation.gif";
$REPS = array(40, 20, 10, 1);
$SLOT_LIMIT = 10;
$SLOT_COUNT = 4;
$SLOTS_COUNT = 40;
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

function find_start_index(&$array, $value)
{
    foreach ($array as $key => $value) {
        if ($value === -1) {
            return $key;
        }
    }
    return false;
}

function get_slots()
{
    global $REPS, $SLOTS_COUNT, $SLOT_LIMIT;

    $slots = array_fill(0, $SLOTS_COUNT, -1);

    foreach ($REPS as $reps) {
        if ($reps == 1) continue;

        $files = get_files($reps);
        $slots_reps = (int) $reps / $SLOT_LIMIT;

        foreach ($files as $file) {
            $s_index = find_start_index($slots, -1);
            if ($s_index === false) {
                return $slots;
            }
            for ($i = 0; $i < $slots_reps; $i++) {
                $index = $s_index + $i * ($SLOTS_COUNT / $slots_reps);
                if ($slots[$index] == -1) {
                    $slots[$index] = $file;
                } else {
                    throw new Exception("nepovolený přepis hodnoty");
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
    global $SLOTS_COUNT;

    $slots = get_slots();

    $files = get_files(1);
    $n_files = count($files);
    $n_free_slots = get_count_free_slots($slots);
    $n_placements_file = (int) $n_free_slots / $n_files;
    $step = $SLOTS_COUNT / $n_placements_file;

    foreach ($files as $file) {
        for ($i = 0; $i < $n_placements_file; $i++) {
            $index = $i * $step;
            move_slot_vals($slots, $index);
            $slots[$index] = $file;
        }
    }

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
    for($i = 0; $i < $SLOTS_COUNT; $i+=$SLOT_LIMIT) {
        $slot = array_splice($slots, $i, $SLOT_LIMIT);
        $target = tempnam(sys_get_temp_dir(), 'animation') . ".gif";
        array_push($tmp_animations, $target);
        $prefixed_slot = preg_filter('/^/', $DIR_MEDIA, $slot);
        $images = implode(" ", $prefixed_slot);
        $cmd = sprintf("convert -delay %d %s -loop 0 %s", $delay * 100, $images, $target);
        $result = shell_exec($cmd);
        if (!empty($result)) throw new Exception($result);
    }

    $images = implode(" ", $tmp_animations);
    $cmd = sprintf("convert %s -loop 0 %s", $images, $dest);
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
    rename_filename($src_filename, $dest_filename);
}
