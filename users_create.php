<?php

require_once "db/config.php";
check_login();

if (isset($_POST['submituser'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];
    $password_confirmation = $_POST['password_confirmation'];

    $errors = array();
           
    if (empty($name) or empty($email) or empty($password) or empty($user_role)) {
     array_push($errors,"All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     array_push($errors, "Email is not valid");
    }
    if ($password != $password_confirmation) {
        array_push($errors,"Password must be the same");
    }
       
   
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
     array_push($errors,"Email already exists!");
    }
    if (count($errors)>0) {
     foreach ($errors as  $error) {
         echo "<div class='alert alert-danger'>$error</div>";
     }
    }else{
     
     $sql = "INSERT INTO users (name, email, password, user_role) VALUES (?, ?, ?, ?)";
     $stmt = mysqli_stmt_init($conn);
     $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
     if ($prepareStmt) {
         mysqli_stmt_bind_param($stmt,"ssss",$name, $email, $password, $user_role);
         mysqli_stmt_execute($stmt);
         header("Location: users.php");
         // echo "<div class='alert alert-success'>You are registered successfully.</div>";
     }else{
         die("Something went wrong");
     }
    }
   

 }




//     if (empty($name) or empty($email) or empty($password) or empty($user_role)) {
//         $_SESSION['status'] = "All fields are required";
//         header("Location: users_create.php");
//     } else {
//         if ($password == $password_confirmation) {

//             $users_query = "INSERT INTO users (name, email, password, user_role) VALUES ('$name', '$email', '$password', '$user_role')";
//             $users_query_run = mysqli_query($conn, $users_query);

//             if ($users_query_run) {
//                 $_SESSION['status'] = "User Successfully";
//                 header("Location: users.php");
//             } else {
//                 $_SESSION['status'] = "User failed!";
//                 header("Location: users_create.php");
//             }
//         }
//     }
// }





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
                            <form method="POST" action="users_create.php">

                                <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control " name="name" value="" required autocomplete="name" autofocus>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email">

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="user_role" class="col-md-4 col-form-label text-md-end">User Role</label>
                                    <div class="col-md-6">
                                        <select class="form-select" name="user_role" id="user_role">
                                            <option value="">Select User Role</option>
                                            <option value="user">user</option>
                                            <option value="admin">admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="users.php" class="btn btn-danger" type="button"><i class="fa-solid fa-xmark"></i> Cancle</a>
                                            <button type="submit" class="btn btn-info text-light" name="submituser"><i class="fa-regular fa-floppy-disk"></i>
                                                Save</button>
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