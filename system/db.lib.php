<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
@$DataBase = mysqli_connect(HOST, USER, PASS, DATABASE);
$format_time = 'H:i d/m/Y';
//Перевірка наявності даних адміна в базі
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

//створення нового поста
function setPostToDataBase($title, $content)
{
    global $DataBase;
    $title = $DataBase->escape_string($title);
    $content = $DataBase->escape_string($content);
    $time = $DataBase->escape_string(time());
    $sql = "INSERT INTO `" . PR . "posts` (`id`, `title`, `content`, `create_time`) VALUES (NULL, '" . $title . "', '" . $content . "', '" . $time . "')";
    $DataBase->query($sql);
    $res = $DataBase->query("SELECT id FROM `" . PR . "posts` WHERE create_time='" . $time . "'");
    $res->data_seek(0);
    $row = $res->fetch_assoc();
    if (strlen($row['id']) > 0)
        return $row['id'];
    else
        return '-1';
}

//Отримання списка постів
function getPostsList($post_id_start = 0, $number = 1)
{
    global $DataBase, $format_time;
    $post_array = array();
    if ($number <= 0) $number = 1;
    if ($post_id_start <= 0) $post_id_start = 1;
    $sql = "SELECT * FROM `" . PR . "posts` WHERE id >= " . (int)$post_id_start . " LIMIT " . (int)$number;
    $res = $DataBase->query($sql);
    $res->data_seek(0);
    while ($row = $res->fetch_assoc()) {
        $row['create_time'] = date($format_time, (int)$row['create_time']);
        array_push($post_array, $row);
    }
    return $post_array;
}

//оновлення поста
function updatePost($post_id, $title, $content)
{
    global $DataBase;
    $title = $DataBase->escape_string($title);
    $content = $DataBase->escape_string($content);
    $post_id = (int)$post_id;
    $sql = "UPDATE `" . PR . "posts` SET `content` = '" . $content . "',`title`='" . $title . "' WHERE `id` = " . $post_id . ";";
    $DataBase->query($sql);
    if ($DataBase->errno === 0)
        return true;
    else
        return false;
}

//видалення поста
function removePost($post_id)
{
    global $DataBase;
    $post_id = $DataBase->escape_string($post_id);
    $sql = "DELETE FROM `" . PR . "posts` WHERE `id` = " . $post_id;
    $DataBase->query($sql);
    if ($DataBase->errno === 0)
        return true;
    else
        return false;
}

function showArray($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>