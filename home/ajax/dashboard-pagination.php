<?php

    require '../../database/connect.php';

    session_start();
    if (isset($_COOKIE['user_email'])) {

        $user = $_COOKIE['user_email'];
    }
    else {

        $user = $_SESSION['user'];
    }
    $query = "SELECT * FROM tabel WHERE user = '$user' ORDER BY id ASC";
    $result = mysqli_query($db, $query);

    $total_page = ceil(mysqli_num_rows($result) / $_SESSION['limit_rows']);
?>

<li class="page-item">
    <?php if ($_SESSION['active_page'] <= 1) : ?>
        <a class="page-link border border-secondary text-zinc-500 text-xs hover:text-white hover:bg-zinc-500 disabled" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    <?php else : ?>
        <a class="page-link border border-secondary text-zinc-500 text-xs hover:text-white hover:bg-zinc-500" href="?page=dashboard&p=<?= $_SESSION['active_page'] - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    <?php endif; ?>
</li>
<?php $p = 1; ?>
<?php for ($id = 0; $id < $total_page; $id ++) : ?>
    <?php if ($_SESSION['active_page'] == $p) : ?>
        <li class="page-item"><p class="page-link border border-secondary bg-zinc-500 text-white text-xs hover:bg-zinc-600"><?= $id+1; ?></p></li>
    <?php else : ?>
        <li class="page-item"><a class="page-link border border-secondary text-zinc-500 text-xs hover:text-white hover:bg-zinc-500" href="?page=dashboard&p=<?= $p; ?>"><?= $id+1; ?></a></li>
    <?php endif; ?>
    <?php $p ++; ?>
<?php endfor; ?>
<li class="page-item">
    <?php if ($_SESSION['active_page'] >= $total_page) : ?>
        <a class="page-link border border-secondary text-zinc-500 text-xs hover:text-white hover:bg-zinc-500 disabled" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    <?php else : ?>
        <a class="page-link border border-secondary text-zinc-500 text-xs hover:text-white hover:bg-zinc-500" href="?page=dashboard&p=<?= $_SESSION['active_page'] + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    <?php endif; ?>
</li>