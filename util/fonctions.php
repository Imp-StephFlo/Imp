<?php
/**
 * Établit la connection avec mysql et selectionne la base de donnée nécéssaire
 */
function getConnection()
{
        $resDbImp = mysql_connect(  getServerSql(), 
                                    getCompteBase(), 
                                    getPswdBase()   ) or die(mysql_error());
        mysql_select_db(getNomBase(), $resDbImp) or die("Erreur sql : ".mysql_error());
}//fin getConnection

/**
 * Retourne l'utilisateur correspondant au code passé en paramètre
 * @param String Le code de l'utilisateur
 * @return MySQL_Array Le résultat de la requête
 */
function verifCode ($Code)
{
    if($Code == "")
        return "";
    else
    {
        //Creation de la requete
        $requete = "select * from t_user where code='".$Code."';";

        //Exécution de la requete
        $resultat = mysql_query($requete);

        //On extrait le résultat
        $reste = mysql_fetch_row($resultat);

        //On retourne le résultat
        return $reste;
    }//fin else
}//fin verifCode

/**
 * Retourne le code service correspondant au code d'un utilisateur
 * @param String Le code de l'utilisateur
 * @return String Le code service
 */
function codeService($Code)
{
    //Creation de la requete
    $requete = "SELECT service FROM t_user WHERE code ='".$Code."';";

    //Exécution de la requete
    $resultat = mysql_query($requete);

    //On extrait le résultat
    $reste=  mysql_fetch_array($resultat);

    //On retourne le résultat
    return $reste;
}//fin codeService

/**
 * Retourne un code d'utilisateur au hasard parmis ceux du même service que celui passé en paramètre
 * @param String Le code de l'utilisateur
 * @return String Le code aléatoire récupéré dans la bdd
 */
function codeAlea ($strCode)
{
    //On recupére le code service de l'user
    $arrService = codeService($strCode);
    
    //On recherche tout les code user autre que celui saisie
    $requete="SELECT code FROM t_user WHERE code !='".$strCode."' AND code !='' and service=".$arrService[0];
    
    //Exécution de la requete
    $resultat = mysql_query($requete);
    
    //Création d'un tableau qui va contenir les codes
    $arrCodesT=array();
    
    //Rangement des résultats dans les tableaux
    $i=0;
    while ($row = mysql_fetch_array($resultat))
    {
        $arrCodesT[$i] = $row[0];
        $i++;
    }//fin while
    $intAlea = rand(0, $i-1);
    return $arrCodesT[$intAlea];
}//fin codeAlea

/**
 * Retourne la liste des données permettant de calculer les statistiques personnelles
 * @param String Le code de l'utilisateur
 * @param String La période {'jour','mois','annee'}
 * @return MySQL_Array La liste des données
 */
function statPerso($strCode,$strPeriode)
{
    //echo "je suis dans la fonction.";
    //En fonction de la période, on va modifier les termes de la requete à exécuter
    switch ($strPeriode)
    {
        case "mois":
            $strSelect = "concat( DATE_FORMAT( date, '%m' ) , \"-\", DATE_FORMAT( date, '%y' ) ) as periode, sum( pages ) as somme";
            $strWhereInterval = " AND tl.date > DATE_SUB(\"2014-05-19\", INTERVAL 365 DAY)";
            $strGroupBy = "month( date ) , year( date )";
            $strOrderBy = " ORDER by year( date ) , month( date )";
            break;
        case "jour":
            $strSelect = "concat( day(date) , \"-\", DATE_FORMAT( date, '%m' ) ) as periode , sum( pages ) as somme";
            $strWhereInterval = " AND tl.date > DATE_SUB(\"2014-05-19\", INTERVAL 30 DAY)";
            $strGroupBy = "day( date ),  month( date )";
            $strOrderBy = " ORDER by month(date), day( date )";
            break;
        default:
            $strSelect = "concat( 20, DATE_FORMAT( date, '%y' )) as periode, sum( pages ) as somme";
            $strWhereInterval = "";
            $strGroupBy = "year( date )";
            $strOrderBy = "";
            break;
    }//fin switch
    
    //Initialisation de la requete
    $strReqMoyenne =  "SELECT " . $strSelect
                    . " FROM `t_log` AS tl "
                    . " INNER JOIN `t_user` AS tu on tl.iduser=tu.id "
                    . " WHERE `date` > '1' "
                    . " AND tu.code ='" . $strCode ."' "
                    . $strWhereInterval
                    . " GROUP by " . $strGroupBy
                    . $strOrderBy . ";";
        
    //Exécution de la requete
    $result = mysql_query($strReqMoyenne);
    
    //Si la requête n'a rien retourné, on affiche une erreur
    if (!$result) 
    {
        die('Requête invalide : ' . mysql_error());
    }//fin if
    
    return $result;
}//fin statPerso

