<?php
// At the very top of your file
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// For Railway, log to stderr so it appears in railway logs
ini_set('error_log', 'php://stderr');