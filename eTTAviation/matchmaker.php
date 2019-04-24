<?php 
    session_start();
    if (isset($_SESSION['loggedin']) 
    && $_SESSION['loggedin'] == true) 
    {
        echo 'Welcome: ' .$_SESSION['username'].", is logged in";
        echo "<a href='logout.php'> CLICK TO LOGOUT</a>";
    } 
else{
    header('Location: index.php');
    
}

?>
<html>

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
    <a class="active" href="matchmaker.php">
        Match Maker
    </a>
    <a href="guides.php">Guides</a>
    <a href="about.php">About</a>
</div>

<body>
    <div class="splashmessage">Battle Match Maker System</div>

    <div>Update Preferences</div>
    <!--    <div class="mastertooltip">-->
    <form method="post" class=matchmaker action="matchhandler.php">
        <div>
            <p>Battle Style</p>
        </div>
        <div class=preffield><input type="radio" required name="style" id="style" value="4">Smash</div>
        <div class=preffield><input type="radio" required name="style" id="style" value="2">Team Battle</div>
        <div class=preffield><input type="radio" required name="style" id="style" value="0">1-on-1</div>
        <div>
            <p>Stock Count</p>
        </div>
        <div class=preffield><input type="radio" name="stock" id="stock" value="1" required>1-Stock</div>
        <div class=preffield><input type="radio" name="stock" id="stock" value="2" required>2-Stock</div>
        <div class=preffield><input type="radio" name="stock" id="stock" value="3" required>3-Stock</div>
        <input type="submit" name="submit" value="Submit">
    </form>
    <!--    </div>-->


    <?php
    require_once 'Dao.php';
    $dao = new Dao();
    $battlestyle = $dao->getPref();//make sure to select user





    foreach ($battlestyle as $battlepref) {
        $stylepref = $battlepref['style'];
        $stockpref = $battlepref['stock'];
}
        if($stylepref == 4){
            $stylepref = "Smash";
        }else if($stylepref == 2){
            $stylepref = "Team Battle";
        }else if($stylepref == 0){
            $stylepref = "1-on-1";
        }
        if($_SESSION['loggedin'] == true){
            echo "<div>Your Battle-Style/Stock-Count: $stylepref"." / "."$stockpref</div>";    
        }
        
?>


</body>
<div class="footer">
    <p>Made by Ryley Studer</p>
</div>

</html>