/**
 * Retourne la liste des données permettant de calculer les statistiques
 * @param String La période {'jour','mois','annee'}
 * @return MySQL_Array La liste des données
 */
//nombreImpression
function statMoyen($strPeriode)
{
    //En fonction de la période, on va modifier les termes de la requete à exécuter
    switch ($strPeriode)
    {
        case "mois":
            $strSelect = "concat( DATE_FORMAT( date, '%m' ) , \"-\", DATE_FORMAT( date, '%y' ) ) as periode, sum( pages ) as somme";
            $strWhereInterval = " AND tl.date > DATE_SUB(\"2014-05-19\", INTERVAL 365 DAY)";
            $strGroupBy = "month( date ) , year( date )";
            $strOrderBy = " ORDER by year( date ) , month( date )";
            break;
        case "jour":
            $strSelect = "concat( day(date) , \"-\", DATE_FORMAT( date, '%m' ) ) as periode , sum( pages ) as somme";
            $strWhereInterval = " AND tl.date > DATE_SUB(\"2014-05-19\", INTERVAL 30 DAY)";
            $strGroupBy = "day( date ),  month( date )";
            $strOrderBy = " ORDER by month(date), day( date )";
            break;
        default:
            $strSelect = "concat( 20, DATE_FORMAT( date, '%y' )) as periode, sum( pages ) as somme";
            $strWhereInterval = "";
            $strGroupBy = "year( date )";
            $strOrderBy = "";
            break;
    }//fin switch
    
    //Initialisation de la requete
    $strReqMoyenne =  "SELECT " . $strSelect
                    . " FROM `t_log` AS tl "
                    . " INNER JOIN `t_user` AS tu on tl.iduser=tu.id "
                    . " WHERE `date` > '1' "
                    . $strWhereInterval
                    . " GROUP by " . $strGroupBy
                    . $strOrderBy . ";";
        
    //Exécution de la requete
    $result = mysql_query($strReqMoyenne);
    
    //Si la requête n'a rien retourné, on affiche une erreur
    if (!$result) 
    {
        die('Requête invalide : ' . mysql_error());
    }//fin if
    
    return $result;
}//fin statMoyen

/**
 * Génère un graphique avec une seule courbe
 * @param type $abscisse
 * @param type $ordonne
 * @param type $nomA
 * @param type $nomO
 * @param type $nomGraph
 * @return String Lien vers l'image générée
 */
