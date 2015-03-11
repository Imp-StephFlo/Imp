<?php
error_reporting();
require_once("./util/fonctions.php");
include ("./vues/entete.php");
$actionsPossibles = array("accueil", "moyenne" , "perso" , "stat" , "rechercher");

if(!isset($_REQUEST['action']) xor !(in_array($_REQUEST['action'], $actionsPossibles)) xor (verifCode($_REQUEST['code'])[0] == ""))
    $action = "accueil";
else
    $action = $_REQUEST['action'];

switch($action)
{
    case "accueil" :
        include "./vues/accueil.php";
        break;
    case "moyenne" :
        include "./vues/moyenne.php";
        break;
    case "perso" :
        include "./vues/perso.php";
        break;
    case "stat" :
        include "./vues/stat.php";
        break;
    case "rechercher" :
        include "./vues/recherche.php";
        break;
    default :
        include "./vues/accueil.php";
        break;
}//fin switch
include ("./vues/pied.php");
?>