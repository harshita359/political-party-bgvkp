<?php
require_once "db/config.php";

check_login();

include('includes/header.php');
include('includes/topnavbar.php');
?>

<div class="wrapper">
    <main class="py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card text-gray mb-3 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Total Receipts</h5>
         <?php
        if ($_SESSION['user_role'] == 'admin') {
            $query = "SELECT * FROM receipts";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $Receipts_total = mysqli_num_rows($result);
                if ($Receipts_total > 0) {
                    echo '<p class="card-text">' . $Receipts_total . '</p>';
                } else {
                    echo '<p class="card-text">No Data</p>';
                }
            } else {
                echo '<p class="card-text">Error: ' . mysqli_error($conn) . '</p>';
            }
        } else if ($_SESSION['user_role'] == 'user') {
            $user_id = $_SESSION['user']['id'];
            $query = "SELECT * FROM receipts WHERE user_id='$user_id'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $Receipts_total = mysqli_num_rows($result);
                if ($Receipts_total > 0) {
                    echo '<p class="card-text">' . $Receipts_total . '</p>';
                } else {
                    echo '<p class="card-text">No Data</p>';
                }
            } else {
                echo '<p class="card-text">Error: ' . mysqli_error($conn) . '</p>';
            }
        }
        ?>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="receipts.php" class="btn btn-secondary me-md-2" type="button">Receipts</a>
                                <a href="receipts_create.php" class="btn btn-info me-md-2 text-light" type="button"><i class="fa-solid fa-user-plus"></i> Create</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                if ($_SESSION['user_role'] == 'admin') {
                    ?>
                <div class="col-md-4 ">
                    <div class="card text-gray mb-3 border-secondary">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <?php
                            
                            $query = "SELECT * FROM users";
                            $result = mysqli_query($conn, $query);
                            if ($users_total = mysqli_num_rows($result)) {
                                echo '<p class="card-text">' . $users_total . '</p>';
                            } else {
                                echo '<p class="card-text">No Data</p>';
                            }
                      
                            ?>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="users.php" class="btn btn-secondary me-md-2" type="button">Users</a>
                                <a href="users_create.php" class="btn btn-info me-md-2 text-light" type="button"><i class="fa-solid fa-user-plus"></i> Create</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php   } ?>
            </div>
        </div>
    </main>

</div>

<?php
include('includes/footer.php');
?>