<?php
    //Set timezone, and set error logs to true for text file reporting.
    date_default_timezone_set('Africa/Johannesburg');
    error_reporting(0);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
?>