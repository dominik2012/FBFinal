 
<!-- PHP FUNCTIONS ------------------------------------------------------------>
<?php
    //Bei zu langem Namen -> kürzen u. $title als vollen Namen
    function shortName($inhalt){
        $inhaltL = mb_strlen($inhalt);
        
        if($inhaltL > 55){
            $title = $inhalt;
        }else{
            $title = "";
        }
        
        return $title;
    }
    
    function shortName2($inhalt){
        $inhaltL = mb_strlen($inhalt);
        
        if($inhaltL > 90){
            $title = $inhalt;
        }else{
            $title = "";
        }
        
        return $title;
    }
?>
<!-- FUNCTIONS ENDE ----------------------------------------------------------->
<?php
if(Yii::app()->user->level>=5){
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Funktionsfilter</title>
    
    <link rel="stylesheet" href="/FBFinal/jquery-multi/css/jquery-ui-1.8.9.custom/jquery-ui-1.8.9.custom.css">
    <link rel="stylesheet" href="/FBFinal/multiselect/jquery.multiselect.css">
    <script src="/FBFinal/jquery-ui/js/jquery-1.8.2.js"></script>
    <script src="/FBFinal/jquery-ui/js/jquery-ui-1.9.0.custom.js"></script>
    <script src="/FBFinal/jquery-multi/jquery.multi-accordion-1.5.3.js"></script>
    <script src="/FBFinal/multiselect/src/jquery.multiselect.js"></script>
    
    <link rel="stylesheet" href="/FBFinal/chosen-master/chosen/chosen.css">
    <script src="/FBFinal/chosen-master/chosen/chosen.jquery.js"></script>
    
    <script type="text/javascript">
    //VIEWFILTER
    $(function() {
        $("#draggable").draggable();
        $("#popup").draggable();
    });
    </script>
    

</head>
<!----------------------------------------------------------------------------->   

<body>
    
<!-- FUNKTIONSFILTER ---------------------------------------------------------->   
<div style="function" id="function" class="function" >
    <div style="function_name" id="function_name"  title="anzeigen/verstecken des Filters" onclick="togglestate();"><p>FUNKTIONSFILTER</p></div>

    <div class="form">
	
		<form name="neu_form" id="neu_form" action="/FBFinal/index.php?r=site/filter" method="POST">
                <div style="float:left;">
                <div class="allgemein">
                <div id="functionoverview">Allgemein</div>
                <div id="functionfilters">    
		Grobphase:<br> 
                <select name="select_grobphase" id="select_grobphase" data-placeholder="Grobphase-Filter" style="width:465px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["grobphase"]);$i++){
                            
                                $nummer = $i;
                                $inhalt = $model2[1]["grobphase"][$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                            
                                echo '<option value="'.$i.'" id="grobphase'.$i.'" name="grobphase'.$i.'" title="'.$title.'");>'.$nummer.'. '.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>
                    
                <div id="functionfilters">   
		Unterphase:<br> 
                <select name="select_unterphase" id="select_unterphase" data-placeholder="Unterphase-Filter" style="width:465px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["unterphase"]);$i++){
                           
                                $nummer = $i+1;
                                $inhalt = $model2[1]["unterphase"][$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                
                                echo '<option value="'.$i.'" id="unterphase'.$i.'" name="unterphase'.$i.'" title="'.$title.'");>'.$nummer.'.'.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>
                <div id="functionfilters">
		Gesetze:<br>
				<select name="select_gesetze" id="select_gesetze" data-placeholder="Gesetze-Filter" style="width:465px;" multiple="multiple">
				<?php
				for($i=0;$i<count($model2[1]["gesetze"]);$i++){
					echo '<option value="'.($i+1).'" id="gesetze'.$i.'" name="gesetze'.$i.'" >'.$model2[1]["gesetze"][$i]["gesetz"].'</option>';
					}
					?>
				</select><br>
                </div>    
                
                </div>
                    
                <div class="beratung2">
                <div id="functionoverview">Beratung</div>
                <div style="float: left;">    
                <div id="functionfilters">   
		Privat mit Beratung:<br> 
                <select name="select_privmb" id="select_privmb" data-placeholder="Privmb-Filter" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["privmb"]);$i++){
                                    
                                    $inhalt = $model2[1]["privmb"][$i]; 
                                    
                                    if($inhalt == "gesetzFunktion"){
                                        $inhalt = "Gesetz -> Funktion";
                                    }
                                    else if($inhalt == "funktionGesetz"){
                                        $inhalt = "Funktion -> Gesetz";
                                    }
                                    else{
                                        $inhalt = "Keine Abh&auml;ngigkeit";
                                    }  
                            
                                echo '<option value="'.$model2[1]["privmb"][$i].'" id="privmb'.$i.'" name="privmb'.$i.'");>'.$inhalt.'</option>';
			}    
                ?>
                </select><br>
                </div>
                    
                <div id="functionfilters">       
		Professionell mit Beratung:<br> 
                <select name="select_profmb" id="select_profmb" data-placeholder="Profmb-Filter" style="width:165px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["profmb"]);$i++){
                                
                                    $inhalt = $model2[1]["profmb"][$i];    
                                    
                                    if($inhalt == "gesetzFunktion"){
                                        $inhalt = "Gesetz -> Funktion";
                                    }
                                    else if($inhalt == "funktionGesetz"){
                                        $inhalt = "Funktion -> Gesetz";
                                    }
                                    else{
                                        $inhalt = "Keine Abh&auml;ngigkeit";
                                    }
                            
                                echo '<option value="'.$model2[1]["profmb"][$i].'" id="profmb'.$i.'" name="profmb'.$i.'");>'.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>
                    
                <div id="functionfilters" style="margin-bottom: 10px;">       
		Reines Ausf&uuml;hrungsgesch&auml;ft:<br> 
                <select name="select_rausfg" id="select_rausfg" data-placeholder="Rausfg-Filter" style="width:165px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["rausfg"]);$i++){
                           
                                    $inhalt = $model2[1]["rausfg"][$i];   
                                    
                                    if($inhalt == "gesetzFunktion"){
                                        $inhalt = "Gesetz -> Funktion";
                                    }
                                    else if($inhalt == "funktionGesetz"){
                                        $inhalt = "Funktion -> Gesetz";
                                    }
                                    else{
                                        $inhalt = "Keine Abh&auml;ngigkeit";
                                    }
                                    
                                echo '<option value="'.$model2[1]["rausfg"][$i].'" id="rausfg'.$i.'" name="rausfg'.$i.'");>'.$inhalt.'</option>';
                            	
			}    
                ?></select><br>
                </div>
                </div>
                
                <div style="float:left; margin-left: 22px; height: 160px;">
                <div id="functionfilters">   
		Privat ohne Beratung:<br> 
                <select name="select_privob" id="select_privob" data-placeholder="Privob-Filter" style="width:165px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["privob"]);$i++){
                           
                                    $inhalt = $model2[1]["privob"][$i];   
                                    
                                    if($inhalt == "gesetzFunktion"){
                                        $inhalt = "Gesetz -> Funktion";
                                    }
                                    else if($inhalt == "funktionGesetz"){
                                        $inhalt = "Funktion -> Gesetz";
                                    }
                                    else{
                                        $inhalt = "Keine Abh&auml;ngigkeit";
                                    }
                                    
                                echo '<option value="'.$model2[1]["privob"][$i].'" id="privob'.$i.'" name="privob'.$i.'");>'.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>               
                    
                <div id="functionfilters">       
		Professionell ohne Beratung:<br> 
                <select name="select_profob" id="select_profob" data-placeholder="Profob-Filter" style="width:165px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["profob"]);$i++){
                                
                                    $inhalt = $model2[1]["profob"][$i];    
                                    
                                    if($inhalt == "gesetzFunktion"){
                                        $inhalt = "Gesetz -> Funktion";
                                    }
                                    else if($inhalt == "funktionGesetz"){
                                        $inhalt = "Funktion -> Gesetz";
                                    }
                                    else{
                                        $inhalt = "Keine Abh&auml;ngigkeit";
                                    }
                                    
                                echo '<option value="'.$model2[1]["profob"][$i].'" id="profob'.$i.'" name="profob'.$i.'");>'.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>
                </div>
                </div>
                    
                <div class="handlungsspielraum">    
                <div id="functionoverview">Handlungsspielraum</div>  
                <div id="functionfilters" style="float: left;">       
		Handlungsspielraum aktuell:<br> 
                <select name="select_hsra" id="select_hsra" data-placeholder="Hsra-Filter" style="width:165px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["hsra"]);$i++){
                           
                                    $inhalt = $model2[1]["hsra"][$i];    
                                
                                    if($inhalt == "gelb"){
                                        $inhalt = "eingeschränkt";
                                    }
                                    else if($inhalt == "gruen"){
                                        $inhalt = "offen";
                                    }
                                    else{
                                        $inhalt = "zukünftig eingeschränkt";
                                    }
                                    
                                echo '<option value="'.$model2[1]["hsra"][$i].'" id="hsra'.$i.'" name="hsra'.$i.'");>'.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>
                    
                <div id="functionfilters" style="float: left; margin-left: 22px;">       
		Handlungsspielraum zuk&uuml;nftig:<br> 
                <select name="select_hsrz" id="select_hsrz" data-placeholder="Hsrz-Filter" style="width:165px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["hsrz"]);$i++){
                           
                                    $inhalt = $model2[1]["hsrz"][$i];    
                                
                                    if($inhalt == "gelb"){
                                        $inhalt = "eingeschränkt";
                                    }
                                    else if($inhalt == "gruen"){
                                        $inhalt = "offen";
                                    }
                                    else{
                                        $inhalt = "zukünft. eingeschränkter";
                                    }
                                    
                                echo '<option value="'.$model2[1]["hsrz"][$i].'" id="hsrz'.$i.'" name="hsrz'.$i.'");>'.$inhalt.'</option>';
                            	
			}    
                ?>
                </select><br>
                </div>
                </div>
                </div>
                
                    <div style="float: right;">
                <div class="funktionsvergleich">    
                <div id="functionoverview">Funktionsvergleich</div>    
                <div id="functionfilters" style="margin-bottom: 15px;">   
		Funktionsname:<br> 
                <select name="select_name" id="select_name" data-placeholder="Name-Filter" style="width:465px;" multiple="multiple">
                <?php
			for ($i=0;$i<count($model2[1]["name"]);$i++){
                                
                                $inhalt = $model2[1]["name"][$i];
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                    
                                echo '<option value="'.($i+1).'" id="name'.$i.'" name="name'.$i.'" title="'.$title.'");>'.$model2[1]["name"][$i].'</option>';
                            	
			}    
                ?>
                </select><br>  
                </div>
                        </div>
				<input type="hidden" name="form_grobphase" value="">
				<input type="hidden" name="form_unterphase" value="">
				<input type="hidden" name="form_name" value="">
				<input type="hidden" name="form_privmb" value="">
				<input type="hidden" name="form_profmb" value="">
				<input type="hidden" name="form_privob" value="">
				<input type="hidden" name="form_profob" value="">
				<input type="hidden" name="form_rausfg" value="">
				<input type="hidden" name="form_hsra" value="">
				<input type="hidden" name="form_hsrz" value="">
                                <input type="hidden" name="form_gesetze" value=""><br/>                 
                                <div style="float: right; margin-top: 315px; margin-right: 16px;">
				<button class="submit" type="button" name="submitbutton" value="submitbutton" onClick="toInput();"></button>
                        </div>
                                
                </div>                
		</form>

	</div>
