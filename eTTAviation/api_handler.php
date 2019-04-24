<?php
    session_start();
    require_once 'Dao.php';
    $character = "";
    $con = "";
    $dao = new Dao();

    if(isset($_POST['character'])){
        
        $character = htmlspecialchars($_POST['character']);

        $_SESSION['character'] = $character;
        
  
        header('Location: guides.php');
        exit; 
    }
    else{
        header('Location: guides.php');
        exit;
    }




?>