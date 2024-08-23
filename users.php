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
                    <h2>Users List</h2>

                    <div class="card">
                        <div class="card-header">
                            <form class="row" action="receipts.php" method="POST" role="search">
                                <div class="col-md-6 justify-content-start">
                                    <input type="text" class="form-control" id="search" name="search" value="" placeholder="Search Party Neme" onkeyup="searchuserFun()">
                                </div>
                                <div class="col-md-2 justify-content-md-end">
                                    <a href="users_create.php" class="btn btn-info me-md-2 text-light" type="button"><i class="fa-solid fa-user-plus"></i> Create</a>
                                </div>
                            </form>

                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ----- -->
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            //   echo $row['party_name'];

                                    ?>

                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['user_role']; ?></td>
                                                <td class="text-success">

                                                    <?php
                                                    if ($_SESSION['user_role'] == 'admin') {

                                                        if ($row['status'] == 1) {
                                                            echo '<p> <a class="text_a" href="user_active.php?id=' . $row['id'] . '&status=0">
                                                        Active</a></p>';
                                                        } else {
                                                            echo '<p> <a class="text" href="user_active.php?id=' . $row['id'] . '&status=1">
                                                        Block</a></p>';
                                                        }
                                                    } else {
                                                        if ($row['status'] == 1) {
                                                            echo '<span class="text_a">Active</span>';
                                                        } else {
                                                            echo '<span class="text">Block</span>';
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <a class="btn btn-sm btn-warning text-light" href="users_edit.php?user_id=<?php echo $row['id']; ?>">
                                                        Edit</a>

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

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    const searchuserFun = () => {
        let filtr = document.getElementById('search').value.toUpperCase();
        let my_table = document.getElementById('example2');
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
</script>

<?php
include('includes/footer.php');
?>