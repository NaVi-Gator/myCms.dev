<?php
if (file_exists('config.php'))
    require_once('config.php');
$url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'];
if (!defined('HOST') || !defined('USER') || !defined('PASS')) {
    header('Location: ' . $url . '/install/index.php');
} else {
    include_once($_SERVER['DOCUMENT_ROOT'] . '/system/db.lib.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/system/cookies.lib.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/user/index.php');
}
?>