</div>
<!-- ENDE --------------------------------------------------------------------->   
    
<!-- VIEWFILTER --------------------------------------------------------------->    
<div style="viewfilter" id="viewfilter" onclick="showdiv('draggable')" href="#" title="anzeigen/verstecken des Filters">
    <div style="view_name" id="view_name"><p>ANZEIGEFILTER</p></div>
</div>
    
<div id="draggable" style="display: none;">
    <div id="dragbutton">ANZEIGEFILTER</div>
    <div id="dragcontent">
		<form name="anzeigefilter" id="anzeigefilter">
		<select id="multiselect" data-placeholder="Anzeigefilter" style="width:350px;" multiple="multiple">
                <?php
                            //Beschreibung
                            echo '<optgroup label="Beschreibung">';            
                            for ($i=3;$i<4;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';
                            
                            //Beratung
                            echo '<optgroup label="Beratung">';            
                            for ($i=4;$i<8;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
							// Reines Ausfuehrungsgeschaeft
							echo '<option value="'.$model5[12].'" id="'.$model5[12].'" name="'.$model5[12].'" title="'.$model6[12].'");>'.$model6[12].'</option>';
                            echo '</optgroup>';
                            
                            //Gesetz
                            echo '<optgroup label="Regulatorien">';            
                            for ($i=8;$i<9;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            
                            //Business Rule
                            $inhalt_br = $model6[45];
                            $title_br = str_replace('"',"&#039;",  shortName($inhalt_br));
                            echo '<option value="'.$model5[45].'" id="'.$model5[45].'" name="'.$model5[45].'" title="'.$title_br.'");>'.$inhalt_br.'</option>';
                            
                            
                            //Auslegung
                            $inhalt_auslegung = $model6[46];
                            $title_auslegung = str_replace('"',"&#039;",  shortName($inhalt_auslegung));
                            echo '<option value="'.$model5[46].'" id="'.$model5[46].'" name="'.$model5[46].'" title="'.$title_auslegung.'");>'.$inhalt_auslegung.'</option>';
                            echo '</optgroup>';
							
                            //Handlungsspielraum
                            echo '<optgroup label="Handlungsspielraum">';            
                            for ($i=10;$i<12;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';
                            
                            //Personenbeteiligung
                            echo '<optgroup label="Personenbeteiligung">';            
                            for ($i=13;$i<21;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';
                            
                            //Funktionskopplung
                            echo '<optgroup label="Funktionskopplung">';            
                            for ($i=22;$i<27;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';
                            echo '<optgroup label="Szenario Filiale">';
                            for ($i=30;$i<35;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';	
                            echo '<optgroup label="Szenario Online">';
                            for ($i=35;$i<40;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';
                            echo '<optgroup label="Szenario Mobil">';
                            for ($i=40;$i<45;$i++){
                                $inhalt = $model6[$i]; 
                                $title = str_replace('"',"&#039;",  shortName($inhalt));
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }
                            echo '</optgroup>';
                              
                ?>
                </select>
		</form>
    </div>
</div>
<!-- ENDE --------------------------------------------------------------------->       
    
<!-- CONTENT MIDDLE ----------------------------------------------------------->       
<div id="contentarea">
    <!-- Anzeige für gesetzte Filter ------------------------------------------>
    <div class="filterlist">
        
                            <?php
				if(isset($leer)){
					echo '<div class="filterlist_inner"><p style="color: #0075B8;">Die Suche ergab keine Ergebnisse.</p></div>';
				}
				if(isset($model3)){

                                if(isset($fil)){
									
                                    if(!empty($model4)){ 
                                        $temp = null;
                                        $model4= str_replace("'", "", $model4);
										$temp = explode(",",$model4);
										
                                        $model4 = null;
                                        for($i=0;$i<count($temp);$i++){
                                            $temp[$i]= '['.$grobphase[$temp[$i]]["grobphase_id"].'] '.$grobphase[$temp[$i]]["name"];
                                            if($i==count($temp)-1){
                                                $model4 .= $temp[$i];
                                            }else{
                                                $model4 .= $temp[$i].', ';
                                            }
                                        }
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">GROBPHASE: '.$model4.'</p></div>';
                                    }
                                   
                                    if(!empty($unterphase)){
                                        $temp = null;
                                        $temp = explode(",",$unterphase);
                                        $unterphase = null;
                                        for($i=0;$i<count($temp);$i++){
                                            $temp[$i]= '['.$unterphase2[$temp[$i]]["unterphase_id"].'] '.$unterphase2[$temp[$i]]["name"];
                                            if($i==count($temp)-1){
                                                $unterphase .= $temp[$i];
                                            }else{
                                                $unterphase .= $temp[$i].', ';
                                            }
					}
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">UNTERPHASE: '.$unterphase.'</p></div>';
                                    }
                                
                                    if(!empty($fil_gesetze)){
                                        $temp = null;
                                        $temp = explode(",",$fil_gesetze);
                                        $fil_gesetze = null;
                                        for($i=0;$i<count($temp);$i++){
                                            $temp[$i]= str_replace("'", "", $temp[$i]);
                                            $temp[$i]= '['.$gesetz2[$temp[$i]-1]["id"].'] '.$gesetz2[$temp[$i]-1]["gesetz"];
                                            if($i==count($temp)-1){
                                                $fil_gesetze .= $temp[$i];
                                            }else{
                                                $fil_gesetze .= $temp[$i].', ';
                                            }
                                        }
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">GESETZ: '.$fil_gesetze.'</p></div>';
                                    }
									
                                    if(!empty($privmb)){
                                        $privmb = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $privmb);
                                        $privmb = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $privmb);
                                        $privmb = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $privmb);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PRIVAT MIT BERATUNG: '.$privmb.'</p></div>';
                                    }

                                    if(!empty($privob)){
                                        $privob = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $privob);
                                        $privob = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $privob);
                                        $privob = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $privob);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PRIVAT OHNE BERATUNG: '.$privob.'</p></div>';
                                    }

                                    if(!empty($profmb)){
                                        $profmb = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $profmb);
                                        $profmb = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $profmb);
                                        $profmb = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $profmb);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PROFESSIONELL OHNE BERATUNG: '.$profmb.'</p></div>';
                                    }

                                    if(!empty($profob)){
                                        $profob = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $profob);
                                        $profob = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $profob);
                                        $profob = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $profob);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PROFESSIONELL MIT BERATUNG: '.$profob.'</p></div>';
                                    }
                                    
                                    if(!empty($rausfg)){
                                        $rausfg = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $rausfg);
                                        $rausfg = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $rausfg);
                                        $rausfg = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $rausfg);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">REINES AUSF&Uuml;HRUNGSGESCHÄFT: '.$rausfg.'</p></div>';
                                    }

                                    if(!empty($hsrz)){
                                        $hsrz = str_replace("'gelb'", " eingeschr&auml;nkt", $hsrz);
                                        $hsrz = str_replace("'gruen'", " offen", $hsrz);
                                        $hsrz = str_replace("'gelbHoch'", " zuk&uuml;nft. eingeschr&auml;nkter", $hsrz);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">HANDLUNGSSPIELRAUM ZUK&Uuml;NFTIG: '.$hsrz.'</p></div>';
                                    }
                                    
                                    if($hsra){
                                        $hsra = str_replace("'gelb'", " eingeschr&auml;nkt", $hsra);
                                        $hsra = str_replace("'gruen'", " offen", $hsra);
                                        $hsra = str_replace("'gelbHoch'", " zuk&uuml;nft. eingeschr&auml;nkter", $hsra);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">HANDLUNGSSPIELRAUM AKTUELL: '.$hsra.'</p></div>';
                                    }
                                   
                                }//if(isset($fil)
				}//if(isset($model3)
                          ?>
    </div>
    
