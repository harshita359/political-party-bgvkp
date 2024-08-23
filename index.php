<?php
require_once "db/config.php";


if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        if ($row['status'] == 1) {

            //$_SERVER['ROLE'] = $row['user_role'];
            $_SESSION['IS_LOGIN'] = 'yes';
            // if ($row['user_role'] == 'admin') {
            //     $_SESSION['user_role'] = "admin";
            //     header("Location: home.php");
            // }
            // if ($row['user_role'] == 'user') {
            //     $_SESSION['user_role'] = "user";
            //     header("Location: home.php");
            // }
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['user'] = $row;
            header("Location: home.php");

        }
    } else {
        $_SESSION['status'] = "Invalid Email Password!";
        header("Location: index.php");
    }
}
// foreach ($result as $row) {
//     $user_id = $row['id'];
//     $user_name = $row['name'];
//     $user_email = $row['email'];
//     $user_password = $row['password'];
// }

// $_SESSION['auth'] = true;
// $_SESSION['auth_user'] = [
//     'user_id' => $user_id,
//     'user_name' => $user_name,
//     'user_email' => $user_email,
//     'user_password' => $user_password

// ];


// $_SESSION['status'] = "Login Successfully";
// header("Location: home.php");



include('includes/header.php');
include('includes/nav.php');
?>

<div class="wrapper">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            <div class="row mb-4 justify-content-center">
                                <img src="img/login_header.jpeg" alt="">
                            </div>
                            <form method="POST" action="">
                                <input type="hidden" name="_token" value="qrYth7wlpLQ7JNp4F8AJhbBNAJwT1VZXP9upib0b">
                                <div class="row mb-3">

                                    <div class="col-md-6 mx-auto">
                                        <label for="email" class="control-label">Email ID</label>
                                        <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email" autofocus>

                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6 mx-auto">
                                        <label for="password" class="control-label">Password</label>
                                        <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">

                                    </div>
                                </div>

                                <!-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        >

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->

                                <div class="row mb-0">
                                    <div class="d-grid col-md-6 mx-auto">
                                        <button type="submit" class="btn btn-success text-light" name="login_btn">
                                            Login <i class="fa-solid fa-right-to-bracket"></i>
                                        </button>

                                        <!--  -->
                                        <?php
                                        // if (isset($_SESSION['status'])) {
                                        //     echo '<h4>' . $_SESSION['status'] . '</h4>';
                                        //     // unset($_SESSION['status']);
                                        // }
                                        // if (isset($_SESSION['user_role'])) {
                                        //     echo '<h4>' . $_SESSION['user_role'] . '</h4>';
                                        //     // unset($_SESSION['user_role']);
                                        // }
                                        ?>
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