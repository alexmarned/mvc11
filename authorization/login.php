<?php
// Страница авторизации
include_once '../header.php';
include_once '../nav_reg.php';
include_once '../config/config.php';
include_once '../config/db.php';

// Функция для генерации случайной строки
function generateCode($length = 6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

if (isset($_POST['submit'])) {
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link, "SELECT user_login, user_id, user_password, role FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    // Сравниваем пароли
    if ($data['user_password'] === md5(md5($_POST['password']))) {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
        $insip = "";
        if (!empty($_POST['not_attach_ip'])) {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')";
        }

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='" . $hash . "' " . $insip . " WHERE user_id='" . $data['user_id'] . "'");

        setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30, "/");
        setcookie("author", $data['user_login'], time() + 60 * 60 * 24 * 30, "/");
        setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/", null, null, true);
        setcookie('role', $data['role'], time() + 60 * 60 * 24 * 30, "/");

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check.php");
        //exit();
    } else {
        print "Вы ввели неправильный логин/пароль";
    }
}

include_once '../footer.php';
?>

<div class="container">
    <center><h3>Войти на сайт</h3></center>
    <form method="POST">
        Логин <input name="login" type="text" required  class="form-control"><br>
        Пароль <input name="password" type="password" required   class="form-control"><br>

     <!--   Чужой компьютер <input type="checkbox" name="not_attach_ip"><br> -->
        <input name="submit" type="submit" value="Войти"> 
    </form>

</div>
