<?php
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
includeAllRequiredFiles();
getConnection();
//Récupération des variables
$code           = substr($_REQUEST['code'],6);
$comparaison    = $_REQUEST['comparaison'];
$periode        = $_REQUEST['periode'];
//Création de 2 variables qui contiendra les résultats de la requete 
$periodeT = array();
$somme = array();
//Fonction pour récupérer le résultat moyen selon la periode voulu
$resultSomme=statPerso($code,$periode);
//Rangement des résultats dans les tableaux
$i=0;
while ($row = mysql_fetch_array($resultSomme, MYSQL_NUM)) 
{
    $periodeT[$i] = $row[0];
    $somme[$i] = floor($row[1]);
    $i++;
}//fin while
//Construction du graphique en fonction de l'élément de comparaison
switch ($comparaison)
{
    case "moyenne":
        //Creation d'un tableau qui contiendra les donnée qui serviront de comparaison avec la courbe des stat perso
        $courbe = array();

        //Fonction pour récupérer le résultat moyen selon la periode voulu
        $resultMoyenne = statMoyen($periode);
        //Rangement des résultats dans les tableaux
        $i = 0;
        while ($row = mysql_fetch_array($resultMoyenne, MYSQL_NUM)) 
        {
            $courbe[$i] = floor($row[1]/44);
            $i++;
        }//fin while
        //Appel de la fonction pour créer le graphique
        $lienImage = graphiqueCourbes($periodeT,$somme,$courbe,"Periode","Mes impressons","moyenne",$code.$periode.$comparaison);
        break;
    case "service":
        //Creation d'un tableau qui contiendra les donnée qui serviront de comparaison avec la courbe des stat perso
        $courbe = array();
        
        $codeAutre = codeAlea($code);
        
        //Recherche d'un code user du meme service dans la base trouver aléatoriement par une fonction
        //Fonction pour récupérer le résultat somme d'un agent
        $resultSommeAutre = StatPerso($codeAutre, $periode);
                    
        //Rangement des résultats dans les tableaux
        $i = 0;
        while ($row = mysql_fetch_array($resultSommeAutre, MYSQL_NUM)) 
        {
            $courbe[$i] = floor($row[1]);
            $i++;
        }
        //on créer le graphique 
        $lienImage = graphiqueCourbes($periodeT, $somme, $courbe, "Période","Mes Impressions", "un agent", $code.$periode.$comparaison.$codeAutre);
        break;
    default:
        //Appel de la fonction pour créer le graphique
        $lienImage = graphiqueCourbe($periodeT,$somme,'Periode','Mes impressions',$code.$periode.$comparaison);
        break;
}//fin switch
echo '<img src="'.$lienImage.'" width="462" height="200" alt="" contenteditable="false" />';