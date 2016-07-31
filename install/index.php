<?php
if (file_exists('../config.php'))
    include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
$url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'];
if (defined('HOST') || defined('USER') || defined('PASS')) {
    header('Location: ' . $url . '/admin');
}

$error_install = '';
$errors = array();
$db_prefix = 'My_';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['install_new_information'])) {
    if (strlen($_POST['db_host']) > 0) {
        $db_host = $_POST['db_host'];
    } else {
        $db_host = '';
    }
    if (strlen($_POST['db_login']) > 0) {
        $db_login = $_POST['db_login'];
    } else {
        $db_login = '';
    }
    if (strlen($_POST['db_pass']) > 0) {
        $db_pass = $_POST['db_pass'];
    } else {
        $db_pass = '';
    }
    if (strlen($_POST['admin_email']) > 0) {
        $admin_email = $_POST['admin_email'];
    } else {
        $admin_email = '';
    }
    if (strlen($_POST['admin_pass']) > 0) {
        $admin_pass = $_POST['admin_pass'];
    } else {
        $admin_pass = '';
    }
    if (strlen($_POST['db_prefix']) > 0) {
        $db_prefix = $_POST['db_prefix'];
    } else {
        $db_prefix = 'My_';
    }
    if (validate()) {
        $error_install = createTable($db_host, $db_login, $db_pass, $admin_email, $admin_pass, $db_prefix);
        if ($error_install === 'ok')
            header('Location: ' . $url . '/admin');
    }
}
include_once(__DIR__ . '/view\content.php');

//validate валідування даних
function validate()
{
    global $errors;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['install_new_information'])) {
            if (strlen($_POST['db_host']) == 0)
                $errors['db_host'] = 'error';
            if (strlen($_POST['db_login']) == 0)
                $errors['db_login'] = 'error';
            if (strlen($_POST['db_pass']) == 0)
                $errors['db_pass'] = 'error';
            if (strlen($_POST['admin_email']) == 0)
                $errors['admin_email'] = 'error';
            if (strlen($_POST['admin_pass']) == 0)
                $errors['admin_pass'] = 'error';
            if (strlen($_POST['db_prefix']) == 0)
                $errors['db_prefix'] = 'error';

        }
    }
    if ($errors)
        return false;
    else
        return true;
}

//createTable створення та запис даних в таблицю
function createTable($host, $login, $pass, $admin_email, $admin_pass, $prefix)
{
    @ $DataBase = new mysqli($host, $login, $pass);
    if ($DataBase->connect_errno === 0) {
        $db_shem = $DataBase->escape_string('dev_my_cms');
        $prefix = $DataBase->escape_string($prefix);
        $db_shem = $prefix . "_" . $db_shem;
        $DataBase->query("DROP DATABASE `" . $db_shem . "`;");
        $DataBase->query("CREATE DATABASE " . $db_shem . ";");
        if ($DataBase->errno === 0) {
            $sql = "CREATE TABLE " . $db_shem . "." . $prefix . "_admin (
	                id int(11) NOT NULL auto_increment,
	                email varchar(50) NOT NULL default '',
	                pass varchar(50) NOT NULL default '',
	                PRIMARY KEY (id))";
            $DataBase->query($sql);
            if ($DataBase->errno === 0) {
                $DataBase->query("INSERT INTO `" . $db_shem . "`.`" . $prefix . "_admin` (`id`, `email`, `pass`) VALUES (NULL, '" . $DataBase->escape_string($admin_email) . "', '" . md5($DataBase->escape_string($admin_pass)) . "')");
                if ($DataBase->errno === 0) {
                    $sql = "CREATE TABLE " . $db_shem . "." . $prefix . "_posts (
	                id int(11) NOT NULL auto_increment,
	                title varchar(50) NOT NULL default '',
	                content text NOT NULL,
	                create_time int(20) NOT NULL default 0,
	                PRIMARY KEY (id));";
                    $DataBase->query($sql);
                    if ($DataBase->errno === 0) {
                        $DataBase->close();
                        saveConfig($host, $login, $pass, $db_shem, $prefix);
                        return 'ok';
                    } else {
                        return "Помилка створення таблиці постів";
                    }
                } else
                    return "Помилка запису в базу";
            } else
                return "Помилка створення таблиці адміністраторів";
        } else {
            return 'Помилка створення бази данних';
        }
    } else
        return 'Помилка з\'єднання з сервером';

}

//saveConfig запис даних в конфыгураційний файл
function saveConfig($host, $login, $pass, $db_table, $prefix)
{
    $files = $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    $fp = fopen($files, 'w+');
    $save_to_file = "<?php
define('HOST', '" . $host . "');
define('USER', '" . $login . "');
define('PASS', '" . $pass . "');
define('DATABASE', '" . $db_table . "');
define('PR', '" . $prefix . "_');
?>";
    fwrite($fp, $save_to_file);
    fclose($fp);
}

?>