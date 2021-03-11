<?php 
namespace library\core;

/**
 * Microdle Framework (https://microdle.com/).
 * Simple e-mail, without file attachment.
 * 
 * @author Vincent SOYSOUVANH
 * 
 * @version 0.1
 * 
 * @package library.core
 */
class EmailCore {
	/**
	 * Priority status.
	 * 
	 * @var array
	 */
	public static $PRIORITIES = Array(
		'1 (Highest)',
		'2 (High)',
		'3 (Normal)',
		'4 (Low)',
		'5 (Lowest)'
	);
	
	/**
	 * Complete sender name.
	 * 
	 * @var string
	 */
	protected $_fromName;
	
	/**
	 *
	 * @var string
	 */
	protected $_xMailer;
	
	/**
	 * Auto-reply e-mail.
	 * 
	 * @var string
	 */
	protected $_replyTo;
	
	/**
	 * E-mail back for the read receipt (return receipt requested).
	 * 
	 * @var string
	 */
	protected $_notifyTo;
	
	/**
	 * E-mail returned on error (case e-mail nonexistent or e-mail box full).
	 * 
	 * @var string
	 */
	protected $_returnPath;
	
	/**
	 * Recipient e-mails list in Carbon Copy (visible copy). E-mails are delimited by ";".
	 * 
	 * @var string
	 */
	protected $_cc;
	
	/**
	 * Recipient e-mails list in Blind Carbon Copy (hidden copy). E-mails are delimited by ";".
	 * 
	 * @var string
	 */
	protected $_bcc;
	
	/**
	 * E-mail content type: text/plain, text/html, etc. By default text/plain.
	 * 
	 * @var string
	 */
	protected $_contentType;
	
	/**
	 * Chartset (iso-8859-1 by default).
	 * 
	 * @var string
	 */
	protected $_charset;
	
	/**
	 * E-mail priority from 1 to 5 (3 by default).
	 * 
	 * @var integer
	 */
	protected $_priority;
	
	/**
	 * Attached files. It is an associative array with key as path file, and value as file name.
	 * 
	 * @var array
	 */
	protected $_attachments;
	
	/**
	 * Constructor.
	 * 
	 * @param string $charset (optional) Charset.
	 * 
	 * @return void
	 */
	public function __construct($charset = 'iso-8859-1') {
		$this->clear($charset);
	}
	
	/**
	 * Initialize e-mail by default value.
	 * 
	 * @param string $charset (optional) Charset.
	 * 
	 * @return void
	 */
	public function clear($charset = 'iso-8859-1') {
		$this->_fromName = null;
		$this->_xMailer = 'PHP';
		$this->_replyTo = null;
		$this->_notifyTo = null;
		$this->_returnPath = null;
		$this->_cc = null;
		$this->_bcc = null;
		$this->_contentType = 'text/plain';
		$this->_charset = $charset;
		$this->_priority = 3;
		$this->_attachments = [];
	}
	
	/**
	 * Set complete sender name.
	 * 
	 * @param string $fromName Complete sender name.
	 * 
	 * @return void
	 */
	public function setFromName($fromName) {
		$this->_fromName = $this->_charset === 'iso-8859-1' ? utf8_decode($fromName) : $fromName;
	}
	
	/**
	 * Set X-Mailer.
	 * 
	 * @param string $xMailer X-Mailer.
	 */
	public function setXMailer($xMailer) {
		$this->_xMailer = $xMailer;
	}
	
	/**
	 * Set auto-reply e-mail.
	 * 
	 * @param string $replyTo Auto-reply e-mail.
	 */
	public function setReplyTo($replyTo) {
		$this->_replyTo = $replyTo;
	}
	
	/**
	 * Set notification e-mail for receipt.
	 * 
	 * @param string $notifyTo Notification e-mail.
	 */
	public function setNotifyTo($notifyTo) {
		$this->_notifyTo = $notifyTo;
	}
	
	/**
	 * Set e-mail for e-mail returned on error.
	 * 
	 * @param string $returnPath E-mail.
	 * 
	 * @return void
	 */
	public function setReturnPath($returnPath) {
		$this->_returnPath = $returnPath;
	}
	
	/**
	 * Set recipient e-mails list in Carbon Copy (visible copy). E-mails are delimited by ";".
	 * 
	 * @param string $cc Recipient e-mails list in Carbon Copy.
	 * 
	 * @return void
	 */
	public function setCc($cc) {
		$this->_cc = $cc;
	}
	
	/**
	 * Set recipient e-mails list in Blind Carbon Copy (hidden copy). E-mails are delimited by ";".
	 * 
	 * @param string $bcc Recipient e-mails list in Blind Carbon Copy.
	 * 
	 * @return void
	 */
	public function setBcc($bcc) {
		$this->_bcc = $bcc;
	}
	
	/**
	 * Set e-mail content type.
	 * 
	 * @param string $contentType E-mail content type.
	 * 
	 * @return void
	 */
	public function setContentType($contentType) {
		$this->_contentType = $contentType;
	}
	
	/**
	 * Set chartset.
	 * 
	 * @param string $charset Charset.
	 * 
	 * @return void
	 */
	public function setCharset($charset) {
		$this->_charset = $charset;
	}
	
