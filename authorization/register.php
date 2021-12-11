<?php
// Страница регистрации нового пользователя
include_once '../header.php';
include_once '../nav_reg.php';
// Соединямся с БД

include_once '../config/db.php';

if (isset($_POST['submit'])) {
    $err = [];

    // проверям логин
    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        
    }  
    
     if (strlen($_POST['password']) < 3 or strlen($_POST['password']) > 30 ) {
        $err[] = "Пароль должен быть не меньше 3-х символов и не больше 30";
        
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='" . mysqli_real_escape_string($link, $_POST['login']) . "'");
    if (mysqli_num_rows($query) > 0) {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if (count($err) == 0) {

        $login = $_POST['login'];
        $role = $_POST['role'];

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));
        mysqli_query($link, "INSERT INTO users SET user_login='" . $login . "', user_password='" . $password . "', role='" . $role . "'  ");
        header("Location: login.php");
    } else {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
}

include_once '../footer.php';
?>

<div class="container">
    <center><h4>форма регистрации нового пользователя</h4></center>

    <form  method="POST">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" >
        </div>

        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password"  name="password">
        </div>

        <div class="mb-3">
            <label for="Role" class="form-label">Role for admin</label>
            <br>
            <input type="radio" class="" id="role"  name="role" value="1" checked >Admin
            <br>
            <input type="radio" class="" id="role2"  name="role" value="0" checked >User
        </div>

        <button name="submit"  type="submit" class="btn btn-primary">Зарегистрироваться</button>

    </form>
</div>
