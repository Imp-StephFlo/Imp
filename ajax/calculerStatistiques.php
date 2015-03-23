<?php
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
getConnection();    //On établi la connexion à la bdd
//Récupération des variables POST
$code       = $_REQUEST['code'];
$periode    = $_REQUEST['periode'];

//recherche de la somme d'impression selon la période choisi ainsi que la date du jour
$total      = nbImpressions($_REQUEST['code'],$periode);

switch($periode)
{
    case 'mois':    //par mois
        $min = 100000;
        break;
    case 'annee':   //par an
        $min = 1000000;
        break;
    default:        //par jour
        $min = 10000;
        break;
}//fin switch
    
//On recherche son nombre maximun d'impression et a quel mois 
//Création de 2 variables qui contiendra les résultats de la requete 
$periodeT = array();
$somme = array();

//Fonction pour récupérer le résultat moyen selon la periode voulu
$resultSomme=StatPerso($_REQUEST['code'],$periode);

//Rangement des résultats dans les tableaux
$i=0;
$max=0;

while ($row = mysql_fetch_array($resultSomme, MYSQL_NUM)) 
{
    $periodeT[$i] = $row[0];
    $somme[$i] = floor($row[1]);
    if($somme[$i]>$max)
    {
        $max=$somme[$i];
        $dateMax=$periodeT[$i];
    } 
    if($somme[$i]<$min)
    {
        $min=$somme[$i];
        $dateMin=$periodeT[$i];
    }
    $i++;
}//fin while ($row = mysql_fetch_array($resultSomme, MYSQL_NUM))

//Calcul des coûts 
    //cout en euros
    //En noir recto/Verso
$cout=($max/10)*0.15;
$coutMax=number_format($cout,2);
    //cout en arbres
$ArbMax=$max/15000;//15 000 feuilles donne 1 arbres
$coutArbMax=number_format($ArbMax,2);
    //cout en euros
    //En noir recto/Verso
$coutMin=($min/10)*0.15;
$coutMini=number_format($coutMin,2);
//cout en arbres
$ArbMin=$min/15000;//15 000 feuilles donne 1 arbres
$coutArbMin=number_format($ArbMin,2);
    
//On défini deux phrases, qui varient en fonction de la période, dans des variables pour pouvoir les afficher par la suite
switch($periode)
{
    case 'mois':    //par mois
        $phraseVariable = "au mois de ";
        break;
    case 'annee':   //par an
        $phraseVariable = "dans l'ann&eacute;e ";
        break;
    default:        //par jour
        $phraseVariable = "le ";
        break;
}//fin switch

//On retourne le bloc de texte pour pouvoir l'afficher grâce à monjs.js
echo '
                            <p>
                                Maximum : '.$max.' pages imprim&eacute;es, '.$phraseVariable.$dateMax.'.<br />
                                <span class="marge">Co&ucirc;tent: '.$coutMax.' euros.</span><br />
                                <span class="marge">Abat: '.$coutArbMax.' arbres.</span><br /><br />
                                Minimum : '.$min.' pages imprim&eacute;es, '.$phraseVariable.$dateMin.'.<br />
                                <span class="marge">Co&ucirc;tent: '.$coutMini.' euros.</span><br />
                                <span class="marge">Abat: '.$coutArbMin.' arbres.</span><br /><br /><br />
                            </p>';
?>