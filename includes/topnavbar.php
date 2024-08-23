<nav class="navbar navbar-expand-md shadow-sm">
    <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);  ?>
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assent/dist/img/logo.png" alt="" width="120" height="80" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->


            <!-- Right Side Of Navbar -->
            <!-- Authentication Links -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link nav-text <?= $page == 'home.php' ? 'active' : ''  ?>" aria-current="page" href="home.php"><i class="fa-solid fa-house"></i>
                        Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-text <?= $page == 'receipts.php' ? 'active' : ''  ?>" aria-current="page" href="receipts.php"><i class="fa-solid fa-file-invoice"></i>
                        Receipts</a>
                </li>
                <?php
                if ($_SESSION['user_role'] == 'admin') {
                ?>
                    <li class="nav-item ">
                        <a class="nav-link nav-text <?= $page == 'users.php' ? 'active' : ''  ?>" aria-current="page" href="users.php"><i class="fa-solid fa-users"></i>
                            Users</a>
                    </li>
                <?php
                }
                ?>

                <li class="nav-item ">
                    <a class="nav-link nav-text <?= $page == 'reports.php' ? 'active' : '' ?>" aria-current="page" href="reports.php"><i class="fa-solid fa-database"></i>
                        Reports</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link nav-text <?= $page == 'setting.php' ? 'active' : ''  ?>" aria-current="page" href="#"><i class="fa-solid fa-gear"></i>
                        Setting</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-sm btn-light text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php  
                         $user = $_SESSION['user'];
                         $user_id = $_SESSION['user']['id'];
                         $user_name = $_SESSION['user']['name'];
                        ?>
                        <?php echo $user['name'] ?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="logout.php" method="POST" class="d-none">
                            <input type="hidden" name="_token" value="3f0DsFdDJj9sPO32Xws8kCljr1VkCNqiCKOqBR8W">
                        </form>

                        <!-- <a class="dropdown-item" href="change_password.php">
                                        Reset Password
                                    </a> -->
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>