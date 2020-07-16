<?php
$DIR = realpath(dirname(__FILE__))."/../media/";
$ANIMATION_FILE = $DIR."animation.gif";
$REPS = array(40, 20, 10, 1);
$SLOT_LIMIT = 10;
$INTERVAL = 9;
$WIDTH = 1120;
$HEIGHT = 640;

function get_files($reps) {
    global $DIR;

    $files = array_diff(scandir($DIR), array('..', '.'));
    return array_values(array_filter($files, function ($element) use ($reps) { 
        return strpos($element, 'img-'.$reps.'-') === 0; 
    }));
}

function new_filename($reps) {
    $files = get_files($reps);    
    preg_match('/img-[0-9]+-([0-9]+)\.jpg/', end($files), $matches); 
    $last_num = (int) $matches[1];
    return 'img-'.$reps.'-'.($last_num+1).'.jpg';
}

function get_slots() { 
    global $REPS, $SLOT_LIMIT;

    $slots = array();
    foreach($REPS as $reps) {
        $files = get_files($reps);
        foreach ($files as $file) {
            for($i = 0; $i < ($reps/10); $i++) {
                $tmp_i = $i;
                if(count($slots[$i]) == $SLOT_LIMIT)
                    $tmp_i = $i+1;
                $slots[$tmp_i][] = $file;
            }
        }
    }
    return $slots;
}

function get_complete_slots() {
    global $SLOT_LIMIT;

    $slots = get_slots();
    
    $reps = 1;
    $files = get_files($reps);
    $c_files = count($files);
    if(count($files) == 0) return $slots;

    $z = 0;
    for($i = 0; $i < 4; $i++) {
        for($y = 0; $y < $SLOT_LIMIT; $y++){
            if(!empty($slots[$i][$y])) continue;

            $slots[$i][$y] = $files[$z];
            $z = ($z+1) % $c_files;
        }  
    }
    return $slots;
}

function print_slots($slots) {
    foreach ($slots as $slot) {
        print('<p>'.implode(' | ', $slot).'</p>');
    }    
}

function generate_animation($slots, $delay, $dest) {
    global $DIR;
    $tmp_animations = array();
    foreach($slots as $slot) {
        $target = tempnam(sys_get_temp_dir(), 'animation').".gif";
        array_push($tmp_animations, $target);
        $prefixed_slot = preg_filter('/^/', $DIR, $slot);
        $images = implode(" ", $prefixed_slot);
        $cmd = sprintf("convert -delay %d %s -loop 0 %s", $delay*100, $images, $target);
        $result = shell_exec($cmd);
        if(!empty($result)) throw new Exception($result);
    }
    
    $images = implode(" ", $tmp_animations);
    $cmd = sprintf("convert %s -loop 0 %s", $images, $dest);
    $result = shell_exec($cmd);
    foreach($tmp_animations as $tmpfile) {
        if(is_file($tmpfile))
            unlink($tmpfile);
    }

    if(!empty($result)) throw new Exception($result);
}
