
<!--Contenue du corps du tableau-->
    <!--Debut de la 1ere ligne du tableau en-tete-->
    <tr>
            <td rowspan="5">
                <img src="./images/index_17.jpg" width="33" height="463" alt="" />
            </td>
            <td colspan="11">
                <div id="left_content_image"><br />
                    <div class="h2"><br /></div>
                    <br />
                    <div class="content_statR">
                        P&eacute;riode:
                    </div>
                </div>
            </td>
            <td colspan="8" rowspan="3">
                <div id="content"><br />
                    <div class="h1">Impressions Moyenne</div>
                    <br />
                    <div class="content_statL">
                        <input type="hidden" id="code" name="code" value="<?php echo $strCode; ?>" />
                        <!-- Les boutons radio -->
                        <input type='radio' id='pj' name='periode' value='jour'/><label for='pj'> Jour</label> &nbsp;
                        <input type='radio' id='pm' name='periode' value='mois' checked/><label for='pm'> Mois</label> &nbsp;
                        <input type='radio' id='pa' name='periode' value='annee'/><label for='pa'> Ann&eacute;e</label> &nbsp;
                        <!-- Bouton "Valider" -->
                        <a href="#" data-role="button" id="btnmoyenne" class="bouton">Valider</a>
                        <!--Ce echo permet d'insérer le graph et d'en faire un zoom lorsqu'on clique dessus.-->
                        <section class='image'>
                            <figure tabindex='1' contenteditable='true'>
                                <div id="divgraphique"></div>
                            </figure>
                        </section>
                    </div>
                </div>
            </td>
            <td rowspan="5">
              <img src="./images/index_20.jpg" width="108" height="463" alt="" />
            </td>
    </tr>
    <tr>
      <td rowspan="2">
        <img src="./images/index_21.jpg" width="14" height="114" alt="" /></td>
	    <td height="36" colspan="2" style="background:url(./images/index_22.jpg)"></td>
	    <td rowspan="2">
	        <img src="./images/index_23.jpg" width="11" height="114" alt="" />
            </td>
            <td style="background:url(./images/index_24.jpg)">
            </td>
	    <td colspan="2" rowspan="2">
	        <img src="./images/index_25.jpg" width="13" height="114" alt="" />
            </td>
	    <td colspan="3" style="background:url(./images/index_22.jpg)"></td>
	    <td rowspan="2">
	        <img src="./images/index_33.jpg" width="35" height="114" alt="" />
            </td>
      </tr>                