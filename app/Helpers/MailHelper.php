<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Core\Config;
use App\Helpers\LogHelper;
use App\Interfaces\MailInterface;

class MailHelper implements MailInterface {

    protected $mail;

    public function __construct() {
        
        $config = Config::getInstance()->get('mail');
        $this->mail = new PHPMailer(true); // Abilita eccezioni

        try {
            $this->mail->isSMTP();
            $this->mail->Host       = $config['host'];
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = $config['username'];
            $this->mail->Password   = $config['password'];
            $this->mail->SMTPSecure = $config['smtp_secure'];
            $this->mail->Port       = $config['port'];
            $this->mail->setFrom($config['from_email'], $config['from_name']);
            $this->mail->CharSet    = 'UTF-8';
        } catch (Exception $e) {
            throw new Exception("Errore di configurazione: " . $this->mail->ErrorInfo);
        }
    }

    public function send(string $to, string $subject, string $body, string $altBody = ''): bool {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = $altBody ?: strip_tags($body);
            return $this->mail->send();
        } catch (\Exception $e) {
            // Registra il log dell'errore
            LogHelper::log_mail("Errore nell'invio dell'email a $to: " . $this->mail->ErrorInfo, 'mail_error.log');
            return false;
        }
    }
}
