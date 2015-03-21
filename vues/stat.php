<!--Contenue du corps du tableau-->
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
                      </div> 
                </div>
            </td>
                
            <td colspan="8" rowspan="3">
                <div id="content"><br />
                      <div class="h1">Statistiques</div>
                      <br />
                      <div class="content_statL">
                          <input type="hidden" id="code" name="code" value="<?php echo substr($code,6); ?>" />
                          <input type='radio' id='pj' name='periode' value='jour'/><label for='pj'> Jour</label> &nbsp;
                          <input type='radio' id='pm' name='periode' value='mois' checked/><label for='pm'> Mois</label> &nbsp;
                          <input type='radio' id='pa' name='periode' value='annee'/><label for='pa'> Ann&eacute;e</label> &nbsp;
                          <a href="#" data-role="button" id="btnstat" class="bouton">Valider</a><br /><br />
                            <?php
    if(isset($max) and $periode=="mois")
    {
                            ?>
                            <p>
                                Maximum : <?php echo $max?> pages imprim&eacute;es, au mois de <?php echo $dateMax?> .<br />
                                <span class="marge">Co&ucirc;tent: <?php echo $coutMax?> euros.</span><br />
                                <span class="marge">Abat: <?php echo $coutArbMax?> arbres.</span><br /><br />
                                Minimum : <?php echo $min?> pages imprim&eacute;es, au mois de <?php echo $dateMin?> .<br />
                                <span class="marge">Co&ucirc;tent: <?php echo $coutMini?> euros.</span><br />
                                <span class="marge">Abat: <?php echo $coutArbMin?> arbres.</span><br /><br /><br />
                                <!--Ce mois-ci, vous en étes à <?php echo $total?> pages imprim&eacute;es.<br />-->
                            </p>
            
<?php
    }//fin if(isset($max) and $periode=="mois")
    elseif (isset($max) and $periode=="annee") 
    {
?> 
                            <p>
                                Maximum : <?php echo $max?> pages imprim&eacute;es, dans l'ann&eacute;e <?php echo $dateMax?> .<br />
                                <span class="marge">Co&ucirc;tent: <?php echo $coutMax?> euros.</span><br />
                                <span class="marge">Abat: <?php echo $coutArbMax?> arbres.</span><br /><br />
                                Minimum : <?php echo $min?> pages imprim&eacute;es, dans l'ann&eacute;e <?php echo $dateMin?> .<br />
                                <span class="marge">Co&ucirc;tent: <?php echo $coutMini?> euros.</span><br />
                                <span class="marge">Abat: <?php echo $coutArbMin?> arbres.</span><br /><br /><br />
                                <!--Cette année, vous en étes à <?php echo $total?> pages imprim&eacute;es.<br />-->
                            </p>    
                            
                          
                            <?php
                          
                                            }elseif (isset($max) and $periode=="jour")
                                            {
                            ?>                    
                            <p>
                                Maximum : <?php echo $max?> pages imprim&eacute;es, le <?php echo $dateMax?> .<br />
                                <span class="marge">Co&ucirc;tent: <?php echo $coutMax?> euros.</span><br />
                                <span class="marge">Abat: <?php echo $coutArbMax?> arbres.</span><br /><br />
                                Minimum : <?php echo $min?> pages imprim&eacute;es, le <?php echo $dateMin?> .<br />
                                <span class="marge">Co&ucirc;tent: <?php echo $coutMini?> euros.</span><br />
                                <span class="marge">Abat: <?php echo $coutArbMin?> arbres.</span><br /><br /><br />
                                <!--Hier, vous avez imprim&eacute;e <?php echo $total?> page(s).<br />-->
                            </p> 
                          
                          
                            <?php                    
                                            }
                            ?>
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
	        <img src="./images/index_23.jpg" width="11" height="114" alt="" /></td>
	    <td style="background:url(./images/index_24.jpg)"></td>
	    <td colspan="2" rowspan="2">
	        <img src="./images/index_25.jpg" width="13" height="114" alt="" /></td>
	    <td colspan="3" style="background:url(./images/index_22.jpg)">
	    </td>
	    <td rowspan="2">
	        <img src="./images/index_33.jpg" width="35" height="114" alt="" /></td>
      </tr>