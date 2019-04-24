<?php

   
$host = "us-cdbr-iron-east-03.cleardb.net"; 
$db = "heroku_73148d31f031b06"; 
$user = "bcb55b6c6088fb";
$pass = "6cd8490d";
$tbl_name="users";    // Table name


//$link = mysqli_init();
//$success = mysqli_real_connect(
//    $link,
//    $host,
//    $user,
//    $pass,
//    $db,
//    $port 
//);


//$username=$mysqli->escape_string($_POST['username']);
//$result = $mysqli->query("SELECT users WHERE username='$username'");
////user doesnt exist
//if($result->num_rows == 0){
//    $_SESSION['message'] = "That name does't exist.";
//    header("location:index.php");
//}
//else{
//    $user = $result->fetch_assoc();
//    if(password_verify($_POST['password'],$username['password'])){
//        
//    }
//}

//Connect to server and select DB
$mysqlidb = mysqli_connect($host,$user,$pass,$db);
if (mysqli_connect_errno()) {
     die(mysqli_connect_error());
    exit();
}

$loginquery = "SELECT username, password FROM users";

//$mysqlidb = new mysqli($host,$user,$pass,$db);
//if ($mysqlidb->connect_errno){
//    die($mysqlidb->connect_error);
//}


//username and password sent from form
$userform=$_POST['username'];
$passform=$_POST['password'];

//Protect against injection
$userform = stripslashes($userform);

$passform = stripslashes($passform);


//$sql="SELECT * FROM $tbl_name WHERE username='$userform' and password='$passform'";
$sqli = mysqli_query($mysqlidb, "SELECT * FROM users WHERE username = '$userform' and password = '$passform'");

$result=mysqli_num_rows($sqli);

echo $loginquery;

if ($result = mysqli_query($mysqlidb, $loginquery)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {
        printf ("-> %s : %s\n", $row[0], $row[1]);
    }

    /* free result set */
//    mysqli_free_result($result);
}

echo $row[1];

 if(!empty($_POST['username']) && !empty($POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
    if($username == 'default' && $password == 'password'){
        $_SESSION['login_test'] = 'old';
        header("location:matchmaker.php");
    }
    else {
        echo "Username and password are invalid.";
    }



//if matched
//if(!$result ||mysqli_num_rows($result) == 0){

//if($result = $row[1]){
//    session_start();
//    $_SESSION['loggedin'] = true;
//    $_SESSION['username'] = $username;
//    header("Location: index.php");
//    echo "yes";
//}