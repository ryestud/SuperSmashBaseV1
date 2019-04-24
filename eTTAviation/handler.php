<?php
    $user ="";
    $pass ="";
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();
    $dbret = $dao->getUser();

    foreach($dbret as $eachuser){
        $user = $eachuser['username'];
        $pass = password_hash($eachuser['password'],PASSWORD_DEFAULT);
    }

$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);

if($username == $user && password_verify($password,$pass)){
    $status = "Thanks for logging in!";
    $_SESSION["status"] = $status;
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["loggedin"] = true;
    header("location:matchmaker.php");
}
else {
    $status = "Invalid Username/Password";
    $_SESSION["status"] = $status;
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["loggedin"] = false;
    header("location:index.php");
    exit();
}
