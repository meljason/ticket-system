<?php
$error = false;
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    // echo "This is the password inputed " . $password;

    $xml = simplexml_load_file('users/users.xml');

    // var_dump($xml->user->$email);
 
    //login logic: check if user exist on the system then creates a session
    foreach ($xml->user as $user) {
        if ($user->email == $email && $user->password == $password) {
            // echo "works";
            session_start();
            $_SESSION['email'] = $email;
            header('Location: index.php');
            die;
        } else {
            $error = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/script.js"></script>

    <script src="https://kit.fontawesome.com/c7c508e324.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Login</title>
</head>

<body>
    <div id="wrapper" class="active">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul id="sidebar_menu" class="sidebar-nav">
                <li class="sidebar-brand"><a id="menu-toggle" href="index.php">Ticketer</a></li>
            </ul>
            <ul class="sidebar-nav" id="sidebar">
                <li><a href="tickets.php">My tickets</a></li>
                <li><a href="ongoingtickets.php">On-going tickets</a></li>
                <li><a href="resolvedtickets.php">Resolved tickets</a></li>
            </ul>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <!-- <div class="row">
                    <div class="col-md-12">
                        <p class="well lead">An Experiment using the sidebar template from startbootstrap.com which I integrated in my website (<a href="http://animeshmanglik.name">animeshmanglik.name</a>)</p>
                        <p class="well lead">Click on the Menu to Toggle Sidebar . Hope you enjoy it!</p>
                    </div>
                </div> -->
                <div class="nav-top">
                    <div class="row">
                        <nav class="navbar navbar-expand navbar-light bg-white mb-4 static-top shadow justify-content-between" style="width: 100%; height: 4em;">
                        <div class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome
                                <?php 
                                if (isset($_SESSION['email'])) {
                                    echo ", " . $_SESSION['email']; 
                                }
                                
                                ?>
                            </div>
                            <div class="sign">
                                <?php
                                    if(isset($_SESSION['email'])) {
                                        echo '<a href="logout.php" class="text-dark text-decoration-none"><i class="fas fa-sign-out-alt text-dark"></i> Sign Out</a>';
                                    } else {
                                        echo '<a href="register.php" class="text-dark text-decoration-none"> Register</a>';
                                    }
                                ?>
                                
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row issue-ticket-form">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                            </div>

                            <button type="submit" name="login" class="btn btn-dark">Submit</button>
                        </form>

                        <?php
                            if ($error == true) {
                                echo '<div class="alert alert-danger mt-3" role="alert">Email or Password is wrong</div>';
                            }
                        ?>
                    </div>

                </div>

            </div>
</body>

</html>