<!-- ACCORDION ---------------------------------------------------------------->    
<div id="multiAccordion">
   <?php
    if(isset($model3) && $model3[0]["id"]!="leer"){
	for($i=0;$i<count($model3);$i++){
            
            $fktNr = $model3[$i]["nummer"];
            $fktName = $model3[$i]["name"];
            $fktNrName = '['.$fktNr.'] '.$fktName;
            $fktNrName_short = substr($fktNrName , 0 , 95 );
            $title = str_replace('"',"&#039;",  shortName2($fktNrName));
            $fktNameLaenge = mb_strlen($fktNrName);
            if($fktNameLaenge > 90){
                $fktNrName = substr($fktNrName, 0 , 90);
                $fktNrName .= "...";
            }
            
            $phaseName = $grobphase[$model3[$i]["grobphase_id"]]["name"];
            $phaseNr = $grobphase[$model3[$i]["grobphase_id"]]["grobphase_id"];
            $phaseNrName = $phaseNr.'. '.$phaseName;
            
            $uphaseNr = $model3[$i]["unterphase_id"];
            if($uphaseNr==12){$uphaseNr=11;}//Fehler
            $uphaseName = $unterphase2[$uphaseNr]["name"];
            
            $sprungstelle = $sprungstellenArr[$i];
            $funktionsfolge = $funktionsfolgenArr[$i];

            $kanalwechsel = $model3[$i]["kanalwechsel"];
            
            $fktGesetze ="";
            
            //Gesetze pro Funktion
            for($k=0;$k<count($gesetze[$i]);$k++){	
                $fktGesetze .=($k+1).'. '.$gesetze[$i][$k]["gesetz"].'<br/>';
            }
            //keine Unterphase = X
            if($uphaseNr==0){
                $uphaseNr="X";
                $uphaseName="keine Unterphase";
            }
            
            //Ausgabe Accordion_________________________________________________
            echo 
            '<h3>
                <div>
                    <div id="'.$fktNr.'" class="detail_button" title="Detailansicht der Funktion">
                    </div>';
                    
                    if($fktGesetze == null){
                        echo '<div class="gesetz_button_null" title="Gesetze" ></div>';
                    }else{
                        echo '<div data-gesetze="'.$fktGesetze.'" id="'.$fktNr.'" name="'.$fktNrName_short.'" class="gesetz_button" title="Gesetze" onClick="popUp();"></div>';
                    }
            
                    if($sprungstelle == null){
                        echo '<div class="spruenge_button_null" title="Sprungstellen" ></div>';
                    }else{
                        echo '<div data-sprungstelle="'.$sprungstelle.'"  id="'.$fktNr.'" name="'.$fktNrName_short.'" class="spruenge_button" title="Sprungstellen" onClick="popUp2();"></div>';
                    }
                    
                    if($funktionsfolge == null){
                        echo '<div class="folge_button_null" title="Funktionsfolge" ></div>';
                    }else{
                        echo '<div data-folge="'.$funktionsfolge.'" id="'.$fktNr.'" name="'.$fktNrName_short.'" class="folge_button" title="Funktionsfolge" onClick="popUp3();"></div>';
                    }
                    
                    if($kanalwechsel == null){
                        echo '<div class="kanal_button_null" title="Kanalwechsel" ></div>';
                    }else{
                        echo '<div data-kanal="" id="'.$fktNr.'" name="'.$fktNrName_short.'" class="kanal_button" title="'.$kanalwechsel.'"></div>';
                    }
                   
                    echo '
                    <div style="float: left; margin-left: 75px; font-size: 13px;" title="'.$title.'">'.$fktNrName.'</div>
                    <div id="unterphaseR" title="Unterphase: '.$uphaseName.'">['.$uphaseNr.']</div>                    
                    <div id="grobphaseR" title="Grobphase-Nr. Grobphase-Name">'.$phaseNrName.'&nbsp;</div>
                    
                </div>
            </h3>
                    
             <div style="height: 200px; overflow-y: hidden;">
                <div id="'.$i.'" style="10000px">';

			for($j=0;$j<count($model5);$j++){
                            $key = $model5[$j];
                            $spaName = $model6[$j];
                            $spaInhalt = $model3[$i][$key];
                            $style = "";
                            $style1= " style='width: 52px; overflow: hidden;'";
                            
                            //Grafik Abfragen
                            if($j<45){
                            if($spaInhalt == "gesetzFunktion"){
                                $spaInhalt = "<img title='Funktion bedingt durch Gesetz' src='/FBFinal/css/images/pfeile/gesetzFunktion.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "funktionGesetz"){
                                $spaInhalt = "<img title='Gesetz bedingt durch Funktion'src='/FBFinal/css/images/pfeile/funktionGesetz.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "keine Abhängig"){                              
                                $spaInhalt = "<img title='Keine Regularien' src='/FBFinal/css/images/pfeile/null.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "gelb"){
                                $spaInhalt = "<img title='Geringer Handlungsspielraum' src='/FBFinal/css/images/pfeile/gelb.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "gruen"){
                                $spaInhalt = "<img title='Normaler Handlungsspielraum' src='/FBFinal/css/images/pfeile/gruen.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }
                            else if($spaInhalt == "gelbHoch"){
                                $spaInhalt = "<img title='Handlungsspielraum zukünftig weiter eingeschränkt' src='/FBFinal/css/images/pfeile/gelbHoch.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaName == "Filiale Minimum Dauer" || $spaName == "Filiale Empfehlung Dauer" || $spaName == "Online Minimum Dauer" || $spaName == "Online Empfehlung Dauer" || $spaName == "Mobil Minimum Dauer" || $spaName == "Mobil Empfehlung Dauer"){
                                $spaInhalt .= ' min';
                                $style = $style1;
                            }
                            }
                            
                            //Ausgabe Inhalt pro Accordion______________________
                            
                            echo '
                                <li class="'.$key.'" id="'.$key.'" style="display: none;">
                                    <div class="toggler" id="toggle'.$j.'"><p class="spalte_fct">'.$spaName.'</p></div>
                                    <div class="toggle toggle'.$j.'_content" id="toggle'.$j.'_content"'.$style.'><span>'.$spaInhalt.'</span></div>
                                </li>
                            ';
                            
			}

            echo '
                <noscript>
                    <p>Please enable JavaScript to get the full experience.</p>
                </noscript>
              </div>
            </div>';
        }
    
    }?>
   
</div>
<!-- ACCORDION ENDE ----------------------------------------------------------->   




<!-- Scripte ------------------------------------------------------------------>

<!-- DETAIL-BUTTON ------------------------------------------------------------>   
<?php if(isset($model3) && $model3[0]["id"]!="leer"){?>
<script type="text/javascript"> 
    
     //Funktion, um zur Detailansicht zu springen
     function openDetail(fktNr){
        
        var link = 'http://localhost/FBFinal/index.php?r=site/details&fktNr='+fktNr;
        
        //Testen auf IE
        if(-[1,]){
            window.open(link);
        }else{
            window.open(link, '_blank, resize=yes, scrollbars=yes, fullscreen=yes', 'height='+screen.height,'width='+screen.width);
        }
        
        return false;
     }
     
</script>

<!-- Popups ------------------------------------------------------------------->
<script type="text/javascript">
    
    //Detail Button
    $('.detail_button').click(
            function open(){
                document.body.style.cursor="progress";
                openDetail(this.id);
                document.body.style.cursor="default";
                return false;
            })
            
    //Gesetz Popup
    $('.gesetz_button').click(

            function popUp(){
                
                //if(getElementByID('popup_' + popupID)){
                var fktName = this.attributes["name"].value;
                var gesetze = this.attributes["data-gesetze"].value;
                var popupID = this.id;
                
                var popup = document.createElement('div');
                popup.className = 'popupGesetze';
                popup.id = 'popup_' + popupID;
                var cancel = document.createElement('div');
                cancel.className = 'cancel';
                cancel.innerHTML = 'close';
                cancel.onclick = function (e) { popup.parentNode.removeChild(popup) };
                var gesetzTop = document.createElement('div');
                gesetzTop.className = 'gesetzeTop';
                gesetzTop.innerHTML = fktName;
                var gesetzContent = document.createElement('div');
                gesetzContent.className = 'gesetzeContent';
                gesetzContent.innerHTML = gesetze;
                popup.appendChild(cancel);
                popup.appendChild(gesetzTop);
                popup.appendChild(gesetzContent);                                    
                document.body.appendChild(popup);
                
                $('#popup_' + popupID).draggable();
                //}
                return false;
     });

     //Funktionssprünge Popup
     $('.spruenge_button').click(
            
            function popUp2(){
                
                var funktionsName = this.attributes["name"].value;
                var spruenge = this.attributes["data-sprungstelle"].value;
                var popupID = this.id;
                
                var ausgabe = "";
                var fktArr = spruenge.split(",,");
                var i=0;
                while(i<fktArr.length){
                  var fktName = fktArr[i];
                  var temp = fktName.substring(1,5);
                  var fktNr = temp.replace(/\D+/g,"");
                  i++;
                  ausgabe += '<div id="'+fktNr+'" class="popupLink" onclick="openDetail('+fktNr+')">'+fktName+'</div>';
                }
                
                var popup = document.createElement('div');
                popup.className = 'popupSpruenge';
                popup.id = 'popup_2' + popupID;
                var cancel = document.createElement('div');
                cancel.className = 'cancel';
                cancel.innerHTML = 'close';
                cancel.onclick = function (e) { popup.parentNode.removeChild(popup) };
                var sprungTop = document.createElement('div');
                sprungTop.className = 'spruengeTop';
                sprungTop.innerHTML = funktionsName;
                var sprungContent = document.createElement('div');
                sprungContent.className = 'spruengeContent';
                sprungContent.innerHTML = ausgabe;
                
                popup.appendChild(cancel);
                popup.appendChild(sprungTop);
                popup.appendChild(sprungContent);                                    
                document.body.appendChild(popup);
                
                $('#popup_2' + popupID).draggable();
                
                return false;
     });
     
     //Funktionsfolgen Popup
     $('.folge_button').click(
            
            function popUp3(){
                
                var funktionsName = this.attributes["name"].value;
                var folge = this.attributes["data-folge"].value;
                var popupID = this.id;
                
                var ausgabe = "";
                var fktArr = folge.split(",,");
                var i=0;
                while(i<fktArr.length){
                  var fktName = fktArr[i];
                  var temp = fktName.substring(1,5);
                  var fktNr = temp.replace(/\D+/g,"");
                  i++;
                  ausgabe += '<div id="'+fktNr+'" class="popupLink" onclick="openDetail('+fktNr+')">'+fktName+'</div>';
                }
                
                var popup = document.createElement('div');
                popup.className = 'popupFolge';
                popup.id = 'popup_3' + popupID;
                var cancel = document.createElement('div');
                cancel.className = 'cancel';
                cancel.innerHTML = 'close';
                cancel.onclick = function (e) { popup.parentNode.removeChild(popup) };
                var folgeTop = document.createElement('div');
                folgeTop.className = 'folgeTop';
                folgeTop.innerHTML = funktionsName;
                var folgeContent = document.createElement('div');
                folgeContent.className = 'folgeContent';
                folgeContent.innerHTML = ausgabe;
                popup.appendChild(cancel);
                popup.appendChild(folgeTop);
                popup.appendChild(folgeContent);                                  
                document.body.appendChild(popup);
                
                $('#popup_3' + popupID).draggable();
                
                return false;
     });
     
</script>
<?php } ?>

<!-- FUNKTIONSFILTER SHOW/HIDE ------------------------------------------------>   
<script type="text/javascript"> 
    var State1 = 'function';
    var State2 = State1 + ' functionhover';
    var div = document.getElementById("function");

    function togglestate(){
        if (div.className == State1){
            div.className = State2;
        } else {
            div.className = State1;
        }
    }
 
</script>  

<!-- ANZEIGEFILTER SHOW/HIDE -------------------------------------------------->   
<script type="text/javascript"> 
    function showdiv(id){
        
        var current_vis = document.getElementById(id).style.display;
        
        if(current_vis != "none"){
            document.getElementById(id).style.display = "none";
        }
        else{
            document.getElementById(id).style.display = "block";
        }
        showdiv.stopPropagation();
    }
</script>  

<!-- MULTISELECT -------------------------------------------------------------->   
<script type="text/javascript"> 
	function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    alert(out);
	}
    $("#multiselect").multiselect({
        header: false,
        height: 500,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'Wählen Sie Ihre Spalten',
		optgrouptoggle: function(event, ui){
		var values = $.map(ui.inputs, function(checkbox){
         return checkbox.value;
		}).join(", ");
		var val = values.split(", ");
		//dump(val);
		for(var i=0;i<val.length;i++){
			val[i]= '.'+val[i];
			//alert(val[i]);
			if($(val[i]).is(':visible')){
				$(val[i]).css('display','none');
			}
			else{
				$(val[i]).css('display','block');
			}
		}
		}
    });

    $("#multiselect").bind("multiselectclick", function(event, ui){
        
        var value = ui.value;
		
        var val = '.'+value;

        if($(val).is(':visible')){
            $(val).css('display','none');
        }
        else{
            $(val).css('display','block');
        }
    });
    $("#multiselect").bind("optgrouptoggle", function(event, ui){
	alert ("jojo");
        var values = $.map(ui.inputs, function(checkbox){
         for(var i=0;i<values.length;i++){
			var val = '.'+values[i];
			alert(val);
			if($(val).is(':visible')){
				$(val).css('display','none');
			}
        else{
            $(val).css('display','block');
			}
		}
		}
    )});
    $("#select_grobphase").multiselect({
        selectedText: "# von # ausgewählt",
        height: 344,
        noneSelectedText: 'Wählen Sie Ihre Grobphase(n)'
    });
	$("#select_grobphase").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
	$("#select_unterphase").multiselect({
        selectedText: "# von # ausgewählt",
        height: 345,
        noneSelectedText: 'Wählen Sie Ihre Unterphase(n)'
    });
	$("#select_unterphase").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});	
	$("#select_unterphase").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});	
		$("#select_gesetze").multiselect({
        selectedText: "# von # ausgewählt",
        height: 345,
        noneSelectedText: 'Wählen Sie Ihr(e) Gesetz(e)'
    });
	$("#select_gesetze").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
	$("#select_name").multiselect({
        selectedText: "# von # ausgewählt",
        height: 295,
        noneSelectedText: 'Wählen Sie Ihre Funktion(en)'
    });
	$("#select_name").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
	$("#select_privmb").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'        
    });
	$("#select_privmb").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});	
	$("#select_profmb").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'
        
    });
	$("#select_profmb").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});	
	$("#select_privob").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'
    });
	$("#select_privob").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});	
	$("#select_profob").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'
    });
	$("#select_profob").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
	$("#select_rausfg").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'
    });
	$("#select_rausfg").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
	$("#select_hsra").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'
    });
	$("#select_hsra").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
	$("#select_hsrz").multiselect({
        header: false,
        height: 85,
        selectedText: "# von # ausgewählt",
        noneSelectedText: 'auswählen'
    });
	$("#select_hsrz").bind("multiselectclick", function(event, ui){
		
		var value = ui.value;
		});
		
