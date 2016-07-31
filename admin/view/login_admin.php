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
        <div class="setup_form">
            <form method="post">
                <table>
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
                            <input type="submit" name="login_admin" value="Ввійти">
                        </td>
                    </tr>

        </div>
        <div class="footer"></div>
    </div>
</body>
</html>
