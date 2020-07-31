<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LED Reklama Sněhulák</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/bootstrap-4.5.0-dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css?time=<?php echo time(); ?>'>
    <?php
    require_once('src/init-session.php');
    ?>
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

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark d-none">
        <a class="navbar-brand" href="#top">
            <img src="layout/icon.png" height="50" alt="LED Reklama Sněhulák Liberec" loading="lazy">
            <h1 class="d-none d-lg-inline pl-3 font-weight-bold mb-0" style="font-size: 1.1em;">
                <span class="d-none">LED </span>Reklama Sněhulák Liberec
            </h1>
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
                    <a class="nav-link" href="#contacts">Kontakt</a>
                </li>
            </ul>
        </div>
    </nav>
    <a class="anchor" id="introduction"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Introduction</h2>
        <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
            <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                <div class="my-3 py-3">
                    <h2 class="display-5">Another headline</h2>
                    <p class="lead">And an even wittier subheading.</p>
                </div>
            </div>
            <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                <div class="my-3 p-3">
                    <h2 class="display-5">Another headline</h2>
                    <p class="lead">And an even wittier subheading.</p>
                </div>
            </div>
        </div>
        <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
            <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                <div class="my-3 p-3">
                    <h2 class="display-5">Another headline</h2>
                    <p class="lead">And an even wittier subheading.</p>
                </div>
            </div>
            <div class="bg-primary mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
                <div class="my-3 py-3">
                    <h2 class="display-5">Another headline</h2>
                    <p class="lead">And an even wittier subheading.</p>
                </div>
            </div>
        </div>
    </section>

    <a class="anchor" id="prices"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Ceník služeb</h2>
        <table class="prices table">
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
        <div class="mt-2" id="map_container">
    </section>

    <a class="anchor" id="contacts"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Napište nám</h2>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
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
            <div class="col-2"></div>
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