</script>        

<!-- ACCORDION INHALT --------------------------------------------------------->   
<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function() {
        $('.toggle').hide();
        $('.toggler').click( function() {
          var target = this.id + '_content';
          $('.' + target).toggle();
        });
        $('#toggle_everything').click( function() { $('.toggle').toggle(); });
    });
    //]]>
</script>        

<!-- ACCORDION ---------------------------------------------------------------->   
<script type="text/javascript">
	$(function(){
		$('#multiAccordion').multiAccordion();
	});
</script>

<script>
    $( "#accordion" ).accordion({ heightStyle: "content", collapsible: true });
</script>

<script> 
    function toInput(){
                        document.body.style.cursor="progress";
			//Zuweisung der Select-Input in Hidden-Textfields
			var bufferGrobphase = "";
			var bufferUnterphase ="";
			var bufferName ="";
			var bufferPrivMB ="";
			var bufferProfMB ="";
			var bufferPrivOB ="";
			var bufferProfOB ="";
			var bufferRausfg ="";
			var bufferHsra ="";
			var bufferHsrz ="";
			var bufferGesetze ="";
			var len=document.neu_form.select_grobphase.options.length;
			var len2=document.neu_form.select_unterphase.options.length;
			var len3=document.neu_form.select_name.options.length;
			var len4=document.neu_form.select_profmb.options.length;
			var len5=document.neu_form.select_hsra.options.length;
			var len6=document.neu_form.select_hsrz.options.length;
			var len7=document.neu_form.select_gesetze.options.length;
			var j=0;
                        
			for (var i=0; i<len; i++)
			{
				if (document.neu_form.select_grobphase.options[i].selected && j==0){
                                    bufferGrobphase = bufferGrobphase + "'" + document.neu_form.select_grobphase.options[i].value + "'";
									j++;
				}
                                else if (document.neu_form.select_grobphase.options[i].selected && j!=0){
                                    bufferGrobphase = bufferGrobphase +"," +"'" + document.neu_form.select_grobphase.options[i].value + "'";
				}
			}
			j=0;
			//alert("hoho");
			for (var i=0; i<len2; i++)
			{
				if (document.neu_form.select_unterphase.options[i].selected && j==0){
                                    bufferUnterphase = bufferUnterphase +document.neu_form.select_unterphase.options[i].value;
                                    j++;
				}
                                else if (document.neu_form.select_unterphase.options[i].selected && j!=0){
                                    bufferUnterphase = bufferUnterphase +","+document.neu_form.select_unterphase.options[i].value;
				}
			}
			//alert("hehe");
			j=0;
			for (var i=0; i<len3; i++)
			{
				if (document.neu_form.select_name.options[i].selected && j==0){
                                    bufferName = bufferName +document.neu_form.select_name.options[i].value;
                                    j++;
				}
                                else if (document.neu_form.select_name.options[i].selected && j!=0){
                                    bufferName = bufferName +","+document.neu_form.select_name.options[i].value;
				}
			}
			j=0;
			for (var i=0; i<len4; i++)
			{
				if (document.neu_form.select_privmb.options[i].selected && j==0){
                                    bufferPrivMB = bufferPrivMB +"'"+document.neu_form.select_privmb.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_privmb.options[i].selected && j!=0){
                                    bufferPrivMB = bufferPrivMB +","+"'"+document.neu_form.select_privmb.options[i].value+"'";
				}
			}
			
			j=0;
			for (var i=0; i<len4; i++)
			{
				if (document.neu_form.select_profmb.options[i].selected && j==0){
                                    bufferProfMB = bufferProfMB +"'"+document.neu_form.select_profmb.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_profmb.options[i].selected && j!=0){
                                    bufferProfMB = bufferProfMB +","+"'"+document.neu_form.select_profmb.options[i].value+"'";
				}
			}
			j=0;
			for (var i=0; i<len4; i++)
			{
				if (document.neu_form.select_privob.options[i].selected && j==0){
                                    bufferPrivOB = bufferPrivOB +"'"+document.neu_form.select_privob.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_privob.options[i].selected && j!=0){
                                    bufferPrivOB = bufferPrivOB +","+"'"+document.neu_form.select_privob.options[i].value+"'";
				}
			}
			j=0;
			for (var i=0; i<len4; i++)
			{
				if (document.neu_form.select_profob.options[i].selected && j==0){
                                    bufferProfOB = bufferProfOB +"'"+document.neu_form.select_profob.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_profob.options[i].selected && j!=0){
                                    bufferProfOB = bufferProfOB +","+"'"+document.neu_form.select_profob.options[i].value+"'";
				}
			}
			j=0;
			for (var i=0; i<len4; i++)
			{
				if (document.neu_form.select_rausfg.options[i].selected && j==0){
                                    bufferRausfg = bufferRausfg +"'"+document.neu_form.select_rausfg.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_rausfg.options[i].selected && j!=0){
                                    bufferRausfg = bufferRausfg +","+"'"+document.neu_form.select_rausfg.options[i].value+"'";
				}
			}
			j=0;
			for (var i=0; i<len5; i++)
			{
				if (document.neu_form.select_hsra.options[i].selected && j==0){
                                    bufferHsra = bufferHsra +"'"+document.neu_form.select_hsra.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_hsra.options[i].selected && j!=0){
                                    bufferHsra = bufferHsra +","+"'"+document.neu_form.select_hsra.options[i].value+"'";
				}
			}
			j=0;
			for (var i=0; i<len6; i++)
			{
				if (document.neu_form.select_hsrz.options[i].selected && j==0){
                                    bufferHsrz = bufferHsrz +"'"+document.neu_form.select_hsrz.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_hsrz.options[i].selected && j!=0){
                                    bufferHsrz = bufferHsrz +","+"'"+document.neu_form.select_hsrz.options[i].value+"'";
				}
			}
			for (var i=0; i<len7; i++)
			{
				if (document.neu_form.select_gesetze.options[i].selected && j==0){
                                    bufferGesetze = bufferGesetze +"'"+document.neu_form.select_gesetze.options[i].value+"'";
                                    j++;
				}
                                else if (document.neu_form.select_gesetze.options[i].selected && j!=0){
                                    bufferGesetze = bufferGesetze +","+"'"+document.neu_form.select_gesetze.options[i].value+"'";
				}
			}
			document.neu_form.form_grobphase.value= bufferGrobphase;
			document.neu_form.form_unterphase.value= bufferUnterphase;
			document.neu_form.form_name.value= bufferName;
			document.neu_form.form_privmb.value= bufferPrivMB;
			document.neu_form.form_profmb.value= bufferProfMB;
			document.neu_form.form_privob.value= bufferPrivOB;
			document.neu_form.form_profob.value= bufferProfOB;
			document.neu_form.form_rausfg.value=bufferRausfg;
			document.neu_form.form_hsra.value=bufferHsra;
			document.neu_form.form_hsrz.value=bufferHsrz;
			document.neu_form.form_gesetze.value=bufferGesetze;
			document.neu_form.submit();
                        document.body.style.cursor="default";
                        
	}
</script>

</body>

	
</html>
<?php }
?>