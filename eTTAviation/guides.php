<?php 
ini_set("allow_url_fopen", 1);
session_start();
if (isset($_SESSION['loggedin']) 
    && $_SESSION['loggedin'] == true) {
        echo 'Welcome: ' .$_SESSION['username'].", is logged in";
        echo "<a href='logout.php'> CLICK TO LOGOUT</a>";
    }
else{
    header('Location: index.php');
}

?>
<html>
<header>
    <title>Super Smash Base</title>
</header>

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
    <a class="active" href="guides.php">Guides</a>
    <a href="about.php">About</a>
</div>


<body>

    <div class="splashmessage">Character Guides and Frame Data</div>

    <?php
        
        $characterlist = array('MARIO',
                                'DONKEY KONG', 	
                                'LINK',
                                'SAMUS', 
                                'DARK SAMUS',
                                'YOSHI',
                                'KIRBY',
                                'FOX',
                                'PIKACHU', 
                                'LUIGI',
                                'NESS',
                                'CAPTAIN FALCON',
                                'JIGGLYPUFF',
                                'PEACH',
                                'DAISY', 
                                'BOWSER', 
                                'ICE CLIMBERS',
                                'SHIEK',
                                'ZELDA',
                                'DR. MARIO', 
                                'PICHU',
                                'FALCO',
                                'MARTH',
                                'LUCINA',
                                'YOUNG LINK', 
                                'GANONDORF',
                                'MEWTWO',
                                'ROY',
                                'CHROM', 
                                'MR. GAME & WATCH',
                                'META KNIGHT',
                                'PIT',
                                'DARK PIT',
                                'ZERO SUIT SAMUS',
                                'WARIO',
                                'SNAKE',
                                'IKE',
                                'POKEMON TRAINER',
                                'DIDDY KONG',
                                'LUCAS',
                                'SONIC',
                                'KING DEDEDE',
                                'OLIMAR',
                                'LUCARIO',
                                'R.O.B.',
                                'TOON LINK', 
                                'WOLF',
                                'VILLAGER', 
                                'MEGA MAN',
                                'WII FIT TRAINER',
                                'ROSALINA & LUMA',
                                'LITTLE MAC',
                                'GRENINJA',
                                'MII FIGHTER', 
                                'PALUTENA',
                                'PAC-MAN',
                                'ROBIN',
                                'SHULK',
                                'BOWSER JR.',
                                'DUCK HUNT',
                                'RYU',
                                'KEN',
                                'CLOUD', 
                                'CORRIN', 
                                'BAYONETTA',
                                'INKLING',
                                'RIDLEY',
                                'SIMON',
                                'RICHTER', 
                                'KING K. ROOL',
                                'ISABELLE',
                                'INCINEROAR', 
                                'PIRANHA PLANT', 
                                'JOKER',
                                '');
        
