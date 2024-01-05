<?php
    require 'database/connect.php';

    if (!isset($_SESSION['auth'])) {

        header ("Location: index.php?page=login");
        exit;
    }
    $user = $_SESSION['user'];
    unset ($_SESSION['rows_page']);

    $query = "SELECT * FROM tabel WHERE user = '$user'";
    $result = mysqli_query($db, $query);

    if (isset($_GET['p'])) {

        $_SESSION['rows_page'] = $_GET['p'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickMyCode - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="jQuery/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="assets/js/dashboard.js?v=1"></script>
</head>
<body>
    <nav class="navbar bg-green-500">
        <div class="container-fluid my-2">
            <div>
                <button type="button" class="text-white text-lg me-2 border rounded-1 px-1 py-0 hover:border-0 hover:bg-white" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar"><i class="bi bi-list hover:text-green-500"></i></button>
                <a href="" class="navbar-brand fw-semibold text-white">Dashboard</a>
            </div>
            <div>
                <input class="form-control px-2.5 py-1 border-0 me-2" type="search" name="keyword" id="keyword" placeholder="Find by Email" aria-label="Search">
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-start text-zinc-500" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-green-500 fs-4 fw-bold" id="sidebarLabel">KickMyCode</h5>
        </div>
        <div class="offcanvas-body">
            <div class="fw-semibold text-md bg-zinc-300 p-2 rounded hover:text-zinc-600" style="cursor: default;">
                <i class="bi bi-house-door-fill me-2"></i>Dashboard
            </div>
            <div class="fw-semibold text-md my-2 hover:text-zinc-600">
                <a href="?page=settings"><i class="bi bi-gear-fill me-2"></i>Settings</a>
            </div>
            <div class="fw-semibold text-md hover:text-zinc-600">
                <a href="?page=logout"><i class="bi bi-box-arrow-in-left me-2"></i>Logout</a>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-2">
                    <table class="table table-striped table-hover table-responsive border-zinc-700 hover:bg-zinc-800">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Email</th>
                            <th scope="col">Email password</th>
                            <th scope="col">Stake password</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="live-table">

                    </tbody>
                    </table>

                    <?php if (!mysqli_num_rows($result)) : ?>
                        <p class="text-sm text-center text-secondary">There are no data availables here</p>
                    <?php else : ?>
                        <p class="text-md text-center text-secondary" id="loading-data"><i class="bi bi-arrow-repeat me-1"></i>Please wait..</p>
                    <?php endif; ?>

                </div>
            </div>
            <div class="row">

                <div class="col-2">
                    <button class="btn btn-sm bg-blue-600 text-white hover:bg-blue-700" type="button" data-bs-toggle="modal" data-bs-target="#input_data" id="input_btn">Input data</button>
                </div>

                <div class="col-10">
                    <nav aria-label="Tables pagination">
                        <ul class="pagination float-end" id="live-pagination">

                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="input_data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="input_data_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="home/ajax/dashboard-createdata.php" method="post" id="form_add">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="input_data_label">Input Account Form</h1>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <label for="email" class="form-label mb-1">Email address</label>
                                <input type="email" name="email" class="form-control rounded border border-dark" id="email" placeholder="Enter Email" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="email_pw" class="form-label mb-1">Email password</label>
                                <input type="text" name="email_pw" class="form-control rounded border border-dark mb-1" id="email_pw" placeholder="Enter email password">
                            </div>
                            <div class="mb-3">
                                <label for="stake_pw" class="form-label mb-1">Stake password</label>
                                <input type="text" name="stake_pw" class="form-control rounded border border-dark mb-1" id="stake_pw" placeholder="Enter stake passwrod">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm text-white bg-zinc-500 hover:bg-zinc-600" data-bs-dismiss="modal" id="close_btn">Close</button>
                        <button type="submit" class="btn btn-sm text-white bg-green-500 hover:bg-green-600" name="create_btn" id="create_btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toast_alert" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-zinc-300">
                <strong class="me-auto"><i class="bi bi-info-circle me-2"></i>Information</strong>
                <small>Now</small>
                <button type="button" class="btn-close text-red-600 text-lg mb-2 hover:text-red-700" data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg me-2"></i></button>
            </div>
            <div class="toast-body">
                Successfully inserted your data!
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>