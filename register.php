<?php

$errors = array();
if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    $xml = file_get_contents('users/users.xml');

    if (strpos($xml, "<email>$email</email>") !== false) {
        $errors[] = "Email already exists in the system";
    }
    if ($email == '') {
        $errors[] = "Email cannot be empty";
    }
    if ($password == '' || $c_password == '') {
        $errors[] = "Passwords cannot be empty";
    }
    if ($password != $c_password) {
        $errors[] = "Passwords do not match";
    }
    //add more conditions
    if (count($errors) == 0) {
        // echo ("HELLO FROM THIS SIDE");
        $file = 'users/users.xml';
        $xmlobj = simplexml_load_file($file);
        // var_dump($xmlobj);
        $users = $xmlobj->addChild('user');
        $users->addChild('email', $email);
        $users->addChild('password', md5($password));
        $xmlobj->asXML('users/users.xml');
        header('Location: login.php');
        die;
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
        <?php
            if (count($errors) > 0) {
                echo '<ul>';
                foreach ($errors as $e) {
                    echo '<li>'. $e .'</li>';
                }
                echo '</ul>';
            }
        ?>
        <p>email <input type="text" name="email" size="20"></p>
        <p>password <input type="password" name="password" size="20"></p>
        <p>confirm password <input type="password" name="c_password" size="20"></p>
        <p><input type="submit" value="Sign Up" name="signup"></p>
    </form>
</body>
</html>