function graphiqueCourbe($abscisse, $ordonne, $nomA, $nomO, $nomGraph)
{
        //Construction du graphique
        $myData = new pData();
        /* Save the data in the pData array */
        //Creation des courbes
        $myData->addPoints($abscisse, "periode");
        $myData->addPoints($ordonne, "moyenne");

        $myData->setSerieDescription("periode", $nomA);
        $myData->setSerieOnAxis("periode", 0);

        $myData->setSerieDescription("moyenne", $nomO);//Legende de la 2eme courbe
        $myData->setSerieOnAxis("moyenne", 0);

        //On indique que représente l'axe des absices
        $myData->setAbscissa("periode");

        //On met la position des axe à gauche
        $myData->setAxisPosition(0, AXIS_POSITION_LEFT);
        $myData->setAxisName(0, "nombre");
        $myData->setAxisUnit(0, "");

        $myPicture = new pImage(924, 400, $myData);
        $myPicture->drawRectangle(0, 0, 923, 399, array("R" => 0, "G" => 0, "B" => 0));

        $myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 50, "G" => 50, "B" => 50, "Alpha" => 20));

        $myPicture->setFontProperties(array("FontName" => "../pChart/fonts/Forgotte.ttf", "FontSize" => 14));
        $TextSettings = array("Align" => TEXT_ALIGN_TOPMIDDLE
            , "R" => 0, "G" => 0, "B" => 0, "DrawBox" => 1, "BoxAlpha" => 30);
        $myPicture->drawText(462, 25, "Nombre de pages imprimées", $TextSettings); //TITRE DU GRAPH

        $myPicture->setShadow(FALSE);
        $myPicture->setGraphArea(50, 50, 899, 360);
        $myPicture->setFontProperties(array("R" => 0, "G" => 0, "B" => 0, "FontName" => "../pChart/fonts/pf_arma_five.ttf", "FontSize" => 8));

        $Settings = array("Pos" => SCALE_POS_LEFTRIGHT
            , "Mode" => SCALE_MODE_FLOATING
            , "LabelingMethod" => LABELING_ALL
            , "GridR" => 255, "GridG" => 255, "GridB" => 255, "GridAlpha" => 50, "TickR" => 0, "TickG" => 0, "TickB" => 0, "TickAlpha" => 50, "LabelRotation" => 0, "CycleBackground" => 1, "DrawXLines" => 1, "DrawSubTicks" => 1, "SubTickR" => 255, "SubTickG" => 0, "SubTickB" => 0, "SubTickAlpha" => 50, "DrawYLines" => ALL);
        $myPicture->drawScale($Settings);

        $myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 50, "G" => 50, "B" => 50, "Alpha" => 10));

        $Config = array("DisplayValues" => 1);
        $myPicture->drawSplineChart($Config);

        $Config = array("FontR" => 0, "FontG" => 0, "FontB" => 0, "FontName" => "../pChart/fonts/pf_arma_five.ttf", "FontSize" => 8, "Margin" => 6, "Alpha" => 30, "BoxSize" => 5, "Style" => LEGEND_NOBORDER
            , "Mode" => LEGEND_HORIZONTAL
        );
        $myPicture->drawLegend(752, 16, $Config);
        // ATTENTION, il faut que pChart génère l'image dans "../images/" mais on retourne "./images" 
        // avec un SEUL et UNIQUE point car le fichier ajax n'est pas dans le même répertoire que 
        // pChart lors de son exécution
        $lienImage = "./images/".$nomGraph.".png";
        $myPicture->Render(".".$lienImage);
        return $lienImage;
}//fin graphiqueCourbe

/**
 * Génère un graphique avec 2 courbes
 * @param type $abscisse
 * @param type $courbe1
 * @param type $courbe2
 * @param type $nomA
 * @param type $nomO1
 * @param type $nomO2
 * @param type $nomGraph
 * @return String Lien vers l'image générée
 */
