<?php
include_once '../config/db.php';

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
       $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
 
    if (($userdata['user_hash'] !== $_COOKIE['hash'])  
    ) {
        setcookie("login", "", time() - 60 * 60 * 24 * 30);
        setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
        setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/", null, null, true); // httponly !!!
        print "Хм, что-то не получилось";
    } else {
        header('Location: ../index.php');
    }
} else {
    print "Включите куки";
}
?>