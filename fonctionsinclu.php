<?php

function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo 'Debug demandé dans le fichier : ' . $trace['file'] . ' à la ligne ' . $trace['line'] . '.';
    if($mode === 1)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}


function internauteEstProprietaire()
{ 
    if(!isset($_SESSION["pseudo"])) return false;
    else return true;
}

function internauteEstAdmin()
{
    
    if(internauteEstProprietaire() && $_SESSION["statut"] == 1) return true;
    else return false;
}
//------------------------------------
//--------- FONCTIONS DE SECURITE
function securiserChamp($champ) {
    return htmlspecialchars(trim($champ));
}

function hacherMotDePasse($motDePasse) {
    return password_hash($motDePasse, PASSWORD_DEFAULT);
}

?>