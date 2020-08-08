<?php
session_start();
header('Content-Type: application/json');

try {
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if ($token != $_SESSION['token']) {
        throw new Exception('invalid-token');
    }

    if (!is_file("config.ini")) {
        throw new Exception('no-config-file');
    }

    $config = parse_ini_file("config.ini", true);
    $apikeys = $config['apikeys'];
    $captcha = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
    if (!$captcha) {
        throw new Exception('captcha-error');
    }

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => $apikeys['captcha-server'], 'response' => $captcha);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $response_keys = json_decode($response, true);

    if (!$response_keys["success"]) throw new Exception('captcha-failure');

    require('class.mailer.php');

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);


    if (empty($name)) {
        throw new Exception('invalid-name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('invalid-email');
    }

    if (empty($subject)) {
        throw new Exception('invalid-subject');
    }

    if (empty($message)) {
        throw new Exception('invalid-message');
    }

    $mail = new MyPHPMailer(true);
    $mail->addAddress('info@reklama-snehulak.cz');
    $mail->addCC($email, $name);
    $mail->addReplyTo($email, $name);
    $mail->setSubject($subject);
    $htmlmsg = nl2br($message);
    $body =
        <<<HTML
    Byla vytvořena zpráva z webu reklama-snehulak.cz<br/>
    od <b>$name</b> (email: $email)<br/><br/>
    Text zprávy:<br/><b>$htmlmsg</b>"
HTML;

    $mail->setBody($body);
    $mail->send();
    $data = array('success' => true);
} catch (Exception $e) {
    $data = array('error' => $e->getMessage(), 'details' => print_r($_POST, true));
}

echo json_encode($data);