<?php

session_start();
require_once("../logic/func-files.php");
$file = "../.config.interval";
try {
    if (empty($_POST["interval"])) {
        throw new Exception("Nebyla předána data.");
    }
    $interval = (float) $_POST["interval"];
    file_put_contents($file, number_format($interval, 1));
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    print($e->getMessage);
} finally {
    header("Location: ../index.php");
}
