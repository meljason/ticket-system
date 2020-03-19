<?php
$error = false;
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    // echo "This is the password inputed " . $password;

    $xml = simplexml_load_file('users/users.xml');

    var_dump($xml->user->$email);
 
    //login logic: check if user exist on the system then creates a session
    foreach ($xml->user as $user) {
        if ($user->email == $email && $user->password == $password) {
            // echo "works";
            session_start();
            $_SESSION['email'] = $email;
            header('Location: index.php');
            die;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <p>Email <input type="text" name="email" size="20"></p>
        <p>Password <input type="password" name="password" size="20"></p>
        <?php
            if ($error) {
                echo '<p>Invalid email or password</p>';
            }
        ?>
        <p><button type="submit" value="Login" name="login">Login</button></p>
    </form>

    <a href="register.php">Register</a>
</body>
</html>