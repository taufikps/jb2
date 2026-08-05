<?php
/**
 * Front controller with CI3 fallback and CI4-ready bootstrap.
 */

$rootPath = __DIR__;
$ci4Public = $rootPath . '/ci4/public/index.php';

if (!is_file($ci4Public)) {
    header('HTTP/1.1 500 Internal Server Error', true, 500);
    echo 'CI4 bootstrap not found. Please make sure ci4/public/index.php exists.';
    exit(1);
}

$_SERVER['CI_ENV'] = $_SERVER['CI_ENV'] ?? 'development';
putenv('CI_ENV=' . $_SERVER['CI_ENV']);
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once $ci4Public;
exit;
