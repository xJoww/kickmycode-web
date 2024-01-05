<?php

    session_destroy();
    unset($_SESSION);
    $_SESSION[] = "";

    header ("Location: index.php?page=login");
    exit;