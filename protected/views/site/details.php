<?php
if(Yii::app()->user->level>=5){
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Detailansicht</title>
    <link rel="stylesheet" href="/FBFinal/jquery-multi/css/jquery-ui-1.8.9.custom/jquery-ui-1.8.9.custom.css">
    <script src="/FBFinal/jquery-ui/js/jquery-1.8.2.js"></script>
    <script src="/FBFinal/jquery-ui/js/jquery-ui-1.9.0.custom.js"></script>
    
</head>
<body>
<?php   
    $fktNr = (int)($fktNr);
    $link = "http://localhost/FBFinal/index.php?r=site/details&fktNr=";
    $pFkt = $prevFkt;
    $nFkt = $nextFkt;
    $pPhase = $prevPhase;
    $nPhase = $nextPhase;
?>
    
    <div class ="kopfzeile" style="text-align: center;">
        
            <button class="button_schließen" onClick='window.location.href="<?php echo $link.$pPhase ?>";' ><<</button>
        
            <button class="button_schließen" onClick='window.location.href="<?php echo $link.$pFkt ?>";'><</button>
        
            <button class="button_schließen" onclick="window.close()">schließen</button>
            
            <span id="Funktionsname" ><?php echo"[".$funktionsdaten['nummer']."] - ".$funktionsdaten['name'];?></span>
            
            <button class="button_schließen" style="float:right; margin-right: 5px;" onClick='window.location.href="<?php echo $link.$nPhase ?>";' >>></span></button>
            
            <button class="button_schließen" style="float:right;" onClick='window.location.href="<?php echo $link.$nFkt ?>";'>></span></button>

    </div>
    
   
    
    <div class="kopfzeile2">
    <?php
        $phaseName = $grobphase[$funktionsdaten["grobphase_id"]]["name"];
        $phaseNr = $funktionsdaten["grobphase_id"];
        $uphaseName = $unterphase[$funktionsdaten["unterphase_id"]]["name"];
        $uphaseNr = $funktionsdaten["unterphase_id"];
        
        echo '<div class="kRight"><span>Unterphase: '.$uphaseNr.'. '.$uphaseName.'</span></div>';
        echo '<div class="kLeft"><span>Grobphase: '.$phaseNr.'. '.$phaseName.'</span></div>';
    ?>
    </div>
   
    <div class="headline_details">
        Allgemein
    </div>
    <div class="row">
    <div class="beratung">
        <div class="topline">Beratung</div>
        <div class="inhalt3">
      <?php if($funktionsdaten['priv_mit_beratung'] != "keine Abhängig" && $funktionsdaten['prof_mit_beratung'] != "keine Abhängig" && $funktionsdaten['priv_ohne_beratung'] != "keine Abhängig" && $funktionsdaten['prof_ohne_beratung'] != "keine Abhängig" && $funktionsdaten['r_ausf_geschaeft'] != "keine Abhängig"){ ?>
            <table class="inhalte">
                <tr>
                    <td>Privat mit Beratung</td>
                    <td>Privat ohne Beratung</td>
                    <td>Professionell mit Beratung</td>
                    <td>Professionell ohne Beratung</td>
                    <td>Reines Ausführungsgeschäft</td>
                </tr>
                <tr>
                    <td>
                    <?php 
                        if($funktionsdaten['priv_mit_beratung']== 'gesetzFunktion'){
                            echo "<img title='Funktion bedingt durch Gesetz' src='/FBFinal/css/images/pfeile/gesetzFunktion.png'>";
                        }
                        elseif($funktionsdaten['priv_mit_beratung'] == 'funktionGesetz'){
                            echo "<img title='Gesetz bedingt durch Funktion'src='/FBFinal/css/images/pfeile/funktionGesetz.png'>";
                        }
                        else{ echo"";}
                    ?>
                    </td>
                    <td>
                    <?php 
                        if($funktionsdaten['prof_mit_beratung'] == 'gesetzFunktion'){
                            echo "<img title='Funktion bedingt durch Gesetz' src='/FBFinal/css/images/pfeile/gesetzFunktion.png'>";
                        }
                        elseif($funktionsdaten['prof_mit_beratung'] == 'funktionGesetz'){
                            echo "<img title='Gesetz bedingt durch Funktion'src='/FBFinal/css/images/pfeile/funktionGesetz.png'>";
                        }
                        else{ echo"";}
                    ?>                       
                    </td>
                    <td>
                    <?php 
                        if($funktionsdaten['priv_ohne_beratung'] == 'gesetzFunktion'){
                            echo "<img title='Funktion bedingt durch Gesetz' src='/FBFinal/css/images/pfeile/gesetzFunktion.png'>";
                        }
                        elseif($funktionsdaten['priv_ohne_beratung'] == 'funktionGesetz'){
                            echo "<img title='Gesetz bedingt durch Funktion'src='/FBFinal/css/images/pfeile/funktionGesetz.png'>";
                        }
                        else{ echo"";}
                    ?>
                    </td>
                    <td>
                    <?php 
                        if($funktionsdaten['prof_ohne_beratung'] == 'gesetzFunktion'){
                            echo "<img title='Funktion bedingt durch Gesetz' src='/FBFinal/css/images/pfeile/gesetzFunktion.png'>";
                        }
                        elseif($funktionsdaten['prof_ohne_beratung'] == 'funktionGesetz'){
                            echo "<img title='Gesetz bedingt durch Funktion'src='/FBFinal/css/images/pfeile/funktionGesetz.png'>";
                        }
                        else{ echo"";}
                    ?>
                    </td>
                    <td>
                    <?php 
                        if($funktionsdaten['r_ausf_geschaeft'] == 'gesetzFunktion'){
                            echo "<img title='Funktion bedingt durch Gesetz' src='/FBFinal/css/images/pfeile/gesetzFunktion.png'>";
                        }
                        elseif($funktionsdaten['r_ausf_geschaeft'] == 'funktionGesetz'){
                            echo "<img title='Gesetz bedingt durch Funktion'src='/FBFinal/css/images/pfeile/funktionGesetz.png'>";
                        }
                        else{ echo"";}
                    ?>
                    </td>
                </tr>
            </table>
  <?php }?>
        </div>
    </div>
    
    <div class="regulatorien">
        <div class="topline">Gesetze</div>
        <div class="inhalt2"><?php for($i=0;$i<count($gesetze);$i++){echo ($i+1).". ".$gesetze[$i]["gesetz"].'<br/>';} ?></div>
    </div>
        
    </div>
    
    <div class="row">
    	
    <div class="beschreibung2">
        <div class="topline">Beschreibung</div>
        <div class="inhalt2"><?php echo $funktionsdaten['beschreibung']; ?></div>
    </div>
    
    <div class="hinweise">
        <div class="topline">Hinweise</div>
        <div class="inhalt2"><?php echo $funktionsdaten['hinweis']; ?></div>
    </div>
    </div>
    
    <div class="headline_details">
        Beschreibung Gesetze
    </div>
    <div class="row">
    <div class="auslegung2">
        <div class="topline">Auslegung</div>
        <div class="inhaltBR"><?php 
		if(!empty($auslegungenGesetz) && !empty($auslegungenGesetz[0][0]["name"])){
			echo "Auslegungen der Gesetze: <br/>";
			for($i=0;$i<count($auslegungenGesetz);$i++){
				for($j=0;$j<count($auslegungenGesetz[$i]);$j++){
					echo "Auslegung für Gesetz <b>".($i+1).". ".$gesetze[$i]["gesetz"]."</b>: ".$auslegungenGesetz[$i][$j]["name"].":     ".$auslegungenGesetz[$i][$j]["beschreibung"].'<br/><br/>';
				}
			}
		}	
		
		if(!empty($auslegungenBR)){
			echo "<br/>Auslegungen der Business Rules: <br/>";
			for($i=0;$i<count($auslegungenBR);$i++){
				for($j=0;$j<count($auslegungenBR[$i]);$j++){
					echo "Auslegung für Business Rule <b>".($i+1).". ".$business_rules[$i]["name"]."</b>: ".$auslegungenBR[$i][$j]["name"].":     ".$auslegungenBR[$i][$j]["beschreibung"].'<br/><br/>';
				}
			}
		}
		?></div>
    </div> 
        
    <div class="businessRules">
        <div class="topline">Business Rules</div>
        <div class="inhaltBR"><?php for($i=0;$i<count($business_rules);$i++){echo ($i+1).". ".$business_rules[$i]["name"].":     ".$business_rules[$i]["beschreibung"].'<br/>';} ?></div>
    </div>
        
    </div>

    <!-- Szenarien -------------------------------------------------------------->
    <div class="headline_details">
        Szenarien
    </div>
    
  <div class="row">
    <div class="smallboxSzenarien">
        <div class="topline" >Filiale - Minimum <?php echo '['.$funktionsdaten['filiale_minimum_dauer'].'min] <div class="info_button" title="Minimum muss durchgef&uuml;hrt werden!"></div>' ?></div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['filiale_minimum']; ?></div>
    </div>
      
    <div class="smallboxSzenarien">
        <div class="topline" >Filiale - Empfehlung <?php echo '['.$funktionsdaten['filiale_empfehlung_dauer'].'min] <div class="info_button" title="Empfehlung kann durchgef&uuml;hrt werden! Die Dauer wird zu Minimum addiert!"></div>' ?></div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['filiale_empfehlung']; ?></div>
    </div>
      
    <div class="smallboxSzenarien">
        <div class="topline">Filiale - Kommentar</div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['filiale_kommentar']; ?></div>
    </div>
  </div>
    
  <div class="row">
    <div class="smallboxSzenarien">
        <div class="topline" >Online - Minimum <?php echo '['.$funktionsdaten['online_minimum_dauer'].'min] <div class="info_button"></div> <div class="info_button" title="Minimum muss durchgef&uuml;hrt werden!"></div>' ?></div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['online_minimum']; ?></div>
    </div>
      
    <div class="smallboxSzenarien">
        <div class="topline" >Online - Empfehlung <?php echo '['.$funktionsdaten['online_empfehlung_dauer'].'min] <div class="info_button" title="Empfehlung kann durchgef&uuml;hrt werden! Die Dauer wird zu Minimum addiert!"></div>' ?></div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['online_empfehlung']; ?></div>
    </div>
      
    <div class="smallboxSzenarien">
        <div class="topline">Online - Kommentar</div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['online_kommentar']; ?></div>
    </div>
  </div>
    
  <div class="row">
    <div class="smallboxSzenarien">
        <div class="topline" >Mobil - Minimum <?php echo '['.$funktionsdaten['mobil_minimum_dauer'].'min] <div class="info_button" title="Minimum muss durchgef&uuml;hrt werden!"></div>' ?></div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['mobil_minimum']; ?></div>
    </div>
      
    <div class="smallboxSzenarien">
        <div class="topline">Mobil - Empfehlung <?php echo '['.$funktionsdaten['mobil_empfehlung_dauer'].'min] <div class="info_button" title="Empfehlung kann durchgef&uuml;hrt werden! Die Dauer wird zu Minimum addiert!"></div>' ?></div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['mobil_empfehlung']; ?></div>
    </div>
      
    <div class="smallboxSzenarien">
        <div class="topline">Mobil - Kommentar</div>
        <div class="inhaltSzenarien"><?php echo $funktionsdaten['mobil_kommentar']; ?></div>
    </div>
  </div>
    
    <div class="headline_details">
        Wechselm&ouml;glichkeiten
    </div>
    <div class="row">
    <div class="sprungstelle2">
        <div class="topline">Sprungstellen</div>
        <div class="inhalt3">
            <?php
                
                $ausgabe = explode(",",$funktionsdaten['sprungstelle']);
                $ausgabeLength = count($ausgabe);

                for($i=0;$i<$ausgabeLength;$i++){
                    if(isset($funktion[$ausgabe[$i]]["nummer"])){
                        $funktionsNr = $funktion[$ausgabe[$i]]["nummer"];
                        $funktionsName = $funktion[$ausgabe[$i]]["name"];
                    
                        echo '<a class="links" href="'.$link.$funktionsNr.'">['.$funktionsNr.'] '.$funktionsName.'</a></br></br>';
                    }
                } 
            ?>
        </div>
    </div>

    <div class="funktionsfolge2">
        <div class="topline">Funktionsfolgen</div>
        <div class="inhalt3">
            <?php
                $ausgabe = explode(",",$funktionsdaten['funktionsfolge']);
                $ausgabeLength = count($ausgabe);
                
                for($i=0;$i<$ausgabeLength;$i++){
                    if(isset($funktion[$ausgabe[$i]]["nummer"])){
                        $funktionsNr = $funktion[$ausgabe[$i]]["nummer"];
                        $funktionsName = $funktion[$ausgabe[$i]]["name"];
                    
                        echo '<a class="links" href="'.$link.$funktionsNr.'">['.$funktionsNr.'] '.$funktionsName.'</a></br></br>';
                    }
                } 
            ?>
        </div>
    </div>
    </div>
    
    
    <div class="headline_details">
        Sonstiges
    </div>
    <div class="row">  
    <?php
    if($funktionsdaten['hsr_aktuell']!= "keine Abhängig" || $funktionsdaten['hsr_zukuenftig']!= "keine Abhängig"){?>
    <div class="smallbox">
        <div class="topline">Spielraum</div>
        <div class="inhalt3">
            <table class="inhalte">
                <tr>
                    <td style="width: 61px;">aktuell</td>
                    <td style="width: 61px;">zukünftig</td>
                </tr>
                <tr>
                    <?php if($funktionsdaten['hsr_aktuell'] == 'gruen') { ?>
                    <td style="background-color: #009000;">  </td>
                    <?php }
                    elseif($funktionsdaten['hsr_aktuell'] == 'gelb') { ?>
                    <td style="background-color: #ffff00;">  </td>
                    <?php }
                    elseif($funktionsdaten['hsr_aktuell'] == 'gelbHoch'){ 
                    echo "<td> <img src='/FBFinal/css/images/pfeile/gelbHoch.png'></td>";
                    }
                    elseif($funktionsdaten['hsr_aktuell'] == 'gelbRunter'){ 
                    echo "<td > <img style='transform: rotate(180deg);' src='/FBFinal/css/images/pfeile/gelbHoch.png'></td>";
                    }
                    elseif($funktionsdaten['hsr_aktuell'] == 'rot') { ?>
                    <td style="background-color: #009000;">  </td>
                    <?php }
                    else{ ?>
                    <td style="background-color: #ffffff;"> </td>
                    <?php }
                    if($funktionsdaten['hsr_zukuenftig'] == 'gruen') { ?>
                    <td style="background-color: #009000;">  </td>
                    <?php }
                    elseif($funktionsdaten['hsr_zukuenftig'] == 'gelb') { ?>
                    <td style="background-color: #ffff00;">  </td>
                    <?php }
                    elseif($funktionsdaten['hsr_zukuenftig'] == 'gelbHoch'){ 
                    echo "<td> <img src='/FBFinal/css/images/pfeile/gelbHoch.png'></td>"; 
                    }
                    elseif($funktionsdaten['hsr_zukuenftig'] == 'gelbRunter'){ 
                    echo "<td > <img style='transform: rotate(180deg);' src='/FBFinal/css/images/pfeile/gelbHoch.png'></td>";
                    }
                    elseif($funktionsdaten['hsr_zukuenftig'] == 'rot') { ?>
                    <td style="background-color: #009000;">  </td>
                    <?php } 
                    else{ ?>
                    <td style="background-color: #ffffff;"> </td>
                    <?php }} ?>
                    
                </tr>
            </table>
        </div>
    </div>
        
    <div class="smallbox">
        <div class="topline">Inputdaten</div>
        <div class="inhalt4"><?php echo $funktionsdaten['inputdaten']; ?></div>
    </div>
        
    <div class="smallbox">
        <div class="topline">Outputdaten</div>
        <div class="inhalt4"><?php echo $funktionsdaten['outputdaten']; ?></div>
    </div>
        
    <div class="smallbox">
        <div class="topline">Kanalwechsel</div>
        <div class="inhalt4"><?php echo $funktionsdaten['kanalwechsel']; ?></div>
    </div>

    </div>
    
    <div class="headline_details">
        Akteure und Betroffene
    </div>
    <div class="row">   
    <div class="smallbox">
        <div class="topline">Spezialist/Generalist</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['spezialist_vs_generalist'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['spezialist_vs_generalist'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>


    <div class="smallbox">
        <div class="topline">Frontoffice Generalist</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['frontoffice_generalist'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['frontoffice_generalist'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>

    <div class="smallbox">
        <div class="topline">Frontoffice Experte</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['frontoffice_experte'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['frontoffice_experte'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>

    <div class="smallbox">
        <div class="topline">Backoffice</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['backoffice'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['backoffice'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>

    <div class="smallbox">
        <div class="topline">Produklieferant</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['produktlieferant'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['produktlieferant'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>

    <div class="smallbox">
        <div class="topline">Bank</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['bank'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['bank'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>

    <div class="smallbox">
        <div class="topline">Kunde</div>
        <div class="inhalt">
            <?php 
                if($funktionsdaten['kunde'] == "akteur"){
                    echo "Akteur";
                }else if($funktionsdaten['kunde'] == "betroffener"){
                    echo "Betroffener";
                } 
            ?>
        </div>
    </div>

    <div class="smallbox">
        <div class="topline">Verantwortlicher</div>
        <div class="inhalt"><?php echo $funktionsdaten['verantwortlicher']; ?></div>
    </div>
  </div>
  
  
  

</body>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 } else{}
?>
