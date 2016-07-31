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
    <div class="saite_bar">
        <ul>
            <li><a href="<?php echo $url ?>/admin?page=edit">Редагувати</a></li>
            <li><a href="<?php echo $url ?>/admin">Додати</a></li>
        </ul>
    </div>
    <div class="content">
        <form method="post" class="post_form">
            <table>
                <tr><h2><?php echo $status; ?></h2>
                </tr>
                <tr>
                    <td><p>Назва: </p></td>
                    <td><input type="text" required name="post_title" value=""></td>
                </tr>
                <tr>
                    <td><p>Контент: </p></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><textarea required name="post_content"></textarea></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="<?php echo $submlit_post; ?>" value="Зберегти">
                    </td>
                </tr>


            </table>

        </form>
    </div>
    <div class="footer"></div>

</body>
</html>
