<?php
require_once('src/init-session.php');
$random = md5(rand(1000, 9999));
header("Content-Security-Policy: object-src 'none'; script-src 'nonce-$random' 'strict-dynamic'; base-uri 'none';");
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>LED Reklama Sněhulák</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./assets/bootstrap-4.5.0-dist/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css?time=<?php echo time(); ?>'>
    <link rel="icon" type="image/png" href="favicon.png?v=1">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-84479252-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-84479252-3');
    </script>

</head>

<body>
    <header class="position-relative d-none d-lg-block" id="top">
        <nav class="title-navbar pt-4">
            <div class="d-flex">
                <div class="logo flex-fill px-5 pt-1">
                    <a href="#top" title="Úvod"><img src="./layout/logo.svg" alt="LED Reklama Sněhulák Liberec" /></a>
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
            <a href="#introduction" title="Další informace"><i class="arrow down"></i></a>
        </p>
        <div class="title-card d-flex flex-row-reverse position-absolute">
            <div class="m-5 p-4 text-center">
                <h3>MODERNÍ LED REKLAMA</h3>
                <span>kruhová križovatka <br>pod OC Globus v Liberci</span>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark d-lg-none">
        <a class="navbar-brand" href="#top" title="Úvod">
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

    <header class="d-lg-none" style="margin-top: 85px;">
        <div class="logo margin-auto px-5 pt-1">
            <a href="#top" title="Úvod"><img src="./layout/logo.svg" alt="LED Reklama Sněhulák Liberec" /></a>
        </div>
        <div class="d-flex justify-content-middle mt-3">
            <img src="./layout/eye.jpg" alt="EYE" class="w-40 d-none d-sm-block" />
            <img src="./layout/led.jpg" alt="LED" class="img-w-60 led-img-sm" />
        </div>
    </header>

    <a class="anchor" id="introduction"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Úvodní informace</h2>
        <div class="d-lg-flex flex-lg-equal w-100 my-3 justify-content-center">
            <div class="bg-green mb-3 mb-lg-0 mr-lg-3 text-dark overflow-hidden rounded">
                <div class="m-3 py-3 px-2 py-lg-4 px-lg-4">
                    <h2 class="display-5 text-center">LED BANNER</h2>
                    <ul class="pl-4">
                        <li>provoz každý den 7:00 - 19:00</li>
                        <li>plocha 5,64 x 3,28 m (18,5 m<sup>2</sup>)</li>
                        <li>střídání v pravidelných intervalech</li>
                        <li>JPG obrázek 1120 x 640 px</li>
                        <li>kruhová křizovatka Sněhulák pod OC Globus v Libereci</li>
                    </ul>
                </div>
            </div>
            <div class="bg-green mb-3 mb-lg-0 mr-lg-3 text-dark overflow-hidden rounded">
                <div class="m-3 py-3 px-2 py-lg-4 px-lg-4">
                    <h2 class="display-10 text-center">PROČ NÁŠ LED?</h2>
                    <ul class="pl-4 list-checked list-unstyled">
                        <li class="font-weight-bold" style="color: #c0392b;">
                            zhotovíme vám reklamní banner ZDARMA, zašlete materiály na e-mail
                        </li>
                        <li>nulové pořizovací náklady</li>
                        <li>moderní reklama, která zaujme</li>
                        <li>rychlé spuštění reklamy</li>
                        <li>možná okamžitá záměna reklamy</li>
                        <li>nejvytíženější dopravní místo v Liberci</li>
                        <li>průjezd 18 000 vozidel denně</li>
                    </ul>
                </div>
            </div>
            <div class="bg-green text-dark overflow-hidden rounded">
                <div class="m-3 py-3 px-2 py-lg-4 px-lg-4">
                    <h2 class="display-10 text-center">JAK OBJEDNAT?</h2>
                    <span>Zašlete na <a href="mailto:info@reklama-snehulak.cz"
                            title="Email">info@reklama-snehulak.cz</a> následující:</span>
                    <ol class="pl-4">
                        <li>obrázkový banner
                            <ul>
                                <li>velikost 1120 x 640 px</li>
                                <li>formát obrázku JPG</li>
                            </ul>
                        </li>
                        <li>četnost zobrazení</li>
                        <li>doba zobrazení (měsíc/rok)</li>
                        <li>fakturační údaje</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="container mt-5">
        <h2 class="text-center py-2">Ukázky bannerů</h2>
        <div class="d-md-flex flex-md-equal w-100 my-3 justify-content-center">
            <div class="bg-dark mb-3 text-white overflow-hidden rounded">
                <div class="m-1 m-lg-3 py-3 py-md-4">
                    <div class="gallery text-center d-lg-flex flex-lg-wrap justify-content-center">
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/0.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/1.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/2.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/3.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/4.jpg" alt="Náhled banneru" />
                        <img class="flex-lg-fill m-1" src="layout/thumbnails/5.jpg" alt="Náhled banneru" />
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
                    <th scope="col"><span class="d-none d-md-inline">Zobrazení za hodinu</span><span
                            class="d-md-none">Zobraz / hod</span></th>
                    <th scope="col"><span class="d-none d-md-inline">Zobrazení za měsíc</span><span
                            class="d-md-none">Zobraz / měs</span></th>
                    <th scope="col"><span class="d-none d-md-inline">Cena za zobrazení</span><span
                            class="d-md-none">Cena / zobraz</span></th>
                    <th scope="col"><span class="d-none d-md-inline">Cena za měsíc</span><span class="d-md-none">Cena /
                            měs</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>min<span class="d-none d-md-inline">imálně</span> 60x</td>
                    <td class="text-nowrap">21 600 x</td>
                    <td>0,39<span class="d-none d-md-inline"> Kč</span></td>
                    <td class="text-nowrap">8 400<span class="d-none d-md-inline"> Kč</span></td>
                </tr>
                <tr>
                    <td>min<span class="d-none d-md-inline">imálně</span> 30x</td>
                    <td class="text-nowrap">10 800 x</td>
                    <td>0,50<span class="d-none d-md-inline"> Kč</span></td>
                    <td class="text-nowrap">5 400<span class="d-none d-md-inline"> Kč</span></td>
                </tr>
                <tr>
                    <td>min<span class="d-none d-md-inline">imálně</span> 15x</td>
                    <td class="text-nowrap">5 400 x</td>
                    <td>0,70<span class="d-none d-md-inline"> Kč</span></td>
                    <td class="text-nowrap">3 800<span class="d-none d-md-inline"> Kč</span></td>
                </tr>
            </tbody>
        </table>
        <p>
            Pro zobrazení 60x za hodinu se můžou střídat 2 nebo 4 různé bannery.<br />
            Pro zobrazení 30x za hodinu se můžou střídat 2 různé bannery.
        </p>
    </section>

    <a class="anchor" id="map"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Mapa umístění</h2>
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="w-100 w-lg-50" id="map_container"></div>
            <div class="w-100 w-lg-50 map-directions">
            </div>
        </div>
    </section>

    <a class="anchor" id="contacts"></a>
    <section class="container mt-5">
        <h2 class="text-center py-2">Kotaktujte nás</h2>
        <div class="row">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                <a href="mailto:info@reklama-snehulak.cz" title="Napište nám" class="contact email"
                    target="_blank">info@reklama-snehulak.cz</a>
            </div>
            <div class="col-12 col-lg-6">
                <a href="tel:+420602200991" title="Zavolejte nám" class="contact phone">(+420) 602 200 991</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 margin-auto mt-4">
                <h4 class="text-center py-2">Napište nám</h4>
                <form id="contactForm" method="post">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="form-group">
                        <label for="nameInput">Jméno a příjmení</label>
                        <input type="text" name="name" class="form-control" id="nameInput" placeholder="Jan Novák"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="emailInput">Email</label>
                        <input type="email" name="email" class="form-control" id="emailInput" placeholder="jan@novak.cz"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="subjectInput">Předmět zprávy</label>
                        <input type="text" name="subject" class="form-control" id="subjectInput" placeholder="Dotaz"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="noteInput">Text</label>
                        <textarea class="form-control" name="message" id="noteInput" placeholder="Co máte na srdci?"
                            rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="g-recaptcha btn btn-primary btn-lg btn-block submit"
                            data-sitekey="<?php echo $apikeys['captcha-client']; ?>" data-callback='onSubmit'
                            data-action='submit'>Odeslat</button>

                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="container mt-5">
        <div class="row">
            <div class="col-12 col-lg-6 text-center">
                <h5>Kontakt</h5>
                <ul class="list-unstyled text-small">
                    <li class="text-muted"><a href="mailto:info@reklama-snehulak.cz"
                            title="Email">info@reklama-snehulak.cz</a></li>
                    <li class="text-muted"><a href="tel:+420602200991" title="Zavolejte nám">(+420) 602 200 991</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-6 mb-2 text-center">
                <img src="layout/icon-dark.png" height="50" alt="LED Reklama Sněhulák Liberec" loading="lazy"><br />
                <span class="d-block my-2">&copy; <?php echo date("Y"); ?></span>
            </div>
        </div>
    </footer>
    <div id="modal-info" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upozornění</h5>
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
    <script src="./assets/jquery-3.5.1.min.js" nonce="<?php echo $random; ?>"></script>
    <script src="./assets/popper.min.js" nonce="<?php echo $random; ?>"></script>
    <script src="./assets/bootstrap-4.5.0-dist/js/bootstrap.min.js" nonce="<?php echo $random; ?>"></script>
    <script src="./main.js?time=<?php echo time(); ?>" nonce="<?php echo $random; ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikeys["map"]; ?>&callback=initMap" async
        defer nonce="<?php echo $random; ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js" nonce="<?php echo $random; ?>"></script>

</body>

</html>