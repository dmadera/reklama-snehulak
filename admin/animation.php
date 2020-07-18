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
    ?>
    <div class="container-fluid">
        <div class="p-2 animation text-center">
            <img src="../media/animation.gif?time=<?php echo time(); ?>" class="m-5 border w-50" />
            <div class="d-flex mb-5 flex-wrap flex-row align-items-center">
                <?php
                $slots = get_complete_slots();
                foreach($slots as $key => $slot){
                    echo sprintf('<img src="../media/%s?time=%d" class="mr-1 mb-1 d-block thumbnail-animation" />', $slot, time());
                    if(($key+1) % $SLOT_LIMIT === 0) {
                        echo '<div class="break"></div>';
                    }     
                }
                ?>
            </div>
            </div>
        </div>
    </div>
</body>
</html>