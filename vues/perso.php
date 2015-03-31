<!--Contenu du corps du tableau-->
    <tr>
    <!--Debut du formulaire-->
      <td rowspan="5">
        <img src="./images/index_17.jpg" width="33" height="463" alt="" />
      </td>
      <td colspan="11">
          <div id="left_content_image"><br />
              <div class="h2"><br /></div>
              <br />
              <div class="content_statR">
              P&eacute;riode:<br /><br />
              Comparer avec :
              </div>   
          </div>
      </td>
      <td colspan="8" rowspan="3">
          <div id="content"><br />
              <div class="h1">Impressions Personnelles</div>
                  <br />
                  <div class="content_statL"> 
                      <input type="hidden" id="code" name="code" value="<?php echo $strCode; ?>" />
                      <!--3 boutons radio, le mois est selectionné pas défaut-->
                      <input type='radio' id='pj' name='periode' value='jour'/><label for='pj'> Jour</label> &nbsp;
                      <input type='radio' id='pm' name='periode' value='mois' checked/><label for='pm'> Mois</label> &nbsp;
                      <input type='radio' id='pa' name='periode' value='annee'/><label for='pa'> Ann&eacute;e</label> &nbsp;
                      <br /><br/>
                      <!--Liste déroulante pour choisir avoir quoi la courbe personnelle va être comparer-->
                      <SELECT name="comparer" size="1">
                            <OPTION selected value="">- - - 
                            <OPTION value="moyenne">La moyenne
                            <OPTION value="service">M&ecirc;me service
                      </SELECT>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="#" data-role="button" id="btnperso" class="bouton">Valider</a>
                      <section class='image'>
                        <figure tabindex='1' contenteditable='true'>
                            <div id="divgraphique"></div>
                        </figure>
                      </section>
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
	        <img src="./images/index_23.jpg" width="11" height="114" alt="" /></td>
	    <td style="background:url(./images/index_24.jpg)"></td>
	    <td colspan="2" rowspan="2">
	        <img src="./images/index_25.jpg" width="13" height="114" alt="" /></td>
	    <td colspan="3" style="background:url(./images/index_22.jpg)">
	    </td>
	    <td rowspan="2">
	        <img src="./images/index_33.jpg" width="35" height="114" alt="" /></td>
      </tr>