<?php

require_once "db/config.php";
check_login();

if (isset($_POST['updateuser'])) {

    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];

    $query = "UPDATE users SET name='$name', email='$email', password='$password', user_role='$user_role' WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['status'] = "User Update Successfully";
        header("Location: users.php");
    } else {
        $_SESSION['status'] = "User Update failed!";
        header("Location: users_edit.php");
    }
}





include('includes/header.php');
include('includes/topnavbar.php');
?>

<div class="wrapper">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Create User</h2>
                    <?php
                    if (isset($_SESSION['status'])) {
                        echo '<h4 class="error">' . $_SESSION['status'] . '</h4>';
                        unset($_SESSION['status']);
                    }

                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="users.php" class="btn btn-secondary" type="button"><i class="fa-solid fa-angle-left"></i> Back</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="">
                                <?php
                                if (isset($_GET['user_id'])) {
                                    $user_id = $_GET['user_id'];
                                    $query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                ?>

                                            <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control " name="name" value="<?php echo $row['name'] ?>" required autocomplete="name" autofocus>

                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control " name="email" value="<?php echo $row['email'] ?>" required autocomplete="email">

                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control " name="password" value="<?php echo $row['password'] ?>" required autocomplete="new-password">

                                                </div>
                                            </div>

                                            <!-- <div class="row mb-3">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="<?php echo $row['password_confirmation'] ?>" required autocomplete="new-password">
                                                </div>
                                            </div> -->
                                            <div class="row mb-3">
                                                <label for="user_role" class="col-md-4 col-form-label text-md-end">User Role</label>
                                                <div class="col-md-6">

                                                <select id="user_role" name="user_role" class="form-select">
                                                <option value="">Select User Role</option>
                                                <option value="user" <?php if($row['user_role'] == 'user'){ echo "selected"; } ?>>user</option>
                                                <option value="admin" <?php if($row['user_role'] == 'admin'){ echo "selected"; } ?>>admin</option>
                                               
                                            </select>                     
                                                </div>
                                            </div>

                                <?php
                                        }
                                    } else {
                                        echo "<h4>NO Record Found!</h4>";
                                    }
                                }


                                ?>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-info text-light" name="updateuser"><i class="fa-regular fa-floppy-disk"></i>
                                            Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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