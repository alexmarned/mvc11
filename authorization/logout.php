<?php

// Страница разавторизации
// Удаляем куки
setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/", null, null, true);

setcookie("author", "", time() - 60 * 60 * 24 * 30, "/");
// httponly !!!
// Переадресовываем браузер на страницу проверки нашего скрипта
header("Location: ../index.php");
exit;
?>
