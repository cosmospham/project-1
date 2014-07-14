<?php
class My_Functions_Mail {

    private $mailconfig = array();

    public function __construct()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
        $mail = $config->mail->smtp;

        $this->mailconfig = array(
            'auth'     => $mail->auth,
            'charset'  => $mail->charset,
            'from'  => $mail->from,
            'fromname'  => $mail->fromname,
            'password' => $mail->pass,
            'port'     => $mail->port,
            'ssl'      => $mail->ssl,
            'username' => $mail->user,
            );

        $transport = new Zend_Mail_Transport_Smtp($mail->host, $this->mailconfig);
        Zend_Mail::setDefaultTransport($transport);
    }

    public function send($title, $body, $sendTo, $sendToName)
    {
        $mail = new Zend_Mail();
        $mail->setBodyHtml($body, $this->mailconfig['charset']);
        $mail->setFrom($this->mailconfig['from'], $this->mailconfig['fromname']);
        $mail->addTo($sendTo, $sendToName);
        $mail->setSubject($title);
        $mail->send();
    }
}