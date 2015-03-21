<?php
if(isset($_POST['Periode'])) //Si la variables periode exite et code n'ai pas vide on peut faire le graphique
{
    $periode=$_POST['Periode']; //On la récupére
    
    //recherche de la somme d'impression selon la période choisi ainsi que la date du jour
    $total=nbImpressions($_REQUEST['code'],$periode);
    
    //On calcul les statistiques selon la période choisi et le code utilisateur
    if($periode=='mois')
    {
        //On recherche son nombre maximun d'impression et a quel mois 
        //Création de 2 variables qui contiendra les résultats de la requete 
        $periodeT = array();
        $somme = array();

        //Fonction pour récupérer le résultat moyen selon la periode voulu
        $resultSomme=StatPerso($_REQUEST['code'],$periode);

        //Rangement des résultats dans les tableaux
        $i=0;
        $max=0;
        $min=100000;
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
    }//fin if($periode=='mois')
    elseif ($periode=="annee") 
    {
        //On recherche son nombre maximun d'impression et a quel année 
        //Création de 2 variables qui contiendra les résultats de la requete 
        $periodeT = array();
        $somme = array();

        //Fonction pour récupérer le résultat moyen selon la periode voulu
        $resultSomme=StatPerso($_REQUEST['code'],$periode);

        //Rangement des résultats dans les tableaux
        $i=0;
        $max=0;
        $min=1000000;
        while ($row = mysql_fetch_array($resultSomme, MYSQL_NUM)) 
        {
            $periodeT[$i] = $row[0];
            $somme[$i] = floor($row[1]);
            if($somme[$i]>$max)
            {
                $max=$somme[$i];
                $dateMax=$periodeT[$i];
            }//fin if($somme[$i]>$max)
            if($somme[$i]<$min)
            {
                $min=$somme[$i];
                $dateMin=$periodeT[$i];
            }//fin if($somme[$i]<$min)
            $i++;
        }//fin while
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
    }//fin elseif ($periode=="annee")
    else
    {
        //On recherche son nombre maximun d'impression et a quel jour 
        //Création de 2 variables qui contiendra les résultats de la requete 
        $periodeT = array();
        $somme = array();

        //Fonction pour récupérer le résultat moyen selon la periode voulu
        $resultSomme=StatPerso($_REQUEST['code'],$periode);

        //Rangement des résultats dans les tableaux
        $i=0;
        $max=0;
        $min=10000;
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
    }//fin else
}//fin if(isset($_POST['Periode']) and $code!="")
?>