function graphiqueCourbes ($abscisse, $courbe1, $courbe2, $nomA, $nomO1, $nomO2, $nomGraph)
{
        //Construction du graphique
        $myData = new pData();
        /* Save the data in the pData array */
        //Creation des courbes
        $myData->addPoints($abscisse, $nomA);
        $myData->addPoints($courbe1, $nomO1);

        $myData->setSerieDescription($nomA, $nomA);
        $myData->setSerieOnAxis($nomA, 0);

        $myData->setSerieDescription($nomO1, $nomO1);//Legende de la 1eme courbe
        $myData->setSerieOnAxis($nomO1, 0);
                
        $myData->addPoints($courbe2, $nomO2);
        $myData->setSerieDescription($nomO2, $nomO2); //Legende de la 2ere courbe
        $myData->setSerieOnAxis($nomO2, 0);// on indique a combien on commance l'axe des ordonnés

        //On indique que représente l'axe des absices
        $myData->setAbscissa($nomA);

        //On met la position des axe à gauche
        $myData->setAxisPosition(0, AXIS_POSITION_LEFT);
        $myData->setAxisName(0, "nombre");
        $myData->setAxisUnit(0, "");

        $myPicture = new pImage(1024, 400, $myData);
        $myPicture->drawRectangle(0, 0, 1023, 399, array("R" => 0, "G" => 0, "B" => 0));

        $myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 50, "G" => 50, "B" => 50, "Alpha" => 20));

        $myPicture->setFontProperties(array("FontName" => "../pChart/fonts/Forgotte.ttf", "FontSize" => 14));
        $TextSettings = array("Align" => TEXT_ALIGN_TOPMIDDLE
            , "R" => 0, "G" => 0, "B" => 0, "DrawBox" => 1, "BoxAlpha" => 30);
        $myPicture->drawText(512, 25, "Nombre de pages imprimées", $TextSettings); //TITRE DU GRAPH

        $myPicture->setShadow(FALSE);
        $myPicture->setGraphArea(50, 50, 999, 360);
        $myPicture->setFontProperties(array("R" => 0, "G" => 0, "B" => 0, "FontName" => "../pChart/fonts/pf_arma_five.ttf", "FontSize" => 8));

        $Settings = array("Pos" => SCALE_POS_LEFTRIGHT
            , "Mode" => SCALE_MODE_FLOATING
            , "LabelingMethod" => LABELING_ALL
            , "GridR" => 255, "GridG" => 255, "GridB" => 255, "GridAlpha" => 50, "TickR" => 0, "TickG" => 0, "TickB" => 0, "TickAlpha" => 50, "LabelRotation" => 0, "CycleBackground" => 1, "DrawXLines" => 1, "DrawSubTicks" => 1, "SubTickR" => 255, "SubTickG" => 0, "SubTickB" => 0, "SubTickAlpha" => 50, "DrawYLines" => ALL);
        $myPicture->drawScale($Settings);

        $myPicture->setShadow(TRUE, array("X" => 1, "Y" => 1, "R" => 50, "G" => 50, "B" => 50, "Alpha" => 10));

        $Config = array("DisplayValues" => 1);
        $myPicture->drawSplineChart($Config);

        $Config = array("FontR" => 0, "FontG" => 0, "FontB" => 0, "FontName" => "../pChart/fonts/pf_arma_five.ttf", "FontSize" => 8, "Margin" => 6, "Alpha" => 30, "BoxSize" => 5, "Style" => LEGEND_NOBORDER
            , "Mode" => LEGEND_HORIZONTAL
        );
        $myPicture->drawLegend(842, 16, $Config);
        
        // ATTENTION, il faut que pChart génère l'image dans "../images/" mais on retourne "./images" 
        // avec un SEUL et UNIQUE point car le fichier ajax n'est pas dans le même répertoire que 
        // pChart lors de son exécution
        $lienImage = "./images/".$nomGraph.".png";
        $myPicture->Render(".".$lienImage);
        return $lienImage;
}//fin graphiqueCourbes

/**
 * Génère un mot de passe aléatoire
 * @param Integer La longueur du mot de passe
 * @return String Le mot de passe généré aléatoirement
 */
function genererMDP ($intLongueur = 8)
{
    // initialiser la variable $mdp
    $strMdp = "";
 
    // Définir tout les caractères possibles dans le mot de passe,
    // Il est possible de rajouter des voyelles ou bien des caractères spéciaux
    $strPossible = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
 
    // obtenir le nombre de caractères dans la chaîne précédente
    // cette valeur sera utilisé plus tard
    $intLongueurMax = strlen($strPossible);
    
    if ($intLongueur > $intLongueurMax) 
    {
        $intLongueur = $intLongueurMax;
    }//fin if
 
    // initialiser le compteur
    $i = 0;
    // ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
    while ($i < $intLongueur)
    {
        // prendre un caractère aléatoire
        $strCaractere = substr($strPossible, mt_ran(0, $intLongueurMax-1), 1);
 
        // vérifier si le caractère est déjà utilisé dans $mdp
        if (!strstr($strMdp, $strCaractere))
        {
            // Si non, ajouter le caractère à $mdp et augmenter le compteur
            $strMdp .= $strCaractere;
            $i++;
        }//fin if
    }//fin while
    // retourner le résultat final
    return $strMdp;
}//fin genererMDP

