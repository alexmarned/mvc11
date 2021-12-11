<?php

include_once 'header.php';

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
  
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if (@$userdata['user_hash'] ==
            $_COOKIE['hash'])
   {
        require_once 'nav_out.php';
    }
} else {
    include_once 'nav_full.php';
}


include_once 'products/index.php';
include_once 'footer.php';

