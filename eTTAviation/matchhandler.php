<?php
    session_start();
    require_once 'Dao.php';
    $style = "";
    $stock = "";
    $con = "";
    $dao = new Dao();

    if((isset($_POST['style']) || isset($_POST['stock']))){
        
        $style = htmlspecialchars($_POST['style']);
        $stock = htmlspecialchars($_POST['stock']);
        
        $dao->updateDB($style,$stock);
  
        header('Location: matchmaker.php');
        exit;

        
        

        
    }
    else{
        header('Location: matchmaker.php');
        exit;
    }




?>
