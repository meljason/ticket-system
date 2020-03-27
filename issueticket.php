<?php
session_start();

$errors = array();
if(isset($_POST['issueticket'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userEmail = $_SESSION['email'];

    $date = date("j");
    $day = date("D");
    $month = date("F");
    $year = date("Y");
    $time = date("H:i A");

    // var_dump($title);
    // var_dump($description);

    if ($title == '') {
        $errors[] = "The title cannot be empty";
    }
    if ($description == '') {
        $errors[] = "The desciption cannot be empty";
    }

    if (count($errors) == 0) {
        // echo ("HELLO THERE");

        $file = 'tickets/tickets.xml';
        $xmlobj = simplexml_load_file($file);

        // var_dump($xmlobj);

        $tickets = $xmlobj->addChild('ticket');
        
        $tickets->addAttribute('status', 'requested');
        $tickets->addChild('userEmail', $userEmail);
        $tickets->addChild('title', $title);
        $datetime = $tickets->addChild('datetime');
        $datetime->addChild('date', $date);
        $datetime->addChild('day', $day);
        $datetime->addChild('month', $month);
        $datetime->addChild('year', $year);
        $datetime->addChild('time', $time);
        $tickets->addChild('supportMessage', $description);
        $xmlobj->asXML('tickets/tickets.xml');
        header('Location: issueticket.php');
        die;

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

    <title>Home</title>
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
                                        echo '<a href="login.php" class="text-dark text-decoration-none"><i class="fas fa-sign-in-alt text-dark"></i> Sign In</a>';
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
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter ticket title">
                            </div>
                            <div class="form-group">
                                <label for="message">Description</label>
                                <textarea type="text" name="description" class="form-control" id="message" placeholder="Enter ticket description"></textarea>
                            </div>

                            <button type="submit" name="issueticket" class="btn btn-dark">Submit</button>
                        </form>
                        <?php

                        if (isset($_SESSION['email'])) {
                            // echo "IT WORKS BOIZ";
                            if (isset($_POST['issueticket'])) {
                                
                                if (count($errors) > 0) {
                                    echo '<div class="alert alert-danger mt-3" role="alert">';
                                    echo '<ul>';
                                    foreach ($errors as $e) {
                                        echo '<li>'. $e .'</li>';
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="alert alert-success mt-3" role="alert">Your ticket has been issued, go to your My Tickets to see your tickets</div>';
                                }
     
                            }
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">Please log in to be able to submit a ticket</div>';
                        }
                        ?>
                    </div>

                </div>

            </div>
</body>

</html>