/**
 * Attribut un code aléatoire à tous les utilisateur n'en ayant pas
 */
function modifBDD()
{
    //Rechercher les nom d'user qui on pas de code
    $requete  = "select nom from t_user where code=''";
    
    //On execute la requete
    $resultat = mysql_query($requete);
    
    //Création d'un tableau qui va contenir les codes
    $arrUserVide = array();
    
    //Rangement des résultats dans les tableaux
    $i = 0;
    while($row = mysql_fetch_array($resultat))
    {
        //recuperation d'un code
        $strNewCode         = genererMDP();
        $arrUserVide[$i]    = $row[0];
        //Requete d'ajout d'un code à chaque agent qui n'on pas de code 
        mysql_query("UPDATE t_user SET code='".$strNewCode."' WHERE nom = '".$arrUserVide[$i]."'");
        $i++;
    }//fin while
}//fin modifBDD

/**
 * Retourne le nombre de pages imprimées par l'utilisateur, dont le code est celui passé en 1er paramètre, sur la période correspondant au 2ème paramètre
 * @param String Le code de l'utilisateur
 * @param String La période désirée - {'jour','mois','year'}
 * @return Integer Le nombre de pages imprimées
 */
function nbImpressions($intCode,$strPeriode)
{
    //En fonction de la période, on défini la condition (clause where) sur la date de la requete
    switch ($strPeriode)
    {
        case 'mois':
            $strWhereDate = 'month (\"2014-05-19\")';
            break;
        case 'jour':
            $strWhereDate = 'NOW()';
            break;
        default:
            $strWhereDate = 'year(\"2014-05-19\")';
            break;
    }//fin switch
    //On initialise une variable contenant le texte de la requete
    $requete  = "SELECT sum( pages ) as total \n"
                . "FROM `t_log` AS tl, `t_user` AS tu\n"
                . "WHERE\n"
                . "tl.iduser = tu.id AND\n"
                . "tu.code = \"" . $intCode . "\" AND\n"
                . "tl.date = ".$strWhereDate." AND\n" // On prend seulement sur ce mois-ci
                . "1\n";
    //On retourne le résultat après avoir extrait le résultat après avoir exécuté la requete
    return mysql_fetch_array(mysql_query($requete));
}//fin nbImpressions*/

/**
 * Retourne le résultat de la recherche de documents
 * @param String Contenu de la zone de recherche
 * @param Integer Code du type de document
 * @return Mysql_Array Résultat de la requête.
 */
function rechercheDoc($strRecherche, $intTypeDocument)
{
    //On créer la requete, en adaptant la variable recherche pour la requete sql (On remplace les espace par des %)
    $requete = "select date, nom, pages from t_log where nom like '%".str_replace(' ','%',$strRecherche)."%'";
    
    //Si le type de document est différent de null, on va ajouter une condition dans la requete
    if($intTypeDocument != "null")
    {
        $requete .= " and format=".$intTypeDocument." ;";
    }//fin if
    else    //sinon on rajoute un ';' pour fermer la requête
    {
        $requete .= ";";
    }//fin else
    
    //On retourne le résultat de la requete
    return mysql_query($requete);
}//fin rechercheDoc

/**
 * Permet d'include tous les fichiers de pChart nécéssaires à la génération de graphes
 */
function includeAllRequiredFiles()
{
    //Fichier pChart pour la créaion d'un graphique
    include("../pChart/class/pData.class.php");
    include("../pChart/class/pDraw.class.php");
    include("../pChart/class/pImage.class.php");
    include("../pChart/class/pCache.class.php");
}//fin includeAllRequiredFiles

/**
 * Génère les balises "<option>" de la liste déroulante "critereRecherche" dans l'onglet "Rechercher"
 */
function getCriteresFormat()
{
    $arrListeFormats = mysql_query("select * from t_type where id<>5");
    
    while ($row = mysql_fetch_array($arrListeFormats))
    {
        echo '                          <option value="'.$row[0].'">'.$row[1].'</option>';
    }//fin while

}//fin getCriteresFormat
?>