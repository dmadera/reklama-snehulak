<?php
session_start();
if ($_POST["login"] == "true") {
    try {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($username != "admin") {
            throw new Exception("Neplatné uživatelské jméno.");
        }

        $secret = trim(file_get_contents("secret"));
        if ($password != $secret) {
            throw new Exception("Neplatné heslo.");
        }
        $_SESSION["login"] = true;
        header("Location: index.php");
    } catch (Exception $e) {
        echo sprintf("<div class='alert alert-danger'>%s</div>", $e->getMessage());
    }
}
?>

<html>
<?php require_once("layout/header.php"); ?>

<body>
    <div class="mt-5 login-form text-center d-flex justify-content-center">
        <form class="form-signin" action="login.php" method="POST">
            <img class="mb-4" src="../../layout/logo-snehulak.png" alt="Logo">
            <h1 class="h3 mb-3 font-weight-normal">Administrace</h1>
            <label for="inputEmail" class="sr-only">Jméno</label>
            <input type="text" name="username" id="inputUsername" class="form-control mb-2" placeholder="Uživatel"
                required autofocus>
            <label for="inputPassword" class="sr-only">Heslo</label>
            <input type="password" name="password" id="inputPassword" class="form-control mb-2" placeholder="Heslo"
                required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="true">Přihlásit</button>
            <p class="mt-5 mb-3 text-muted">Prosím, přihlaste se.</p>
        </form>
    </div>
</body>

</html>