if(in_array(strtoupper($_SESSION['character']),$characterlist)){
    $character_url = 'http://beta-api-kuroganehammer.azurewebsites.net/api/characters/name/' . urlencode($_SESSION['character']);
    
    $character_moves = 'http://beta-api-kuroganehammer.azurewebsites.net/api/characters/name/' . urlencode($_SESSION['character']).'/moves';
    
    $json = file_get_contents($character_moves);    
    $i=0;
    $move_set=array();
    $frame_set=array();
    $currentmove='';
    $currentmove_frame='';
    $supername="";
    
    $move_json = json_decode($json);
    $characterName = $move_json[0]->Owner;
    foreach($move_json as $data){
        //find the special moves
        if($move_json[$i]->MoveType == "special"){
       
            //find the first move name of each move
            $currentmove = explode(' ',trim($move_json[$i]->Name))[0]." ".explode(' ',trim($move_json[$i]->Name))[1];

            $currentmove_frame = explode(' ',trim($move_json[$i]->FirstActionableFrame))[0];

            //if the current move name is equal to the next move name
            if(explode(' ',trim($move_json[$i]->Name))[0] = $supername){
                $supername = explode(' ',trim($move_json[$i]->Name))[0];
                $i++;
                array_push($frame_set,$currentmove_frame);
                continue;
            }
            //only grab one of each move
            else{
                array_push($move_set,preg_replace("/[^[:alnum:][:space:]]/u", '', $currentmove));
                array_push($frame_set,$currentmove_frame);
            }

                    
        }
        $i++;
    }

    $n=0;

    $output=array();
    $output_frame=array();
    $next_move="";

    $special="";
    $sidespecial="";
    $upspecial="";
    $downspecial="";

    $special_frame="-";
    $sidespecial_frame="-";
    $upspecial_frame="-";
    $downspecial_frame="-";

    $special = $move_set[0];
    $special_frame = $frame_set[0];

    foreach($move_set as $move){
        $next_move = explode(' ',trim(next($move_set)))[0];
        if(explode(' ',trim($move))[0] == $next_move){
            $frame = $frame_set[$n];
            $n++;
            continue;
        }
        else{   
            if(!in_array(explode(' ',trim($move))[0],$output)){
                array_push($output, $move);  
                array_push($output_frame,$frame);

            }         
        }                    
        $n++;
    }
        
        $sidespecial = $output[1];
        $sidespecial_frame = $output_frame[1];
        $upspecial = $output[2];
        $upspecial_frame = $output_frame[2];
        $downspecial = $output[3];
        $downspecial_frame = $output_frame[3];

      
            }
        else{
            $_SESSION['character'] = "";
            echo "<script>
                    alert('This character does not exist, try again');
                    
                </script>";
        }
        ?>

    <form action="api_handler.php" method="post">
        <input type="text" title='<?php echo "List of valid Fighters:<br>".$characterlist; ?>' input name="character" rel='tooltip' value="<?php if(isset($_SESSION['character'])) { echo $_SESSION['character']; } ?>" placeholder="search a character" />
        <button type="submit">Search</button>
    </form>

    <table class="center">
        <th>Fighter</th>
        <th>Special Move Controls</th>
        <th>Special Type</th>
        <th>Special Move Name</th>
        <th>Frames</th>
        <tr>

            <?php 
                $characterurl = 'http://kuroganehammer.com/images/ultimate/character/'.$characterName.'.png'; 
              ?>

            <?php echo "<td class = 'fightercol'>".$characterName."<img class = 'fighterimg' src='". $characterurl. "'/></td>";?>



            <td class=buttonpos><img class="buttonimg" src="https://www.ssbwiki.com/images/9/9f/ButtonIcon-GCN-B.png" /></td>
            <td>Neutral Special</td>
            <td><?php echo $special ?></td>
            <td><?php echo $special_frame." frames"?></td>
        </tr>
        <tr>
            <td class="fightercol"></td>
            <td class="buttonpos"><img class="buttonimg" src="https://www.ssbwiki.com/images/9/9f/ButtonIcon-GCN-B.png" /><img class="buttonimg" src="https://www.ssbwiki.com/images/6/65/ButtonIcon-GCN-Control_Stick-R.png" /></td>
            <td>Side Special</td>
            <td><?php echo $sidespecial ?></td>
            <td><?php echo $sidespecial_frame." frames"?></td>
        </tr>
        <tr>
            <td class="fightercol"></td>
            <td class="buttonpos"><img class="buttonimg" src="https://www.ssbwiki.com/images/9/9f/ButtonIcon-GCN-B.png" /><img class="buttonimg" src="https://www.ssbwiki.com/images/e/e0/ButtonIcon-GCN-Control_Stick-U.png" /></td>
            <td>Up Special</td>
            <td><?php echo $upspecial ?></td>
            <td><?php echo $upspecial_frame." frames"?></td>
        </tr>
        <tr>
            <td class="lastcol"></td>
            <td class="buttonpos"><img class="buttonimg" src="https://www.ssbwiki.com/images/9/9f/ButtonIcon-GCN-B.png" /><img class="buttonimg" src="https://www.ssbwiki.com/images/0/0a/ButtonIcon-GCN-Control_Stick-D.png" /></td>
            <td>Down Special</td>
            <td><?php echo $downspecial ?></td>
            <td><?php echo $downspecial_frame." frames"?></td>
        </tr>

    </table>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript">
        $(function($) {
            $('body').tooltip({
                selector: '[rel=tooltip]'
            });
        });

    </script>

</body>

<div class="footer">
    <p>Made by Ryley Studer</p>
</div>

</html>
