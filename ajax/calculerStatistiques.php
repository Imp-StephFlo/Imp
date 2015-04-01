<?php
//Scripts à inclure
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
getConnection();    //On établi la connexion à la bdd
//
//Récupération des variables POST
$strCode       = $_REQUEST['code'];         //Code de l'agent
$strPeriode    = $_REQUEST['periode'];      //periode selectionné par l'agent

//recherche de la somme d'impression selon la période choisi ainsi que la date du jour
$total      = statPerso($_REQUEST['code'],$strPeriode);

//Selon la période
switch($strPeriode)
{
    case 'mois':    //par mois
        $intMin = 100000;
        break;
    case 'annee':   //par an
        $intMin = 1000000;
        break;
    default:        //par jour
        $intMin = 10000;
        break;
}//fin switch
    
//On recherche son nombre maximun d'impression et a quel mois 
//Création de 2 variables qui contiendra les résultats de la requete 
$arrPeriodeT = array();
$arrSomme = array();

//Fonction pour récupérer le résultat moyen selon la periode voulu
$resultat=statPerso($_REQUEST['code'],$strPeriode);

//Rangement des résultats dans les tableaux
$i=0;
$intMax=0;

while ($row = mysql_fetch_array($resultat, MYSQL_NUM)) 
{
    $arrPeriodeT[$i] = $row[0];
    $arrSomme[$i] = floor($row[1]);
    if($arrSomme[$i]>$intMax)
    {
        $intMax=$arrSomme[$i];
        $dateMax=$arrPeriodeT[$i];
    } 
    if($arrSomme[$i]<$intMin)
    {
        $intMin=$arrSomme[$i];
        $dateMin=$arrPeriodeT[$i];
    }
    $i++;
}//fin while ($row = mysql_fetch_array($resultSomme, MYSQL_NUM))

//Calcul des coûts 
    //cout en euros
    //En noir recto/Verso
$decCout=($intMax/10)*0.15;
$decCoutMax=number_format($decCout,2);
    //cout en arbres
$decArbMax=$intMax/15000;//15 000 feuilles donne 1 arbres
$decCoutArbMax=number_format($decArbMax,2);
    //cout en euros
    //En noir recto/Verso
$decCoutMin=($intMin/10)*0.15;
$decCoutMini=number_format($decCoutMin,2);
//cout en arbres
$decArbMin=$intMin/15000;//15 000 feuilles donne 1 arbres
$decCoutArbMin=number_format($decArbMin,2);
    
//On défini deux phrases, qui varient en fonction de la période, dans des variables pour pouvoir les afficher par la suite
switch($strPeriode)
{
    case 'mois':    //par mois
        $strPhraseVariable = "au mois de ";
        break;
    case 'annee':   //par an
        $strPhraseVariable = "dans l'ann&eacute;e ";
        break;
    default:        //par jour
        $strPhraseVariable = "le ";
        break;
}//fin switch

//On retourne le bloc de texte pour pouvoir l'afficher grâce à monjs.js
echo '
                            <p>
                                Maximum : '.$intMax.' pages imprim&eacute;es, '.$strPhraseVariable.$dateMax.'.<br />
                                <span class="marge">Co&ucirc;tent: '.$decCoutMax.' euros.</span><br />
                                <span class="marge">Abat: '.$decCoutArbMax.' arbres.</span><br /><br />
                                Minimum : '.$intMin.' pages imprim&eacute;es, '.$strPhraseVariable.$dateMin.'.<br />
                                <span class="marge">Co&ucirc;tent: '.$decCoutMini.' euros.</span><br />
                                <span class="marge">Abat: '.$decCoutArbMin.' arbres.</span><br /><br /><br />
                            </p>';
?>