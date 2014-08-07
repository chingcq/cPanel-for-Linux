<?php
Class ErrorLogger
{
	/**
	 * list of variables
	 */
	public $msg;
	public $time;
	public $date;
	public $ip;
	public $logfile= '/log/errors.log';
	public $text;
	public $code;
	public $file;
	public $line;

	public function error_logger($code, $msg, $file, $line)
	{
		/**
		 * getting data which we resived $code, $msg, $file, $line, and storing them in class variables
		 */
		$this->code = $code;
		$this->file = $file;
		$this->line = $line;
		$this->msg  = $msg;

		/**
		 * $code will contain id which is linked to error type
		 * E_ERROR = 1
		 * E_WARRNING = 2
		 * E_USER_ERROR = 256
		 * In 1st case - display error message. and stop script with another error
		 * In 2nd case - display error and continue script
		 * In 256 case - creating string which stored in $this->text, then we record that string.
		 * after we create msg which wil be shown to user in $this->msg variable
		 * and output all the new text which stored in $this->text
		 */
		switch($code)
		{
			case '1' :
				echo 'WARNING:' . $this->msg . ' In ' . $this->file . ', line ' . $this->line . '<br>';
				die ('ERROR:' . $this->msg . '<br>In ' . $this->file . ', line ' . $this->line . '<br>');
			break;

			case '2' :
				echo 'WARNING:' . $this->msg . 'In ' . $this->file . ', line ' . $this->line . '<br>';
				return true;
			break;

			case '256' :
				$this->text = $this->msg . '<br>' . 'File: ' . $this->file . ' ('. $this->line .')' . '<br>';
				Errorlogger::error_record();
				$this->msg = 'Critical ERROR: tasks was not complited.';
				$this->text = $this->msg . '<br>' . 'File: ' . $this->file . ' ('. $this->line .')' . '<br>';
				Errorlogger::error_show();
				return true;
			break;
			default :
				'';
		}
	}
	/**
	 * function records error to file
	 */
	public function error_record()
	{
		/**
		 * $this->time contains time, $this->date contains data year-month-day format
		 * $this->ip stores ip address of user. $this->logfile stores a string with information where a 
		 * storage file is. 
		 * $this->text stores $this->text but with modified data, all '<br>' were modified to '\\t'
		 * checking if file can be opened, then we set $fh to be able to open that file
		 * then we put all the data to file eg. fputs($fopen('myfile', 'mode'), $text)
		 * then closing file
		 */		$this->time=date('H:i');
		$this->date=date('Y-m-d');
		$this->ip=$_SERVER['REMOTE_ADDR'];
		$this->logfile = SRV_ROOT . $this->logfile;
		$this->text = str_replace("<br>", "\\t", $this->text);
		if(fopen($this->logfile, "a+")) 
		{
			$fh = fopen($this->logfile, "a+");
			fputs($fh, $this->date . "\\t" . $this->time . "\\t" . $this->ip . "\\t" . $this->text . "\\n");
			fclose($fh);
		}
	}
	/**
	 * Outputs $this->text on the screen
	 */
	public function error_show()
	{
		echo $this->text;
	}
}