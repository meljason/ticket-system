<?php
session_start();


//reference: https://stackoverflow.com/questions/3538513/detect-if-php-session-exists
if (session_status() != PHP_SESSION_ACTIVE) {
    header('Location: ../login.php');
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

    <script src="js/script.js"></script>

    <script src="https://kit.fontawesome.com/c7c508e324.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Home</title>
</head>

<body>
    <div id="wrapper" class="active">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul id="sidebar_menu" class="sidebar-nav">
                <li class="sidebar-brand">
                    <a id="menu-toggle" href="../admin/adminindex.php">Ticketer</a>
                </li>
            </ul>
            <ul class="sidebar-nav" id="sidebar">
                <li><a href="../admin/admintickets.php">Total tickets</a></li>
                <li><a href="../admin/requestedticket.php">Requested tickets</a></li>
                <li><a href="../admin/adminongoing.php">On-going tickets</a></li>
                <li><a href="../admin/adminresolved.php">Resolved tickets</a></li>
            </ul>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">
            <div class="page-content inset">
                <div class="nav-top">
                    <div class="row">
                        <nav class="navbar navbar-expand navbar-light bg-white mb-4 static-top shadow justify-content-between" style="width: 100%; height: 4em;">
                            <div class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome
                                <?php 
                                if (isset($_SESSION['email'])) {
                                    echo ", " . $_SESSION['email']; 
                                }
                                
                                ?> (Admin User)
                            </div>
                            <div class="sign">
                                <?php
                                    if(isset($_SESSION['email'])) {
                                        echo '<a href="../logout.php" class="text-dark text-decoration-none"><i class="fas fa-sign-out-alt text-dark"></i> Sign Out</a>';
                                    } else {
                                        echo '<a href="../login.php" class="text-dark text-decoration-none"><i class="fas fa-sign-in-alt text-dark"></i> Sign In</a>';
                                        echo ' | ';
                                        echo '<a href="../register.php" class="text-dark text-decoration-none"> Register</a>';
                                    }
                                ?>      
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="dash-title d-sm-flex justify-content-between">
                        <div class="dashboard-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Tickets</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                            $xml = simplexml_load_file("../tickets/tickets.xml");
                                            $count_ticket = $xml->ticket->count();
                                            echo $count_ticket;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">On-going Tickets</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                            $xml = simplexml_load_file("../tickets/tickets.xml");
                                            $status = 'requested';
                                            $count = 0;

                                            foreach ($xml->ticket as $ticket) {
                                                $tmp = $ticket->attributes();
                                                if($tmp['status'] == $status) {
                                                    $count += 1;
                                                }
                                            }    
                                            echo $count;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Resolved tickets</div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?php
                                                $xml = simplexml_load_file("../tickets/tickets.xml");
                                                $status = 'resolved';
                                                $count = 0;

                                                foreach ($xml->ticket as $ticket) {
                                                    $tmp = $ticket->attributes();
                                                    if($tmp['status'] == $status) {
                                                        $count += 1;
                                                    }
                                                }    

                                                echo $count;
                                            
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>