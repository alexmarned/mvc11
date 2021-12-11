<?php
//session_start();
include_once 'config/config.php';
include_once 'config/db.php';
?>

<!doctype html>
<html lang="ru">
    <head>
        <!-- Обязательные метатеги -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css"
              href="<?php echo $main_url . '/products/style.css' ?> ">
        <title>blog product</title>
    </head>
    <body>

        <?php // echo '<br>' . 'header.php'  ?>
      
