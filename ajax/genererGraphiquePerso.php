<?php
//Scripts à inclure
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
includeAllRequiredFiles();

getConnection();        //On établi la connexion à la bdd
//Récupération des variables
$strCode           = substr($_REQUEST['code'],6);
$strComparaison    = $_REQUEST['comparaison'];
$strPeriode           = $_REQUEST['periode'];

//Création de 2 variables qui contiendront les résultats de la requete 
$arrPeriodeT = array();
$arrSomme = array();
//Fonction pour récupérer le résultat moyen selon la periode voulu
$resultat=statPerso($strCode,$strPeriode);
//Rangement des résultats dans les tableaux
$i=0;
while ($row = mysql_fetch_array($resultat, MYSQL_NUM)) 
{
    $arrPeriodeT[$i] = $row[0];
    $arrSomme[$i] = floor($row[1]);
    $i++;
}//fin while
//Construction du graphique en fonction de l'élément de comparaison
switch ($strComparaison)
{
    case "moyenne":
        //Creation d'un tableau qui contiendra les donnée qui serviront de comparaison avec la courbe des stat perso
        $arrCourbe = array();

        //Fonction pour récupérer le résultat moyen selon la periode voulu
        $resultat = statMoyen($strPeriode);
        //Rangement des résultats dans les tableaux
        $i = 0;
        while ($row = mysql_fetch_array($resultat, MYSQL_NUM)) 
        {
            $arrCourbe[$i] = floor($row[1]/44);
            $i++;
        }//fin while
        //Appel de la fonction pour créer le graphique
        $strLienImage = graphiqueCourbes($arrPeriodeT,$arrSomme,$arrCourbe,"Periode","Mes impressons","moyenne",$strCode.$strPeriode.$strComparaison);
        break;
    case "service":
        //Creation d'un tableau qui contiendra les donnée qui serviront de comparaison avec la courbe des stat perso
        $arrCourbe = array();
        
        $strCodeAutre = codeAlea($strCode);
        
        //Recherche d'un code user du meme service dans la base trouver aléatoriement par une fonction
        //Fonction pour récupérer le résultat somme d'un agent
        $resultat = StatPerso($strCodeAutre, $strPeriode);
                    
        //Rangement des résultats dans les tableaux
        $i = 0;
        while ($row = mysql_fetch_array($resultat, MYSQL_NUM)) 
        {
            $arrCourbe[$i] = floor($row[1]);
            $i++;
        }
        //on créer le graphique 
        $strLienImage = graphiqueCourbes($arrPeriodeT, $arrSomme, $arrCourbe, "Période","Mes Impressions", "un agent", $strCode.$strPeriode.$strComparaison.$strCodeAutre);
        break;
    default:
        //Appel de la fonction pour créer le graphique
        $strLienImage = graphiqueCourbe($arrPeriodeT,$arrSomme,'Periode','Mes impressions',$strCode.$strPeriode.$strComparaison);
        break;
}//fin switch
echo '<img src="'.$strLienImage.'" width="462" height="200" alt="" contenteditable="false" />';