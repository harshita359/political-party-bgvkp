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
                            <form class="row" action="receipts_search.php" method="POST" role="search">
                                <div class="col-md-6 justify-content-start">
                                    <input type="text" class="form-control" id="search" name="search" value="" placeholder="Search Party Neme or PAN" onkeyup="searchFun()">
                                </div>
                                <div class="col-md-4 justify-content-start">
                                    <button class="btn bg-dark bg-gradient text-light" name="searchbtn" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i> Search
                                    </button>
                                    <a href="receipts.php" class="btn bg-danger bg-gradient text-light" type="button"><i class="fa-solid fa-xmark"></i> Clear</a>
                                </div>
                                <div class="col-md-2 justify-content-md-end">
                                    <a href="receipts_create.php" class="btn btn-info text-light " type="button"><i class="fa-solid fa-user-plus"></i> Create</a>
                                </div>
                            </form>

                        </div>

                        <!--  -->

                        <!--  -->

                        <!-- /.card-header -->
                        <?php
                        if ($_SESSION['user_role'] == 'admin'){
                        $query_users = "SELECT * FROM users";
                        $query_run_users = mysqli_query($conn, $query_users);

                        if (mysqli_num_rows($query_run_users) > 0) {
                            foreach ($query_run_users as $user) {
                                $user_id = $user['id'];
                                $user_name = $user['name'];
                        ?>
                                <div class="card-body">
                                    <h5><?php echo $user['name'] ?></h5>
                                    <!-- id="example2" -->
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
                                            <!-- ----- -->
                                            <?php
                                            $query_receipts = "SELECT * FROM receipts  WHERE user_id='$user_id' ORDER BY trans_date ASC";
                                            $query_run_receipts = mysqli_query($conn, $query_receipts);

                                            if (mysqli_num_rows($query_run_receipts) > 0) {
                                                $row_number = 1;
                                                foreach ($query_run_receipts as $row) {
                                                    //   echo $row['party_name'];
                                                    
                                                     // Original date in YYYY-MM-DD format
                                                $originalDate = $row["trans_date"];

                                                // Convert the date to a new format
                                                $newDate = date("d/m/Y", strtotime($originalDate));

                                            ?>

                                                    <tr>
                                                        <td><?php
                                                            echo $row_number . "<br>";
                                                            $row_number++;
                                                            ?></td>
                                                        <td><?php echo $user_name . "/" . $row['id'] . "/" . $row['fyear_id']; ?></td>
                                                        <td><?php echo $row['party_name']; ?></td>
                                                        <td><?php echo $row['bank_name']; ?></td>
                                                        <td><?php echo $row['city']; ?></td>
                                                        <td><?php echo $row['mobile']; ?></td>
                                                        <td><?php echo $row['pan']; ?></td>
                                                            <!-- <td><?php // echo $row['deposite_bank']; ?></td> -->
                                                        <td><?php echo $row['receipt_amount']; ?></td>
                                                        <td><?php echo $newDate; ?></td>


                                                        <td>
                                                            <!-- <span class="badge bg-success">Approved</span> -->
                                                            <?php
                                                            if ($_SESSION['user_role'] == 'admin') {

                                                                if ($row['status'] == 1) {
                                                                    echo '<p> <a class="badge bg-success" href="approved.php?id=' . $row['id'] . '&status=0">
                                                        Approved</a></p>';
                                                                } else {
                                                                    echo '<p> <a class="badge bg-info" href="approved.php?id=' . $row['id'] . '&status=1">
                                                        In Approval</a></p>';
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
                                                            <a class="btn btn-sm btn-warning text-light" href="receipts_edit.php?user_id=<?php echo $row['id']; ?>">
                                                                Edit</a>
                                                            <a class="btn btn-sm btn-secondary" target="_blank" href="print.php?MST_ID=<?php echo $row['id']; ?>&ACTION=VIEW"> Print</a>
                                                            <!-- <a class="btn btn-sm btn-primary" href="#"> Email</a> -->
                                                        </td>
                                                    </tr>

                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <td>NO Record Found</td>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                        <?php
                            }
                        }
                    } else if($_SESSION['user_role'] == 'user') {
                        $user = $_SESSION['user'];
                        $user_id = $_SESSION['user']['id'];
                        $user_name = $_SESSION['user']['name'];
                        ?>
                        <div class="card-body">
                                    <h5><?php echo $user['name'] ?></h5>
                                    <!-- id="example2" -->
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
                                                <!--<th>Deposit Bank</th>-->
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ----- -->
                                            <?php
                                            $query_receipts = "SELECT * FROM receipts  WHERE user_id='$user_id' ORDER BY trans_date ASC";
                                            $query_run_receipts = mysqli_query($conn, $query_receipts);

                                            if (mysqli_num_rows($query_run_receipts) > 0) {
                                                $row_number = 1;
                                                foreach ($query_run_receipts as $row) {
                                                    //   echo $row['party_name'];
                                                    
                                                     // Original date in YYYY-MM-DD format
                                                        $originalDate = $row["trans_date"];

                                                        // Convert the date to a new format
                                                        $newDate = date("d/m/Y", strtotime($originalDate));

                                            ?>

                                                    <tr>
                                                        <td><?php
                                                            echo $row_number . "<br>";
                                                            $row_number++;
                                                            ?></td>
                                                        <td><?php echo $user_name . "/" . $row['id'] . "/" . $row['fyear_id']; ?></td>
                                                        <td><?php echo $row['party_name']; ?></td>
                                                        <td><?php echo $row['bank_name']; ?></td>
                                                        <td><?php echo $row['city']; ?></td>
                                                        <td><?php echo $row['mobile']; ?></td>
                                                        <td><?php echo $row['pan']; ?></td>
                                                        <!--<td><?php //echo $row['deposite_bank']; ?></td>-->
                                                        <td><?php echo $row['receipt_amount']; ?></td>
                                                        <td><?php echo $newDate; ?></td>


                                                        <td>
                                                            <!-- <span class="badge bg-success">Approved</span> -->
                                                            <?php
                                                            if ($_SESSION['user_role'] == 'admin') {

                                                                if ($row['status'] == 1) {
                                                                    echo '<p> <a class="badge bg-success" href="approved.php?id=' . $row['id'] . '&status=0">
                                                        Approved</a></p>';
                                                                } else {
                                                                    echo '<p> <a class="badge bg-info" href="approved.php?id=' . $row['id'] . '&status=1">
                                                        In Approval</a></p>';
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
                                                            <a class="btn btn-sm btn-warning text-light" href="receipts_edit.php?user_id=<?php echo $row['id']; ?>">
                                                                Edit</a>
                                                            <a class="btn btn-sm btn-secondary" target="_blank" href="print.php?MST_ID=<?php echo $row['id']; ?>&ACTION=VIEW"> Print</a>
                                                            <!-- <a class="btn btn-sm btn-primary" href="#"> Email</a> -->
                                                        </td>
                                                    </tr>

                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <td>NO Record Found</td>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                        <?php

                    }
                    
                    
                        ?>

                    </div>



                </div>
            </div>
        </div>
</div>
</main>
</div>
<!-- <script>
    const searchFun = () => {
        let filtr = document.getElementById('search').value.toUpperCase();
        let my_table = document.getElementById('example');
        let tr = my_table.getElementsByTagName('tr');
        for (var i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[2];
            if (td) {
                let textvlaue = td.textContent || td.innerHTML;
                if (textvlaue.toUpperCase().indexOf(filtr) > -1) {
                    tr[i].style.display = "";

                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script> -->

<?php
include('includes/footer.php');
?>