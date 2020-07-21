<?php
session_start();
require_once("func.php");
try {
    if (empty($_POST["reps"]) || empty($_FILES["upload-img"])) {
        throw new Exception("Nebyla předána data.");
    }

    $reps = (int) $_POST["reps"];
    $uploaded_file = $_FILES["upload-img"];
    $target_file = $DIR_MEDIA . get_filename_new($reps);
    $error = false;

    if (getimagesize($uploaded_file["tmp_name"]) === false) {
        throw new Exception("Soubor není validní obrázek.");
    }

    if ($uploaded_file["size"] > 800000) {
        throw new Exception("Velikost souboru přesahuje 800kB.");
    }

    if (strtolower(pathinfo($target_file, PATHINFO_EXTENSION)) != "jpg") {
        throw new Exception("Nahrávejte pouze JPG obrázky co nejmenší velikosti.");
    }

    $result = move_uploaded_file($uploaded_file["tmp_name"], $target_file);
    if (!$result) {
        throw new Exception("Chyba nahrávání souboru.");
    }
    resize_file($target_file);
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
} finally {
    header("Location: index.php");
}