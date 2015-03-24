<?php
include('../util/dbconnect.php');
require_once('../util/fonctions.php');
getConnection();    //On établi la connexion à la bdd
//On récupère la valeur du formulaire
$recherche  = $_REQUEST["titre"];

//On doit écrire au minimum 5 caractères 
$caracMin   = 5;

//On utilise une fonction pour rechercher les documents qui composent cette recherche avec leurs dates et le nombre de pages
$resultat   = rechercheDoc($recherche);

//Création de 3 tableaux qui vont contenir le nom, la date et le nombre de pages des documents trouvés
$date       = array();
$noms       = array();
$pages      = array();

//On définit le message d'erreur si le critère de recherche est inférieur à 5 caractères
if(strlen($recherche) < $caracMin)
{
    $erreur = "Veuillez saisir au minimum 5 caract&egrave;res.";
}//fin strlen

//On créer le tableau s'il n'y a pas d'erreur
if(!isset($erreur))
{
    $affichage = '
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
        $pages[$i] = $row[2];
        $noms[$i] = $row[1];
        $dates[$i] = $row[0];
        $affichage .= "
                                            <tr>
                                                <th>".$pages[$i]."</th>
                                                <td>".$noms[$i]."</td>
                                                <td>".$dates[$i]."</td>
                                            </tr>";
        $i++;
    }//while

    if($i == 0)
    {
        $affichage .= "<tr><th colspan='4'>Aucun Document trouv&eacute;...</th></tr> ";
    }

    $affichage .= "
                              </tbody> 
                            </table>
                        </div>
                        <br /><div id='resultat'> R&eacute;sultat(s) trouv&eacute;(s): ".$i.".</div>";
}//fin if(!isset($erreur))
else
{
    $affichage = '<div id="affiner"> 
            '.$erreur.'
          </div>';
}//fin else
echo $affichage;