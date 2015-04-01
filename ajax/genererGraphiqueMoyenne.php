<?php
//Scripts à inclure
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
includeAllRequiredFiles();

getConnection();    //On établi la connexion à la bdd
//
//Récupération des variables
$strCode       = substr($_REQUEST['code'],6);       //Code de l'agent
$strPeriode    = $_REQUEST['periode'];              //periode selectionné par l'agent

//Création de 2 variables qui contiendront les résultats de la requête 
$arrPeriodeT = array();
$arrMoyenne = array();

//Fonction pour récupérer le résultat moyen selon la periode voulu
$resultat = statMoyen($strPeriode);

//Rangement des résultats dans les tableaux
$i=0;
while ($row = mysql_fetch_array($resultat, MYSQL_NUM)) 
{
    $arrPeriodeT[$i] = $row[0];
    $arrMoyenne[$i] = floor($row[1]/44);
    $i++;
}//fin while
// /!\ Le nom du graphique sera le code de l'utilisateur /!\
//Appel de la fonction pour créer le graphique

//===> graphiqueCourbe($periodeT, $moyenne, 'Periode', 'Moyenne', 'NomDuGraphique');
graphiqueCourbe($arrPeriodeT,$arrMoyenne,'Periode','Moyenne',$strCode.$strPeriode);
//Retourne le code de l'utilisateur, qui est également le nom du graphique (le fichier image)
//echo '<img src="./images/'.$code.'.png" id="graphique" name="graphique" width="462" height="200" alt="" contenteditable="false" />'

echo '<img src="./images/'.$strCode.$strPeriode.'.png" id="graphique" name="graphique" width="462" height="200" alt="" contenteditable="false" />';