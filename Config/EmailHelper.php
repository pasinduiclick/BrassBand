<?php
/**
  | -------------------------------------------------------------------------
  | Customisable Helper Library for in house projects
  | -------------------------------------------------------------------------
  | This Helper library lets you to create Email Functionalities.
 * 
 * @package     brassband
 * @author      PASINDU SIRIWARDANA
 * @version     1.0
 * @copyright (c) 2020, ICLICK ONLINE TECHNOLOGIES
 */

class EmailHelper {

    protected $recipients = array();

    protected $bound = null;

    protected $message = null;

    protected $subject = null;

    protected $fromAddr = null;

    protected $addGreeting = false;

    protected $type = true;

    protected $level = null;

    protected $attachments = array();

    /**
     * Constructor
     *
     * @param   Boolean $greeting Greeting
     */
    public function __construct($greeting = false) {
        $this->addGreeting = $greeting;
        $this->bound = uniqid(time());
        $this->level = 'normal';
    }

    /**
     * addRecipient
     * 
     * Add an email recipient to send for.
     *
     * @param   String $email Recipient Email Address
     * @param   String $name Recipient Name
     * @return  Object email obj
     */
    public function addRecipient($email, $name = null) {
        if (!isset($email)) {
            throw new MailerException('Please specify an email!');
        }

        if (isset($name) && !empty($name)) {
            $this->recipients[$name] = $email;
        } else {
            $this->recipits[] = $email;
        }

        return $this;
    }

    /**
     * setMessage
     * 
     * Set the email content to send.
     *
     * @param   String $msg Email Message
     * @return  object Message obj
     */
    public function setMessage($msg) {
        if (!isset($msg)) {
            throw new MailerException('Please specify a message');
        }

        $this->message = (isset($msg) && !empty($msg)) ? trim(stripslashes($msg)) : null;

        return $this;
    }

    /**
     * setSubject
     * 
     * Set the email subject
     *
     * @param   String $subject Email Subject
     * @return  Object Subject obj
     */
    public function setSubject($subject) {
        if (!isset($subject)) {
            throw new MailerException('Email Subject Required');
        }

        $this->subject = (isset($subject) && !empty($subject)) ? $subject : null;

        return $this;
    }

    /**
     * setFrom
     * 
     * Set the email sender
     *
     * @param   String $name Name
     * @param   String $email Email address
     * @return  object From obj
     */
    public function setFrom($name, $email) {
        if (!isset($name) || !isset($email)) {
            throw new MailerException('Please enter email or a name!');
        }

        $this->fromAddr = (isset($name, $email) && (!empty($name)) && !empty($email)) ? $name . " <" . $email . ">": null;

        return $this;
    }

    /**
     * setLevel
     * 
     * Set the email importance level
     *
     * @param   String $lvl Level of importance
     * @return  object Level
     */
    public function setLevel($lvl = 'normal') {
        $this->level = (isset($lvl) && !empty($lvl)) ? $lvl : null;

        return $this;
    }

    /**
     * attachment
     * 
     * Add an attachment to send via Email
     *
     * @param   String $file File to Send via Email
     * @return  Object Attachment
     */
    public function attachment($file) {
        if (!file_exists($file)) {
            throw new MailerException('File (' . $file . ') not exists!');
        }

        $base = basename($file);
        $header =  "--{$this->bound}\r\n";
        $header .= "Content-Type: ". File::mime($file, true) ."; name=\"{$base}\"\r\n";
        $header .= "Content-Transfer-Encoding: base64\r\n";
        $header .= "Content-Disposition: attachment; filename=\"{$base}\"\r\n\r\n";
        $header .= chunk_split(base64_encode(fread(fopen($file, 'rb'), filesize($file))), 72) . "\r\n";

        $this->attachments[] = $header;

        return $this;
    }

    /**
     * mailtype
     * 
     * Set the email content type
     *
     * @param   String $type Email type
     * @return  Object email type
     */
    public function mailtype($type) {
        if (!isset($type)) {
            throw new MailerException('Please specify the email type!');
        }

        $this->type = (isset($type) && !empty($type)) ? $type : null;

        return $this;
    }

    /**
     * send
     * 
     * Send email algorithm
     *
     * @param   Integer $pauseEvery Email wait in seconds
     * @return  Boolean Send data to send mail function
     */
    public function send($pauseEvery = 25) {
        $count = 1;

        foreach ($this->recipients as $toName => $toAddr) {
            $count++;

            if (is_int($pauseEvery) && ($count % $pauseEvery) == 0) {
                sleep(3);
            }

            if ($this->sendEmail($toAddr, $toName)) {
                $count++;

                continue;
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * sendEmail
     * 
     * Send email to the specified address with a greeting with the $toName if greeting is enabled
     *
     * @param   String $toAddr Receivers Email Address
     * @param   String $toName Receivers Name
     * @return  Boolean 
     */
    private function sendEmail($toAddr, $toName = null) {
        if (!isset($toAddr)) {
            throw new MailerException('Email is required');
        }

        $toName  = (isset($toName) && is_string($toName))  ? $toName  : 'Sir/Madam';

        $version = phpversion();

        $body = ($this->addGreeting === true) ? "Dear, " . $toName . "\r\n" . $this->message : $this->message;

        $headers = "X-Mailer: PHP v{$version}\r\n";
        $headers .= 'From: ' . $this->fromAddr . "\r\n";
        $headers .= 'To: ' . $toName . " <{$toAddr}>\r\n";
        $headers .= $this->buildHeaders($body);

        if (count($this->attachments) > 0) {
            $headers .= $this->attachments;
        }

        if (mail($toAddr, $this->subject, $body, $headers)) {
            return true;
        }

        return false;
    }

    /**
     * buildHeaders
     * 
     * Build some needed custom headers
     *
     * @param   String $content Email Content
     * @return  String
     */
    private function buildHeaders($content) {
        if (!isset($content)) {
            throw new MailerException('email body is empty');
        }

        $headers = "Date: " . date("Y/m/d") . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"{$this->bound}\"\r\n\r\n";
        $headers .= "--{$this->bound}\r\n";

        $headers .= "Importance: {$this->level}\r\n";

        switch ($this->type) {
            case 'html':
                $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8 \r\n";
                $headers .= "<html>\n<body>\n{$content}\n</body>\n</html>\r\n\r\n";
                $headers .= "--{$this->bound}\r\n\r\n";
                break;
            case 'plain':
            default:
                $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
                $headers .= "Content-Type:text/plain;charset= UTF-8 \r\n";
                $headers .= "{$content}\r\n\r\n";
                $headers .= "--{$this->bound}\r\n\r\n";
                break;
        }

        return $headers;
    }
}

final class MailerException extends RuntimeException {}
?>