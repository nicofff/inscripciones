<?php

ob_start();
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

include "../model/dbConn.php"; # me da el obj $MYSQLI
$username = $MYSQLI->real_escape_string($username);
$query = "SELECT * from Usuarios where username = '" . $username . "'";

if ($result = $MYSQLI->query($query)) {
    $resObj = $result->fetch_object();
    $MYSQLI->close();
    if ($result->num_rows == 0) {
        header('Location: login.html');
        die();
    }
} else {
    die();
}


$hash = hash('sha256',  $password.$resObj->salt);
echo $password.$resObj->salt."<br/>";
echo $hash;
if ($hash != $resObj->password) { // Incorrect password. So, redirect to login_form again.
    header('Location: login.html');
} else { // Redirect to home page after successful login.
    session_regenerate_id();
    $_SESSION['sess_user_id'] = $resObj->id;
    $_SESSION['sess_username'] = $resObj->username;
    session_write_close();
    header('Location: admin.php');
}
