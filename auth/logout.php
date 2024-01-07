<?php

    session_destroy();
    unset($_SESSION);
    $_SESSION[] = "";

    setcookie('user_email', '', time() - 1);
    setcookie('user_pass', '', time() - 1);

    header ("Location: index.php?page=login");
    exit;