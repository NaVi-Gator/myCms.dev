<?php
if (file_exists('../config.php'))
    include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
$url = $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'];
$submlit_post = 'install_new_information';
if (!defined('HOST') || !defined('USER') || !defined('PASS')) {
    header('Location: ' . $url . '/install/index.php');
} else {
    include_once($_SERVER['DOCUMENT_ROOT'] . '/system/db.lib.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/system/cookies.lib.php');
    if ($_GET['page'] == 'edit_list' && isset($_GET['page_id'])) {
        if ((int)$_GET['page_id'] > 0) {
            $status = "Список постів";
            include_once(__DIR__ . '/view/admin_post_edit.php');
        }
        include_once(__DIR__ . '/view/admin_post.php');
    } else

        if ($_GET['page'] === 'edit') {
            if ((int)$_GET['page_id'] > 0) {
                $id_post = (int)$_GET['page_id'];
                $status = "Редагувати пост";
                include_once(__DIR__ . '/view/admin_post_list.php');
            } else {
                $status = "Список постів";
                include_once(__DIR__ . '/view/admin_post_edit.php');
            }

        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_admin'])) {
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
                if (validate() && getAdminStatus($admin_email, md5($admin_pass))) {
                    setCookieAdmin($admin_email, $admin_pass);
                    header('Location: ' . $url . '/admin');
                }
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['install_new_information'])) {
                if (validate()) {
                    $status = 'Запис збережено';
                    $post_id = setPostToDataBase($_POST['post_title'], $_POST['post_content']);
                    include_once(__DIR__ . '/view/admin_post.php');
                }
            } else {
                if (!getStatusAdminCookie()) {
                    include_once(__DIR__ . '/view/login_admin.php');
                } else {
                    include_once(__DIR__ . '/view/admin_post.php');
                }
            }
        }
}
function validate()
{
    global $errors;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['login_admin'])) {
            if (strlen($_POST['admin_email']) == 0)
                $errors['admin_email'] = 'error';
            if (strlen($_POST['admin_pass']) == 0)
                $errors['admin_pass'] = 'error';
        }
        if (isset($_POST['install_new_information'])) {
            if (strlen($_POST['post_title']) == 0)
                $errors['post_title'] = 'error';
            if (strlen($_POST['post_title']) == 0)
                $errors['post_title'] = 'error';
        }
    }

    if ($errors)
        return false;
    else
        return true;
}

?>
                    
                                                                                                             