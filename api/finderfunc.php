<?php

function uniFind($uni){
    switch($uni){
        case "Diablo": return 1;
        case "StarCraft": return 2;
        case "WarCraft": return 3;
        case "OverWatch": return 4;
        case 'Classic Game': return 5;
        default: return 'error';
    }
}
function roleFind($role){
    switch($role){
        case "assassin": return 1;
        case "warrior": return 2;
        case "support": return 3;
        case "specialist": return 4;
        default: return 'error';
    }
}

function singleQuery($singleQuery, $conn, $type){
    $singleResult = mysqli_query($conn, $singleQuery);

    if(mysqli_num_rows($singleResult) > 0){
        $output = mysqli_fetch_assoc($singleResult);
    }
    return $output[$type];
}