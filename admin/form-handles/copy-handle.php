<?php
session_start();
require_once("../logic/func-files.php");
try {
    if (empty($_POST["source"]) || !isset($_POST["reps"]) || !isset($_POST["position"])) {
        throw new Exception("Nebyla předána data.");
    }

    $reps = (int) $_POST["reps"];
    $position = (int) $_POST["position"];
    $source_filename = $_POST["source"];
    copy_filename($source_filename, $reps, $position);
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    print($e->getMessage);
} finally {
    header("Location: ../index.php");
}