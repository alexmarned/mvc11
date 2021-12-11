<?php
session_start();
$conf = dirname(__DIR__) . '/config/config.php';
require_once($conf);
$db_conf = dirname(__DIR__) . '/config/db.php';
require_once $db_conf;

function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}

// initialize variables
$vendor_code = '';
$price = '';
$name = "";
$product_dimensions = "";
$user_id = '';
$id = 0;
$update = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM products WHERE id=$id");

    if (($record->num_rows) == 1) {
        $n = mysqli_fetch_array($record);
        $vendor_code = clean($n['vendor_code']);
        $price = clean($n['price']);
        $name = clean($n['name']);
        $product_dimensions = clean($n['product_dimensions']);
        require_once ('prod_form.php');
        echo 'forma must be loadid' . '<br>';
    }
}


if (isset($_POST['save'])) {
    $vendor_code = clean($_POST['vendor_code']);
    $price = clean($_POST['price']);
    $name = clean($_POST['name']);
    $product_dimensions = clean($_POST['product_dimensions']);
    $user_id = $_COOKIE['id'];
    
    if (!empty( $vendor_code) and !empty($price) and !empty($name) and !empty($product_dimensions) ) {

    mysqli_query($link, "INSERT INTO products (`id`, `vendor_code`, `price`, `name`, `product_dimensions`, `user_id`) VALUES (NULL, '$vendor_code', '$price',  '$name', '$product_dimensions',  '$user_id')");
    $_SESSION['message'] = "Product saved";
    header('location: ../index.php');
    } else {
       $_SESSION['message'] = "Вы не заполнили поля формы";
    header('location: prod_form.php'); 
    }
    
}


if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $vendor_code = clean($_REQUEST['vendor_code']);
    $price = clean($_POST['price']);
    $name = clean($_POST['name']);
    $product_dimensions = clean($_POST['product_dimensions']);
    
if (!empty( $vendor_code) and !empty($price) and !empty($name) and !empty($product_dimensions) ) {
    mysqli_query($link,
            "UPDATE `products` SET `vendor_code` ='$vendor_code' , `price` = '$price', `name` = '$name', `product_dimensions` = '$product_dimensions' WHERE `id` = $id");

    $_SESSION['message'] = "Products updated!";
    $home_url = '../index.php';
    header('location:' . $home_url);
}   else {
       $_SESSION['message'] = "Вы не заполнили поля формы";
    header('location: ../index.php'); 
    }   
}

if (isset($_GET['del'])) {
    if ($_COOKIE['role'] == '1') {
        $id = $_GET['del'];
        mysqli_query($link, "DELETE FROM products WHERE id=$id");
        $_SESSION['message'] = "Products deleted!";
        $home_url = '../index.php';
        header('location:' . $home_url);
    } else {
        $_SESSION['message'] = "Удалять товары может только адмиистратор с высшим доступом";
        $home_url = '../index.php';
        header('location:' . $home_url);
    }
}
?>