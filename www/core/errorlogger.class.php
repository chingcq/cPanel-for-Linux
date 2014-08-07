<?php
/**
 * E_ERROR = 1
 * E_WARRNING = 2
 * E_USER_ERROR = 256
 */
Class ErrorLogger{
	public $msg;
	public $time;
	public $date;
	public $ip;
	public $logfile= '/log/errors.log';
	public $text;
	public $code;
	public $file;
	public $line;

	public function error_logger($code, $msg, $file, $line){
		$this->code = $code;
		$this->file = $file;
		$this->line = $line;
		$this->msg  = $msg;

		switch($code){
			case '1' :
							echo 'WARNING:' . $this->msg . 'In ' . $this->file . ', line ' . $this->line . '<br>';
				Errorlogger::error_show($this->text);
				die ('ERROR:' . $this->msg . '<br>In ' . $this->file . ', line ' . $this->line . '<br>');
			break;

			case '2' :
				echo 'WARNING:' . $this->msg . 'In ' . $this->file . ', line ' . $this->line . '<br>';
				Errorlogger::error_show($this->text);
				return true;
			break;

			case '256' :
				$this->text = $this->msg . '<br>' . 'File: ' . $this->file . ' ('. $this->line .')' . '<br>';
				Errorlogger::error_record($this->text);
				$this->msg = 'Critical ERROR: tasks was not complited.';
				$this->text = $this->msg . '<br>' . 'File: ' . $this->file . ' ('. $this->line .')' . '<br>';
				Errorlogger::error_show($this->text);
				return true;
			break;
			default :
		}
	}

	public function error_record($text){		$this->time=date('H:i');
		$this->date=date('Y-m-d');
		$this->ip=$_SERVER['REMOTE_ADDR'];
		$this->logfile = SRV_ROOT . $this->logfile;
		$this->text = str_replace("<br>", "\\t", $this->text);
		if (fopen($this->logfile, "a+")) {
			$fh = fopen($this->logfile, "a+");
			fputs($fh, $this->date . "\\t" . $this->time . "\\t" . $this->ip . "\\t" . $this->text . "\\n");
			fclose($fh);
		}
	}

	public function error_show($text){
		$this->text = $text;
		echo $this->text;
	}
}