<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("../assets/PHPMailer/src/PHPMailer.php");
require("../assets/PHPMailer/src/SMTP.php");
require("../assets/PHPMailer/src/Exception.php");

if (!is_file("config.ini")) {
    die('No config.ini file found!');
}

$config = parse_ini_file("config.ini", true);

class MyPHPMailer extends PHPMailer
{
    /**
     * myPHPMailer constructor.
     *
     * @param bool|null $exceptions
     * @param string    $body A default HTML message body
     */
    public function __construct($exceptions)
    {
        global $config;

        parent::__construct($exceptions);
        $this->setFrom($config['email']['from'], $config['email']['name']);
        $this->isHTML(true);
        $this->isSMTP();
        $this->CharSet = 'UTF-8';
        $this->setLanguage('cs');
        $this->SMTPAuth = true;
        $this->Host = $config['smtp']['host'];
        $this->Username = $config['smtp']['user'];
        $this->Password = $config['smtp']['password'];
        $this->SMTPSecure = 'ssl';
        $this->Port = 465;
        //$this->SMTPDebug = 2;
    }

    public function setBody($body)
    {
        //Set an HTML and plain-text body, import relative image references
        $this->msgHTML($body, '../img/');
    }

    public function setSubject($subject)
    {
        $this->Subject = $subject;
    }
}