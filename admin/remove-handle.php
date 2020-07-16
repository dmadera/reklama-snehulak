<?php
session_start();
try {
    if(empty($_POST["remove-img"])) {
        throw new Exception("Nebyly předána data.");
    }

    $file = $_POST['remove-img'];
    if(file_exists($file)) {
        unlink($file);
    } else {
        throw new Exception("Soubor nebyl nalezen.");
    }
} catch(Exception $e) {
    $_SESSION['message'] = $e->getMessage();
} finally {
    header("Location: index.php");
}
?>
