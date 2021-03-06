$(function()
{
    /*************************************************************************************** 
     * Fonction appelée lorsqu'on clique sur le bouton "Valider" du formulaire "Moyenne.php"
     ************************************************************************************ */
    $('#btnmoyenne').click(
            function(e){
                //Annulation de l'effet normal de la balise <a href...>
                e.preventDefault();
                e.stopPropagation();
                //Récupération des valeurs et appel au fichier ajax
                $.post("./ajax/genererGraphiqueMoyenne.php", 
                        {
                            "periode"   :   $("input[type=radio][name=periode]:checked").attr('value'),
                            "code"      :   $("#code").val()
                        },
                        foncRetourGraph
                );
    });//fin $(...).click
    
    function foncRetourGraph(data){
        $("#divgraphique").html(data);
    }//fin foncRetourGraphMoyenne
    
    /************************************************************************************* 
     * Fonction appelée lorsqu'on clique sur le bouton "Valider" du formulaire "Perso.php"
     ********************************************************************************** */
    $("#btnperso").click(
            function(e) {
                //Annulation de l'effet normal de la balise <a href...>
                e.preventDefault();
                e.stopPropagation();
                //Récupération des valeurs et appel au fichier ajax
                $.post("./ajax/genererGraphiquePerso.php",
                        {
                            "periode"       : $("input[type=radio][name=periode]:checked").attr('value'),
                            "comparaison"   : $("select[name='comparer'] > option:selected").attr('value'),
                            "code"          : $("#code").val()
                        },
                        foncRetourGraph
                );
    });
    
    /************************************************************************************* 
     * Fonction appelée lorsqu'on clique sur le bouton "Valider" du formulaire "Stat.php"
     ********************************************************************************** */
    $("#btnstat").click(
            function(e) {
                //Annulation de l'effet normal de la balise <a href...>
                e.preventDefault();
                e.stopPropagation();
                
                //Récupération des valeurs et appel au fichier ajax
                $.post("./ajax/calculerStatistiques.php",
                        {
                            "periode"   : $("input[type=radio][name=periode]:checked").attr('value'),
                            "code"      : $("#code").val()
                        },
                        foncRetourCalculStats
                );
    });
    
    function foncRetourCalculStats(data){
        $("#zoneStats").html(data);
    }//fin foncRetourCalculStats
    
    /******************************************************************************************* 
     * Fonction appelée lorsqu'on clique sur le bouton "Valider" du formulaire "Rechercher.php"
     **************************************************************************************** */
    $("#btnrechercher").click(function(e) {
                //Annulation de l'effet normal de la balise <a href...>
                e.preventDefault();
                e.stopPropagation();
                
                //Récupération des valeurs et appel au fichier ajax
                $.post("./ajax/rechercherUnDocument.php",
                        {
                            "titre"         : $("#titreD").val(),
                            "typeDocument"  : $("select[name='typeDocument'] > option:selected").attr('value')
                        },
                        foncRetourRecherche
                );
    });
    
    function foncRetourRecherche(data){
        $("#resultatRecherche").html(data);
    }//fin foncRetourRecherche
});