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
                <div class="col-md-12 col-12">
                    <h2>Receipts List</h2>

                    <div class="card">
                        <div class="card-header">
                            <form class="row" action="" method="POST" role="search">
                                <div class="col-md-6 justify-content-start">
                                    <input type="text" class="form-control" id="search" name="search" value="" placeholder="Search Party Name or PAN">
                                </div>
                                <div class="col-md-4 justify-content-start">
                                    <button class="btn bg-dark bg-gradient text-light" name="searchbtn" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i> Search
                                    </button>
                                    <a href="receipts.php" class="btn bg-danger bg-gradient text-light" type="button"><i class="fa-solid fa-xmark"></i> Clear</a>
                                </div>
                                <div class="col-md-2 justify-content-md-end">
                                    <a href="receipts_create.php" class="btn btn-info text-light" type="button"><i class="fa-solid fa-user-plus"></i> Create</a>
                                </div>
                            </form>
                        </div>

                        <!-- Display Results -->
                        <?php
                        $query_users = "SELECT * FROM users";
                        $query_run_users = mysqli_query($conn, $query_users);

                        if (mysqli_num_rows($query_run_users) > 0) {
                            foreach ($query_run_users as $user) {
                                $user_id = $user['id'];
                                $user_name = $user['name'];
                        ?>
                        <?php
                            }
                        }
                        ?>
                        <div class="card-body">
                          
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>ID</th>
                                        <th>Party Name</th>
                                        <th>Member</th>
                                        <th>City</th>
                                        <th>Mobile</th>
                                        <th>Pan</th>
                                       <!-- <th>Deposit Bank</th> -->
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $row_number = 1;
                                    if (isset($_POST['searchbtn'])) {
                                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                                        $sql = "SELECT * FROM receipts WHERE party_name LIKE '%$search%' OR pan LIKE '%$search%' ORDER BY trans_date ASC";
                                    } else {
                                        $sql = "SELECT * FROM receipts  WHERE user_id='$user_id' ORDER BY trans_date ASC";
                                    }

                                    $res = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            
                                            // Original date in YYYY-MM-DD format
                                                $originalDate = $row["trans_date"];

                                                // Convert the date to a new format
                                                $newDate = date("d/m/Y", strtotime($originalDate));
                                            ?>
                                            <tr>
                                                <td><?php echo $row_number++; ?></td>
                                                <td><?php echo $row['id'] . "/" . $row['fyear_id']; ?></td>
                                                <td><?php echo $row['party_name']; ?></td>
                                                <td><?php echo $row['bank_name']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td><?php echo $row['pan']; ?></td>
                                               <!-- <td><?php // echo $row['deposite_bank']; ?></td> -->
                                                <td><?php echo $row['receipt_amount']; ?></td>
                                                <td><?php echo $newDate; ?></td>
                                                <td>
                                                    <?php
                                                    if ($_SESSION['user_role'] == 'admin') {
                                                        if ($row['status'] == 1) {
                                                            echo '<p><a class="badge bg-success" href="approved.php?id=' . $row['id'] . '&status=0">Approved</a></p>';
                                                        } else {
                                                            echo '<p><a class="badge bg-info" href="approved.php?id=' . $row['id'] . '&status=1">In Approval</a></p>';
                                                        }
                                                    } else {
                                                        if ($row['status'] == 1) {
                                                            echo '<span class="badge bg-success">Approved</span>';
                                                        } else {
                                                            echo '<span class="badge bg-info">In Approval</span>';
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning text-light" href="receipts_edit.php?user_id=<?php echo $row['id']; ?>">Edit</a>
                                                    <a class="btn btn-sm btn-secondary" target="_blank" href="print.php?MST_ID=<?php echo $row['id']; ?>&ACTION=VIEW">Print</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='12'>No Record Found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>

<?php
include('includes/footer.php');
?>