<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">LED REKLAMA SNĚHULÁK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Administrace</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="animation.php">Vizualizace animace</a>
            </li>
        </ul>
        <span class="btn btn-outline-secondary mr-2"><?php echo sprintf("Interval: %.1f s | Max %d reklam zobrazovaných 60x za hodinu", $INTERVAL, $SLOTS_COUNT / $INTERVAL); ?></span>
        <a href="generate.php" class="btn btn-primary mr-2 generate">Manuálně vygenerovat animaci</a>
    </div>
</nav>