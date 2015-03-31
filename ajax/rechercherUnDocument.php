<?php
//Scripts à inclure
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
getConnection();    //On établi la connexion à la bdd
//
//On récupère la valeur du formulaire
$strRecherche     = $_REQUEST["titre"];
$intTypeDocument  = $_REQUEST["typeDocument"];

//On doit écrire au minimum 5 caractères 
$intCaracMin   = 5;

//On utilise une fonction pour rechercher les documents qui composent cette recherche avec leurs dates et le nombre de pages
$resultat   = rechercheDoc($strRecherche, $intTypeDocument);

//Création de 3 tableaux qui vont contenir le nom, la date et le nombre de pages des documents trouvés
$arrDate       = array();
$arrNom        = array();
$arrPages      = array();

//On définit le message d'erreur si le critère de recherche est inférieur à 5 caractères
if(strlen($strRecherche) < $intCaracMin)
{
    $strErreur = "Veuillez saisir au minimum 5 caract&eagrave;res.";
}//fin strlen

//On créer le tableau s'il n'y a pas d'erreur
if(!isset($strErreur))
{
    $strAffichage = '
                        <div class="divConteneur">
                            <table class="t1" summary="documents qui répondes à la recherche de l\'user">
                              <thead>
                                  <tr>
                                      <th>Nb Pages</th>
                                      <th>Titre document</th>
                                      <th>Dates Impressions</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th colspan="4"></th>
                                  </tr>
                              </tfoot>
                              <tbody>';
    //Rangement des résultats dans les tableaux
    $i = 0;
    while($row = mysql_fetch_array($resultat))
    {
        $arrPages[$i] = $row[2];
        $arrNom[$i] = $row[1];
        $arrDate[$i] = $row[0];
        $strAffichage .= "
                                            <tr>
                                                <th>".$arrPages[$i]."</th>
                                                <td>".$arrNom[$i]."</td>
                                                <td>".$arrDate[$i]."</td>
                                            </tr>";
        $i++;
    }//while

    if($i == 0)
    {
        $strAffichage .= "<tr><th colspan='4'>Aucun Document trouv&eacute;...</th></tr> ";
    }

    $strAffichage .= "
                              </tbody> 
                            </table>
                        </div>
                        <br /><div id='resultat'> R&eacute;sultat(s) trouv&eacute;(s): ".$i.".</div>";
}//fin if(!isset($erreur))
else
{
    $strAffichage = '<div id="affiner"> 
            '.$strErreur.'
          </div>';
}//fin else
echo $strAffichage;