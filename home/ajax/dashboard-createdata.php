<?php

    include '../../database/connect.php';

    session_start();
    $user = $_SESSION['user'];

    if (isset($_POST['email']) && isset($_POST['email_pw']) && isset($_POST['stake_pw'])) {

        $email = $_POST['email'];
        $email_pw = $_POST['email_pw'];
        $stake_pw = $_POST['stake_pw'];

        date_default_timezone_set('Asia/Jakarta');

        $date_today = date("d/m/Y, H:i");
        $date_later = date('d/m/Y, H:i', strtotime('+144 hours'));
        $date_6hr = date('d/m/Y, H:i', strtotime('+150 hours'));

        mysqli_query($db, "INSERT INTO tabel (id, user, tanggal, expire, expire_6hr, email, email_pw, stake_pw) VALUES ('', '$user', '$date_today', '$date_later', '$date_6hr', '$email', '$email_pw', '$stake_pw')");
    }