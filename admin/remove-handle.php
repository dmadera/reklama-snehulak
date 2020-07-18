<?php
session_start();
require_once("func.php");
try {
    if(empty($_POST["remove-img"])) {
        throw new Exception("Nebyly předána data.");
    }

    $file = $_POST['remove-img'];
    remove_filename($file);
} catch(Exception $e) {
    $_SESSION['message'] = $e->getMessage();
} finally {
    header("Location: index.php");
}
?>
