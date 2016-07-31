<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/main.js"></script>
    <title>my-cms</title>
</head>
<body>
<div class="heder">
    <img src="../../image/logo.gif" alt="logo">
</div>
<div class="body">
    <div class="saite_bar"></div>
    <div class="content">
        <h1><?php echo $error_install ?></h1>
        <div class="setup_form">
            <form method="post">
                <table>
                    <tr>
                        <td><p>Хост Бази даних: </p></td>
                        <td><input type="text" required name="db_host" value="<?php echo $db_host ?>"></td>
                        <?php if ($errors['db_host'] === 'error') { ?>
                            <td><strong>Помилка введення</strong></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><p>Логін Бази даних: </p></td>
                        <td><input type="text" required name="db_login" value="<?php echo $db_login ?>"></td>
                        <?php if ($errors['db_login'] === 'error') { ?>
                            <td><strong>Помилка введення</strong></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><p>Пароль Бази даних: </p></td>
                        <td><input type="password" required name="db_pass" value="<?php echo $db_pass ?>"></td>
                        <?php if ($errors['db_pass'] === 'error') { ?>
                            <td><strong>Помилка введення</strong></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><p>Префікс Бази даних: </p></td>
                        <td><input type="text" required name="db_prefix" value="<?php echo $db_prefix ?>"></td>
                        <?php if ($errors['db_prefix'] === 'error') { ?>
                            <td><strong>Помилка введення</strong></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><strong>Дані адміністратора</strong></td>
                    </tr>
                    <tr>
                        <td><p>Email адміна: </p></td>
                        <td><input type="email" required name="admin_email" value="<?php echo $admin_email ?>"></td>
                        <?php if ($errors['admin_email'] === 'error') { ?>
                            <td><strong>Помилка введення</strong></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><p>Пароль адміна: </p></td>
                        <td><input type="password" required name="admin_pass"
                                   value="<?php echo $admin_pass ?>"></td>
                        <?php if ($errors['admin_pass'] === 'error') { ?>
                            <td><strong>Помилка введення</strong></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="install_new_information" value="Зберегти">
                        </td>
                    </tr>


                </table>
            </form>
        </div>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>
