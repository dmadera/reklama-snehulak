<?php
require_once('src/init-session.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LED Reklama Sněhulák</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/bootstrap-4.5.0-dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css?time=<?php echo time(); ?>'>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script type="text/javascript">
    var apiCaptchaToken = "<?php echo $apikeys['captcha-client']; ?>";
    window.localStorage.setItem('token', '<?php echo $token; ?>');
    window.localStorage.setItem('api-captcha-client', apiCaptchaToken);
    </script>
</head>

<body>
    <header class="position-relative d-none d-lg-block" id="top">
        <nav class="title-navbar pt-4">
            <div class="d-flex">
                <div class="logo flex-fill px-5 pt-1">
                    <a href="#top"><img src="./layout/logo.svg" alt="LED Reklama Sněhulák Liberec" /></a>
                </div>
                <div class="main-menu-item flex-fill text-right pr-5"><a href="#introduction"
                        title="Úvodní informace">Informace</a></div>
                <div class="main-menu-item flex-fill text-right pr-5"><a href="#prices" title="Ceník služeb">Ceník</a>
                </div>
                <div class="main-menu-item flex-fill text-right pr-5"><a href="#contacts" title="Kontakt">Kontakt</a>
                </div>
            </div>
        </nav>
        <p class="navigation-scroll">
            <a href="#introduction" alt="Další informace"><i class="arrow down"></i></a>
        </p>
        <div class="title-card d-flex flex-row-reverse position-absolute">
            <div class="m-4 p-4 text-center">
                <h3>MODERNÍ LED REKLAMA</h3>
                <span>kruhová križovatka <br>pod OC Globus v Liberci</span>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark d-lg-none">
        <a class="navbar-brand" href="#top">
            <img src="layout/icon.png" height="50" alt="LED Reklama Sněhulák Liberec" loading="lazy">
            <h1 class="d-none d-lg-inline pl-3 font-weight-bold mb-0" style="font-size: 1.1em;">
                <span class="d-none">LED </span>Reklama Sněhulák Liberec
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-3 ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" data-target="#navbarToggler"
                        href="#introduction">Informace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" data-target="#navbarToggler" href="#prices">Ceník</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" data-target="#navbarToggler" href="#map">Mapa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" data-target="#navbarToggler" href="#contacts">Kontakt</a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="d-lg-none" style="margin-top: 85px;">
        <div class="logo margin-auto px-5 pt-1">
            <a href="#top"><img src="./layout/logo.svg" alt="LED Reklama Sněhulák Liberec" /></a>
        </div>
        <div class="d-flex justify-content-middle mt-3">
            <img src="./layout/eye.png" alt="EYE" class="w-40 d-none d-sm-block" />
            <img src="./layout/led.png" alt="LED" class="img-w-60" />
        </div>
    </section>

    <a class="anchor" id="introduction"></a>
    <section class="container mt-3">
        <!-- <h2 class="text-center py-2">Introduction</h2> -->
        <div class="d-md-flex flex-lg-equal w-100 my-3 justify-content-center">
            <div class="bg-green mb-3 mb-md-0 mr-md-3 text-darl overflow-hidden rounded align-self-stretch">
                <div class="m-3 py-3 px-2 py-md-4 px-md-4">
                    <h2 class="display-5 text-center">LED BANNER</h2>
                    <ul class="pl-4">
                        <li>každý den 7:00 - 19:00</li>
                        <li>plocha 5,64 x 3,28 m (18,5 m<sup>2</sup>)</li>
                        <li>střídání v pravidelných intervalech</li>
                        <li>JPG obrázek 1120 x 640 px</li>
                        <li>křizovatka pod OC Globus v Libereci</li>
                    </ul>
                </div>
            </div>
            <div class="bg-green text-dark overflow-hidden rounded align-self-stretch">
                <div class="m-3 py-3 px-2 py-md-4 px-md-4">
                    <h2 class="display-10 text-center">PROČ NÁŠ LED?</h2>
                    <ul class="pl-4 list-checked list-unstyled">
                        <li>nulové pořizovací náklady</li>
                        <li>moderní reklama, která zaujme</li>
                        <li>okamžité spuštění</li>
                        <li>instantní výměna banneru</li>
                        <li>průjezd 18 000 vozidel denně</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-md-flex flex-md-equal w-100 my-3 justify-content-center">
            <div class="bg-dark mb-3 text-white overflow-hidden rounded">
                <div class="m-1 m-lg-3 py-3 py-md-4">
                    <h2 class="display-10 text-center">Ukázky bannerů</h2>
                    <div class="gallery text-center d-lg-flex flex-lg-wrap justify-content-center">
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/0.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/1.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/2.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/3.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/4.jpg" alt="Náhled banneru" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a class="anchor" id="prices"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Ceník služeb</h2>
        <table class="prices table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Zobrazení za hodinu</th>
                    <th scope="col">Zobrazení za měsíc</th>
                    <th scope="col">Cena za 1 zobrazení</th>
                    <th scope="col">Cena za měsíc</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">40</th>
                    <td>14 400</td>
                    <td>0,48 Kč</td>
                    <td>6 900 Kč</td>
                </tr>
                <tr>
                    <th scope="row">20</th>
                    <td>7 200</td>
                    <td>0,63 Kč</td>
                    <td>4 500 Kč</td>
                </tr>
                <tr>
                    <th scope="row">10</th>
                    <td>3 600</td>
                    <td>0,81 Kč</td>
                    <td>2 900 Kč</td>
                </tr>
            </tbody>
        </table>
    </section>

    <a class="anchor" id="map"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Mapa umístění</h2>
        <div class="mt-2 rounded" id="map_container">
    </section>

    <a class="anchor" id="contacts"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Napište nám</h2>
        <div class="row">
            <div class="col-12 col-md-8 margin-auto">
                <form id="contactForm" method="post">
                    <div class="form-group">
                        <label for="nameInput">Jméno a příjmení</label>
                        <input type="text" name="name" class="form-control" id="nameInput" placeholder="" required />
                    </div>
                    <div class="form-group">
                        <label for="emailInput">Email</label>
                        <input type="email" name="email" class="form-control" id="emailInput" placeholder="" required />
                    </div>
                    <div class="form-group">
                        <label for="subjectSelect">Předmět zprávy</label>
                        <input type="text" name="subject" class="form-control" id="subjectInput" placeholder=""
                            required />
                    </div>
                    <div class="form-group">
                        <label for="noteInput">Text</label>
                        <textarea class="form-control" name="message" id="noteInput" placeholder="Co máte na srdci?"
                            rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block submit">
                            Odeslat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="container mt-5">
        <div class="row">
            <div class="col-6 col-md text-center">
                <img src="layout/icon-dark.png" height="50" alt="LED Reklama Sněhulák Liberec" loading="lazy">
            </div>
            <div class="col-6 col-md text-center">
                <h5>Kontakt</h5>
                <ul class="list-unstyled text-small">
                    <li class="text-muted"><a href="mailto:info@reklama-snehulak.cz"
                            title="Email">info@reklama-snehulak.cz</a></li>
                    <li class="text-muted">(+420) 602 200 991</li>
                    <li>&nbsp;</li>
                    <li>&copy; <?php echo date("Y"); ?></li>
                </ul>
            </div>
            <div class="col-6 col-md text-center">
                <h5>Provozní doba</h5>
                <ul class="list-unstyled text-small">
                    <li class="text-muted">07:00 - 19:00</li>
                </ul>
            </div>
        </div>
    </footer>
    <div id="modal-info" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="./assets/jquery-3.5.1.min.js"></script>
    <script src="./assets/popper.min.js"></script>
    <script src="./assets/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="main.js?time=<?php echo time(); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikeys["map"]; ?>&callback=initMap" async
        defer></script>
</body>

</html>