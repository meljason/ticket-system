<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My tickets</title>
</head>
<body>
    <h1>My Tickets</h1>
    <h2>Hey <?php echo $_SESSION['email']?>, this is your tickets</h2>
    <table>
        <tr>
            <th>Ticket Title</th>
            <th>Message</th>
            <th>Status</th>
        </tr>

        <?php
            $tickets = simplexml_load_file('tickets/tickets.xml');

            foreach ($tickets->ticket as $ticket) {
                if (isset($_SESSION['email'])) {
                    echo '<tr><td>'.$ticket->title.'</td><td>'.$ticket->supportMessage.'</td><td>'.$ticket->attributes()->status.'</td></tr>';                 
                }
            }
        ?>

    </table>
        <hr/>
        <a href="index.php">Home</a>

        <?php
        if (isset($_SESSION['email'])) {
            echo '<a href="logout.php">Log Out</a>';
        } else {
            echo '<a href="login.php">Login</a>';
        }
        ?>
</body>
</html>