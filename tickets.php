<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My tickets</title>
</head>
<body>
    <h1>My Tickets</h1>
    <table>
        <tr>
            <th>Ticket Title</th>
            <th>Message</th>
            <th>Status</th>
        </tr>

        <?php

            $tickets = simplexml_load_file('tickets/tickets.xml');

            foreach ($tickets->ticket as $ticket) {
                echo '<tr><td>'..'</td><td>'..'</td><td>'..'</td></tr>';
            }
        ?>
    </table>
</body>
</html>