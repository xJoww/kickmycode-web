<?php

    require '../../database/connect.php';

    date_default_timezone_set('Asia/Jakarta');
    session_start();

    $user = $_SESSION['user'];

    $data_start = $_SESSION['start_data'];
    $rows_limit = $_SESSION['limit_rows'];

    $query = "SELECT * FROM tabel WHERE user = '$user' ORDER BY id ASC LIMIT $data_start, $rows_limit";
    $result = mysqli_query($db, $query);
?>

<?php $id = 0; ?>
<?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <th scope="row"><?= ($id+1) + ($_SESSION['limit_rows'] * ($_SESSION['active_page'] - 1)); ?></th>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['email_pw'] ?></td>
        <td><?= $row['stake_pw'] ?></td>
        <?php if (date("d/m/Y, H:i") >= $row['expire']) : ?>
            <?php if (date("d/m/Y, H:i") >= $row['expire_6hr']) : ?>
                <td>
                    <p class="bg-green-500 text-xs text-white inline-flex py-1 px-2 rounded-sm">Landing!</p>
                </td>
            <?php else : ?>
                <td>
                    <p class="bg-yellow-500 text-xs text-white inline-flex py-1 px-2 rounded-sm">Need to read!</p>
                </td>
            <?php endif; ?>
        <?php else : ?>
            <td>
                <p class="bg-red-500 text-xs text-white inline-flex py-1 px-2 rounded-sm">Not yet</p>
            </td>
        <?php endif; ?>
        <td>
            <button type="button" class="btn btn-sm text-white bg-blue-600 hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#edit_data">Edit</button>
        </td>
    </tr>
<?php $id ++; ?>
<?php endwhile; ?>