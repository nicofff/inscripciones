<?php
//Start session
session_start();

//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
    header("location: login.html");
    exit();
}
?>

<html ng-app="inscApp">
    <head>
        <meta charset="UTF-8"> 
        <script src="../angular/angular.min.js"></script>
        <script src="../angular/angular-route.min.js"></script>
        <script src="../angular/angular-resource.js"></script>
        <script src="../angular/angular-sanitize.min.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/services.js"></script>
        <script src="js/ng-csv.js"></script>
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="css/styles.css"/>
    </head>
    <body>
        <div class="login">
            <span><?php echo $_SESSION['sess_username']; ?></span>
            <a href="logout.php">Logout</a>
        </div>
        <div class="content">
            <div ng-view></div>
        </div>
    </body>
</html>