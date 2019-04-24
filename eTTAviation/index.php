<?php 
    session_start();
    require_once 'Dao.php';
    $username = "";
    $password = "";
    $result ="";
    $status = "";
    $loggedin="";
    $invalidlog = "";    
    
    if (isset($_SESSION['loggedin']) 
    && $_SESSION['loggedin'] == true) {
        echo 'Welcome: ' .$_SESSION['username'].", is logged in";
        echo "<a href='logout.php'> CLICK TO LOGOUT</a>";
    } 
    else {
        $_SESSION['message'] = "Please log in.";
        $status = $_SESSION['message'];
        echo $status;
    }
    if (isset($_SESSION["status"])) {
        echo "<div id='status'>" .  $_SESSION['status'] . "</div>";
        unset($_SESSION["status"]);
    }
?>
<html>
<header>
    <title>Super Smash Base</title>
</header>

<head>
    <script src="js/tooltip.js"></script>

    <link rel="stylesheet" href="layout.css">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Condensed:400,400i" rel="stylesheet">
</head>

<div class="bannerimage">
    <div class="bannertext">
        <h1>Super Smash Base</h1>
    </div>
</div>

<div class="topnav">
    <a class="active" href="index.php">Home</a>
    <a href="matchmaker.php">Match Maker</a>
    <a href="guides.php">Guides</a>
    <a href="about.php">About</a>
</div>


<body>

    <div class="splashmessage">A place for all your smash needs</div>

    <div class="leftcontainer">
        <a href="https://imgur.com/gallery/9eiQtBL">Combo Guide</a>
    </div>

    <div class="leftcontainer">
        <a href="https://www.nintendo.com">Link to Nintendo</a>
    </div>

    <?php        
    if (isset($_SESSION["status"])) {
      echo "<div id='status'>" .  $_SESSION['status'] . "</div>";
        
      unset($_SESSION["status"]);
    }
     ?>

    <div id=containerborder>
        <form method='POST' action='handler.php'>

            <label for='username'><b>Username</b></label>
            <input type='text' id='username' placeholder='Enter Username' name='username' value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } ?>" required>

            <label for='password'><b>Password</b></label>
            <input type='password' id='password' placeholder='Enter Password' name='password' required>



            <button type='submit' name='submit' id='login' value='Login'>Login</button>


        </form>
    </div>

</body>

<div class="footer">
    <p>Made by Ryley Studer</p>
</div>

</html>
