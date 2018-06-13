<?php

class Logger1 {
	const LOG_ERROR = 0; // Something important broke
	const LOG_NOTICE = 1; // Please be aware of
	const LOG_INFO = 2; // Nothing broken, general operation
	const LOG_DEBUG = 3; // Debug messages

	/**
	* Log an event to logs and if required email to the site administrator
	*/
	public static function logEvent($level, $file, $line, $message) {
		if ($level <= LOG_LEVEL) {
			// Strip newlines from log messages
			$message = str_replace(array("\r", "\n"), ' ', $message);
			if (!defined('LOG_PATH')) {
				// Just show screen events untill someone fixes the logging
				echo "Notice: LOG_PATH not defined! $event<br />\n";
			} else {
				// Log the event to a file
				$filepath = rtrim(LOG_PATH,'/').'/'.date('Y-m', time()).'.log';
				$fh = fopen($filepath, 'a') or die("Unable to open '".$filepath."' for writing, check permissions<br />\n");
				$timestamp = date('d H:i:s', time());
				$line = "$timestamp [$file:$line] $message\n";
				fwrite($fh, $line);
				fclose($fh);
			}
			// Print LOG_ERROR and LOG_NOTICE messages to screen when in debug mode
			if (DEBUG && $level <= Logger1::LOG_NOTICE) {
				print("<pre>\n");
				print_r(debug_backtrace());
				print("</pre>\n");
			}
			// Mail Errors and notices to the admin
			if ($level <= Logger::LOG_NOTICE) {
				$ip = gethostbyname($_SERVER["SERVER_NAME"]);
//				mail(DEV_EMAIL, SITE_NAME.' Error - '.$_SERVER["SERVER_NAME"].'['.$ip.']', "<b>".$message."</b><br />\n<br />\n<pre>\n".print_r(debug_backtrace(), true)."</pre>"."<br />\nPOST:<br />\n".print_r($_POST, true)."<br />\nGET:<br />\n".print_r($_GET, true)."<br />\nSESSION:<br />\n".print_r($_SESSION, true));
			}
		}
	}
}

?>