	/**
	 * Set e-mail priority.
	 * 
	 * @param integer $priority E-mail priority.
	 * 
	 * @return void
	 */
	public function setPriority($priority) {
		$this->_priority = $priority;
	}
	
	/**
	 * Add an attached file.
	 * 
	 * @param string $file Resource with complete path.
	 * @param string $name File name only.
	 * 
	 * @return void
	 */
	public function addAttachment(string $file, string $name): void {
		//Case attachment successful
		$this->_attachments[$file] = $name;
	}
	
	/**
	 * Remove an attached file.
	 * 
	 * @param string $file Resource with attached file.
	 * 
	 * @return void
	 */
	public function removeAttchement(string $file): void {
		//Case file is removed
		unset($this->_attachments[$file]);
	}
	
	/**
	 * Remove all attached files.
	 * 
	 * @return void
	 */
	public function clearAttachments() {
		$this->_attachments = [];
	}
	
	/**
	 * Send one or several e-mails.
	 *
	 * @param string $from Sender e-mail.
	 * @param mixed $to One or several receiver e-mails.
	 * 		- for a separate sending: 'email' or 'email[, emailx]'
	 *		- for a combined sending: 'email' or array('email'[, emailx])
	 * @param string $subject Message subject.
	 * @param string $message Message.
	 * 
	 * @return mixed Array if error occurs, otherwise null.
	 */
	public function send($from, $to, $subject, $message) {
		//Several webmails do not use utf-8: convert utf-8 to iso-8859-1
		//if($this->_charset=='utf-8') $this->_charset = 'iso-8859-1';
		
		//The received data is always in utf-8, as all pages are in utf-8
		//if($this->_fromName) $this->_fromName = utf8_decode($this->_fromName);
		$subject = utf8_decode($subject);
		$message = utf8_decode($message);
		
		$nl = "\r\n";
		
		//Build headers
		if(!$this->_returnPath) {
			$this->_returnPath = $from;
		}
		$headers = 'Reply-To: '.($this->_replyTo ? $this->_replyTo : $from).$nl;
		$headers .= 'Return-Path: '.$this->_returnPath . $nl . 'Errors-To: ' . $this->_returnPath . $nl;
		$headers .= 'From: ' . ($this->_fromName ? $this->_fromName . ' <'.$from.'>' : $from).$nl;
		
		if(!empty($this->_attachments)) {
			//Define the boundray to separate our data with
			$mime_boundary = '==MIME_BOUNDARY_'.md5(time());
			
			//Define attachment-specific headers
			$headers .= 'MIME-Version: 1.0' . $nl . 'Content-Type: multipart/mixed; boundary="' . $mime_boundary . '"' . $nl;
			
			//Build message body
			$message = '--' . $mime_boundary . $nl
				. 'Content-Type: text/plain; charset="iso-8859-1"' . $nl
				. 'Content-Transfer-Encoding: 7bit' . $nl . $nl
				. $message . $nl . $nl;
			
			//Add attachments to message body
			foreach($this->_attachments as $localFile => &$fileName) {
				if(is_file($localFile)) {
					$message .= '--' . $mime_boundary.$nl
						. 'Content-Type: application/octet-stream; name="' . $fileName . '"' . $nl
						. 'Content-Description: ' . $fileName . $nl
						. 'Content-Disposition: attachment; filename="' . $fileName . '"; size=' . filesize($localFile) . ';' . $nl
						. 'Content-Transfer-Encoding: base64'.$nl.$nl
						. chunk_split(base64_encode(file_get_contents($localFile))) . $nl . $nl;
			
				}
			}
			
			//End the message
			$message .= '--' . $mime_boundary.'--';
		}
		
		if($this->_cc) {
			$headers .= 'Cc: '.(is_string($this->_cc) ? $this->_cc : implode(', ', $this->_cc)) . $nl;
		}
		if($this->_bcc) {
			$headers .= 'Bcc: '.(is_string($this->_bcc) ? $this->_bcc : implode(', ', $this->_bcc)) . $nl;
		}
		$headers .= 'Mime-Version: 1.0' . $nl;
		$headers .= 'X-Mailer: ' . $this->_xMailer . $nl;
		
		if($this->_notifyTo) {
			$headers .= 'Disposition-Notification-To: <' . $this->_notifyTo . '>' . $nl;
		}
		
		$headers .= 'Content-Type: ' . $this->_contentType . '; charset="' . $this->_charset . '"' . $nl . 'Content-Transfer-Encoding: 7bit' . $nl;
		
		if($this->_priority) {
			$headers .= 'X-Priority: ' . self::$PRIORITIES[$this->_priority-1] . $nl;
		}
		
		//Put recipients in array
		$emailErrors = [];
		if(is_string($to)) {
			$to = explode(',', $to);
		}
		
		//Send e-mails : a sending per recipient
		foreach($to as &$recipient) {
			if(!mail($recipient, $subject, $message, $headers, '-f'.$from)) {
				$emailErrors[] = array(
					'errno' => 0,
					'error' => 'Send e-mail impossible.',
					'to' => $recipient,
					'subject' => $subject,
					'body' => $message,
					'header' => $headers
				);
			}
		}
		return count($emailErrors) ? $emailErrors : null;
	}
}
?>