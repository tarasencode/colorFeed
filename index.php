<?php

require_once('config.php');

if ($db -> connect_error) {
    die("DB connection failed: ".$db->connect_error);
}

$query = "SELECT Palettes.colors, Palettes.name, Authors.firstName, Authors.lastName
FROM Palettes
INNER JOIN Authors ON Palettes.authorId=Authors.authorId
LIMIT 5;";
$result = $db->query($query);

if($result->num_rows > 0) {
    $palettesArray = [];
    while ($row = $result->fetch_assoc()) {
        $row['colors'] = explode(",", $row['colors']);
        $palettesArray[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Color scheme feed</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="feed">
                <?php foreach($palettesArray as $palette): ?>
                <div class="palette">
                    <div class="colors">
                        <?php foreach($palette['colors'] as $color): ?>        
                        <div class="color" style="background-color: #<?=$color ?>"><div class="hex-value hide">#<?=strtoupper($color) ?></div></div>     
                        <?php endforeach; ?>   
                    </div>
                    <div class="palette-caption">
                        <b><?=$palette['name'] ?></b> <span>by: <?=$palette['firstName']. ' '.$palette['lastName'] ?></span>
                    </div>      
                </div>  
                <?php endforeach; ?>     
            </div>
    
        </div>
        <script src="script.js"></script>
    </body>
</html>