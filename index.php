<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LED Reklama Sněhulák</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/bootstrap-4.5.0-dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css?time=<?php echo time(); ?>'>
    <script src="./assets/jquery-3.5.1.min.js"></script>
    <script src="./assets/popper.min.js"></script>
    <script src="./assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="main.js?time=<?php echo time(); ?>"></script>
</head>

<body>
    <header class="position-relative d-none d-lg-block" id="top">
        <nav class="d-flex">
            <h1 class="pt-4 px-5">
                <span class="d-none">LED Reklama Sněhulák Liberec</span>
                <a class="logo" href="index.php"><img src="./layout/logo.svg" alt="LED Reklama Sněhulák Liberec" /></a>
            </h1>
            <div class="flex-fill">
                <ul class="main-menu mt-4 d-flex justify-content-end nav">
                    <li class="nav-item flex-fill text-center">
                        <a href="#introduction" title="Úvodní informace">Informace</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a href="#prices" title="Ceník služeb">Ceník</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a href="#contacts" title="Kontakt">Kontakt</a>
                    </li>
                </ul>
            </div>
        </nav>
        <p class="navigation-scroll">
            <a href="#introduction" alt="Další informace"><i class="arrow down"></i></a>
        </p>
        <div class="title-card d-flex flex-row-reverse position-absolute">
            <div class="m-5 p-4 text-center">
                <h3>MODERNÍ LED REKLAMA</h3>
                <span>kruhová križovatka pod OC Globus<br> v Liberci</span>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark d-none">
        <a class="navbar-brand" href="#top">
            <img src="layout/icon.png" height="50" alt="LED Reklama Sněhulák Liberec" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav ml-3 ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#introduction">Informace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#prices">Ceník</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contatcs">Kontakt</a>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>