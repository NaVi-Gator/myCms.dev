<?php
if (!isset ($_SESSION))
    session_start();
function getStatusAdminCookie()
{
    if (isset($_COOKIE['login_admin']) && isset($_COOKIE['pass_admin'])) {
        $status = getAdminStatus($_COOKIE['login_admin'], $_COOKIE['pass_admin']);
        return $status;
    }
    return false;
}

function setCookieAdmin($login, $pass)
{
    setcookie("login_admin", $login, time() + 86400);
    setcookie("pass_admin", md5($pass), time() + 86400);
}

?>