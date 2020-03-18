<?php
session_start();


//reference: https://stackoverflow.com/questions/3538513/detect-if-php-session-exists
if (session_status() != PHP_SESSION_ACTIVE) {
    header('Location: login.php');
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>User Page</h1>
    <h2>Welcome, <?php echo $_SESSION['email']; ?></h2>
    <table>
        <tr>
            <th>Email</th>
        </tr>

        <?php
            $users = simplexml_load_file('users/users.xml');

            foreach ($users->user as $user) {
                echo '<tr><td>'.$user->email.'</td>'. '</tr>';
            }
        ?>
    </table>

    <hr />
    <a href="logout.php"> Log Out</a>
</body>
</html>