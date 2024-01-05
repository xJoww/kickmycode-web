<?php

    session_start();

    if (isset($_GET['auth'])) {

        header ("Location: index.php?page=dashboard");
        exit;
    }
    else if (isset($_GET['page'])) {

        $page = $_GET['page'];

        if ($page === 'login') {

            include 'auth/login.php';
        }
        else if ($page === 'logout') {

            include 'auth/logout.php';
        }
        else if ($page === 'register') {

            include 'auth/register.php';
        }
        else if ($page === 'dashboard') {

            include 'home/dashboard.php';
        }
    }
    else {

        header ("Location: index.php?page=login");
        exit;
    }