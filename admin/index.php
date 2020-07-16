<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LED Reklama Sněhulák</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/bootstrap-4.5.0-dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src="../assets/jquery-3.5.1.min.js"></script>
    <script src="../assets/popper.min.js"></script>
    <script src="../assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <?php
        require_once("func.php");

        require_once("navbar.php");
        if(isset($_SESSION['message']) && !empty($_SESSION['message'])) {   
            print("<script>alert('".$_GET['error']."');</script>");
            unset($_SESSION['message']);
        }
    ?>
    <div class="container-fluid">
        <?php foreach($REPS as $reps): ?>
            <div class="row p-3">
                <?php 
                    $title = "Zobrazení: $reps.x za hodinu";
                    if($reps == 1) $title = "Doplňující reklamy";
                ?>
                <h3 class="d-block w-100"><?php echo $title; ?></h3>
                <div class="d-flex flex-wrap flex-row align-items-center">
                    <?php foreach (get_files($reps) as $filename): ?>
                        <div class="rounded thumbnail mb-2 mr-3 border">
                            <img src="<?php echo "../media/".$filename."?".time(); ?>" alt="<?php echo $filename; ?>">                
                            <div class="overlay">
                            <form method="POST" action="remove-handle.php" enctype="multipart/form-data">
                                <input type="hidden" name="remove-img" value="<?php echo "../media/".$filename; ?>" />
                                <button class="button-control button-remove" type="submit" title="Smazat">x</button>
                            </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="rounded thumbnail mb-2 mr-3 border">
                        <div class="overlay no-transition">
                            <form method="POST" action="upload-handle.php" enctype="multipart/form-data">
                                <input type="hidden" name="reps" value="<?php echo $reps; ?>" />
                                <input type="file" name="upload-img" class="d-none" />
                                <button class="button-control button-add" type="button" title="Přidat">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>    
</body>

</html>