<?php 
$username="";
session_start();
$username="";

if (isset($_SESSION['loggedin']) 
    && $_SESSION['loggedin'] == true) 
    {
        $username=$_SESSION['username'];
        echo 'Welcome: ' .$_SESSION['username'].", is logged in";
        echo "<a href='logout.php'> CLICK TO LOGOUT</a>";
    }
else{
    header('Location: index.php');
}

?>
<html>
	<header><title>Super Smash Base</title></header>
    <head>
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
      <a href="index.php">Home</a>
      <a href="matchmaker.php">Match Maker</a>
      <a href="guides.php">Guides</a>
      <a class="active" href="about.php">About</a>
    </div>
   
    
  
    
    
    <body>
        
        <div class="splashmessage">About Page</div>
        <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo "Thanks for logging in, " . $username . "!";
                echo "<div class = aboutbody>
            <center>
                <p>Welcome to SmashBase!</p>
                <p>This is an ever-growing source of fighter move-data, as well as the ability to match up with challengers using your actual preferences (rather than getting matched with a game mode that you don't like to play). </p>
                <p>The move data is backed by an API that will update on the fly as new patches are released.</p>
                <p>Don't forget to <a href = 'index.php'>Log In</a> so you can set your preferences in the Matchmaker tab.</p>
                
            </center>
        </div>";
            } 
            else {
                echo "Please log in first to see this page.";
            }
        ?>
        
        
        
        
    </body>
    
    
    <div class="footer">
        <p>Made by Ryley Studer</p>
    </div>
    
    
</html>