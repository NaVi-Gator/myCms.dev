<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
@$DataBase = mysqli_connect(HOST, USER, PASS, DATABASE);

function getAdminStatus($email, $pass)
{
    global $DataBase;
    $email = $DataBase->escape_string($email);
    $pass = $DataBase->escape_string($pass);
    $sql = "SELECT id FROM `" . PR . "admin` WHERE email='" . $email . "' AND pass='" . $pass . "'";
    $res = $DataBase->query($sql);
    $res->data_seek(0);
    $row = $res->fetch_assoc();
    if (strlen($row['id']) > 0)
        return true;
    else
        return false;
}

function setPostToDataBase($title, $content)
{
    global $DataBase;
    $title = $DataBase->escape_string($title);
    $content = $DataBase->escape_string($content);
    $time = $DataBase->escape_string(time());
    $sql = "INSERT INTO `" . DATABASE . "`.`" . PR . "posts` (`id`, `title`, `content`, `create_time`) VALUES (NULL, '" . $title . "', '" . $content . "', '" . $time . "')";
    $DataBase->query($sql);
    $res = $DataBase->query("SELECT id FROM `My__posts` WHERE create_time='" . $time . "'");
    $res->data_seek(0);
    $row = $res->fetch_assoc();
    if (strlen($row['id']) > 0)
        return $row['id'];
    else
        return '-1';
}

function showArray($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>