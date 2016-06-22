<?php namespace Library;

use Library\Exceptions\EmailException;

class Email {
	
	private $mailer;
	
	public function __construct() {
		
		$settings = Application::settings('mailer');
		$this->mailer = new PHPMailer();
		if($settings['smtp']) {
			$this->mailer->isSMTP();
			$this->mailer->Host = $settings['host'];
			$this->mailer->SMTPAuth = true;
			$this->mailer->Username = $settings['username'];
			$this->mailer->Password = $settings['password'];
			$this->mailer->SMTPSecure = $settings['protocol'];
			$this->mailer->Port = $settings['port'];
		} else {
			$this->mailer->isMail();
		}
		$this->mailer->isHtml = $settings['html'];
		$this->mailer->From = $settings['from'];
		$this->mailer->FromName = $settings['name'];
		
	}
	
	public function sendTo($address) {
		$this->mailer->addAddress($address);
	}
	
	public function setSubject($subject) {
		$this->mailer->Subject = $subject;
	}
	
	public function setBody($body) {
		$this->mailer->Body = $body;
	}
	
	public function setAlternateBody($alternate) {
		$this->mailer->AltBody = $alternate;
	}
	
	public function send() {
		$success = $this->mailer->send();
		if(!$success)
			throw new EmailException($this->mailer->ErrorInfo);	
	}
}
	
?>