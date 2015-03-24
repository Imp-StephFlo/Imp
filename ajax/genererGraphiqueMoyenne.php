<?php
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
includeAllRequiredFiles();
getConnection();
//Récupération des variables
$code       = substr($_REQUEST['code'],6);
$periode    = $_REQUEST['periode'];
//Création de 2 variables qui contiendra les résultats de la requete 
$periodeT = array();
$moyenne = array();
//Fonction pour récupérer le résultat moyen selon la periode voulu
$resultMoyenne=statMoyen($periode);
//Rangement des résultats dans les tableaux
$i=0;
while ($row = mysql_fetch_array($resultMoyenne, MYSQL_NUM)) 
{
    $periodeT[$i] = $row[0];
    $moyenne[$i] = floor($row[1]/44);
    $i++;
}//fin while
// /!\ Le nom du graphique sera le code de l'utilisateur /!\
//Appel de la fonction pour créer le graphique

//===> graphiqueCourbe($periodeT, $moyenne, 'Periode', 'Moyenne', 'NomDuGraphique');
graphiqueCourbe($periodeT,$moyenne,'Periode','Moyenne',$code.$periode);
//Retourne le code de l'utilisateur, qui est également le nom du graphique (le fichier image)
//echo '<img src="./images/'.$code.'.png" id="graphique" name="graphique" width="462" height="200" alt="" contenteditable="false" />'

echo '<img src="./images/'.$code.$periode.'.png" id="graphique" name="graphique" width="462" height="200" alt="" contenteditable="false" />';