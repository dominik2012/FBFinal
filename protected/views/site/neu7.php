<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>accordion demo</title>
    
    <link rel="stylesheet" href="/finanzberatung/jquery-multi/css/jquery-ui-1.8.9.custom/jquery-ui-1.8.9.custom.css">
    <link rel="stylesheet" href="/finanzberatung/multiselect/jquery.multiselect.css">
    <script src="/finanzberatung/jquery-ui/js/jquery-1.8.2.js"></script>
    <script src="/finanzberatung/jquery-ui/js/jquery-ui-1.9.0.custom.js"></script>
    <script src="/finanzberatung/jquery-multi/jquery.multi-accordion-1.5.3.js"></script>
    <script src="/finanzberatung/multiselect/src/jquery.multiselect.js"></script>
    
    <link rel="stylesheet" href="/finanzberatung/chosen-master/chosen/chosen.css">
    <script src="/finanzberatung/chosen-master/chosen/chosen.jquery.js"></script>
    
    <script type="text/javascript">
    //VIEWFILTER
    $(function() {
        $("#draggable").draggable();
        $("#popup").draggable();
    });
    
    //Funktion ruft alle Funktionen ab
    function start(){
        document.forms["neu_form"].submit();
    }
    </script>
    

</head>
<!----------------------------------------------------------------------------->   
<body>
    
<!-- FUNKTIONSFILTER ---------------------------------------------------------->   
<div style="function" id="function" class="function" >
    <div style="function_name" id="function_name"  title="anzeigen/verstecken des Filters" onclick="togglestate();"><p>FUNKTIONSFILTER</p></div>

    <div class="form">
	
		<form name="neu_form" id="neu_form" action="/Finanzberatung/index.php?r=site/neu" method="POST">
		
                <div style="margin-bottom: 10px;">
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
                    
                <div style="margin-bottom: 10px; height: 160px;">
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
                    
                <div style="margin-bottom: 10px; height: 80px;">    
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
                    
                <div style="margin-bottom: 10px;">    
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
                                <div style="float: right; margin-top: -77px; margin-right: 30px;">
				<button class="submit" type="button" name="submitbutton" value="submitbutton" onClick="toInput();"></button>
                                </div>
                                
                                
		</form>
		
	
		<?php /* $form = $this->beginWidget('CActiveForm', array(
			'id'=>'neu-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
			'validateOnSubmit'=>true,
                        ),
                )); */?>

		<?php // echo $form->errorSummary($model2[0]["filter"]); ?>

	<!--	<div class="row">
			<?php //echo "Grobphasen: ".$form->dropDownList($model2[0]["filter"],'grobphase_id',$model2[1]["grobphase"],array('separator'=>'','template'=>'<li style="display:inline; padding-left:10px;">{label}{input}</li>',)); 
                        ?>
		</div>
		
		<div class="row buttons">
		<?php //echo CHtml::submitButton('Submit'); ?>
		</div> -->

		<?php //$this->endWidget(); ?>
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
                        //alter Code Viewfilter
			/*for ($i=0;$i<count($model5);$i++){
                            
                            $inhalt = $model6[$i]; 
                            $title = str_replace('"',"&#039;",  shortName($inhalt));
                            
                            //Aussortieren von unnötigen Spalten
                            if($model6[$i] == "ID" || $model6[$i] == "Nummer" || $model6[$i] == "Name" || $model6[$i] == "Unterphase" || $model6[$i] == "Grobphase"){
                                //do nothing
                            }else{
                                echo '<option value="'.$model5[$i].'" id="'.$model5[$i].'" name="'.$model5[$i].'" title="'.$title.'");>'.$inhalt.'</option>';
                            }*/
                            
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
                            $inhalt_br = $model6[45];
                            $title_br = str_replace('"',"&#039;",  shortName($inhalt_br));
                            echo '<option value="'.$model5[45].'" id="'.$model5[45].'" name="'.$model5[45].'" title="'.$title_br.'");>'.$inhalt_br.'</option>';
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
                            for ($i=13;$i<22;$i++){
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
                            
                            //}    
                ?>
                </select>
		</form>
    </div>
</div>
<!-- ENDE --------------------------------------------------------------------->       
    
<!-- CONTENT MIDDLE ----------------------------------------------------------->       
<div id="contentarea">
    <!-- Filterleiste mit Anzeige für gefilterte Phasen -->
    <div class="filterlist">
        
                            <?php
                                //Grobphase
								if(isset($leer)){
									echo '<div class="filterlist_inner"><p style="color: #0075B8;">Die Suche ergab keine Ergebnisse.</p></div>';
									}
							if(isset($model3)){
                                /*
								$gp_count = count($grobphase);
                                $grobphase_full = "";
                                for($i=0;$i<$gp_count;$i++){
                                    if($i==$gp_count-1){
                                        $grobphase_full .= $i;
                                    }else{
                                        $grobphase_full .= $i.',';
                                    }
                                }
                                
                                //Unterphase
                                $up_count = count($unterphase2);
                                $unterphase_full = null;
                                for($i=0;$i<$up_count;$i++){
                                    if($i==$up_count-1){
                                        $unterphase_full .= $i;
                                    }else{
                                        $unterphase_full .= $i.',';
                                    }
                                }
								*/
                                /*
                                //Funktion (Fehler)
                                $fkt_count = count($model3);
                                $fkt_full = null;
                                for($i=0;$i<$fkt_count;$i++){
                                    if($i==$fkt_count-1){
                                        $fkt_full .= $i.',105,106,107';
                                    }else{
                                        $fkt_full .= $i.',';
                                    }
                                }
                                 
                                
                                //Gesetze
                                $gesetz_count = count($gesetze);
                                $gesetz_full = null;
                                for($i=0;$i<$gesetz_count;$i++){
                                    if($i==$gesetz_count-1){
                                        $gesetz_full .= $i;
                                    }else{
                                        $gesetz_full .= $i.',';
                                    }
                                }*/
                                
                                //PRIVMB
								/*
                                $privmb_count = count($model3);
                                $privmb_full = null;
                                for($i=0;$i<$privmb_count;$i++){
                                    if($i==$privmb_count-1){
                                        $privmb_full .= $i;
                                    }else{
                                        $privmb_full .= $i.',';
                                    }
                                }
                                */
                            ?>
        
                            <?php 
								
                                if(isset($fil)){
									echo $fil;
									/*
                                    if($model4 == $grobphase_full){ 
                                    }else{
                                        $temp = null;
                                        $temp = explode(",",$model4);
                                        $model4 = null;
                                        for($i=0;$i<count($temp);$i++){
                                            $temp[$i]= '['.$grobphase[$temp[$i]]["grobphase_id"].'] '.$grobphase[$temp[$i]]["name"];
                                            if($i==count($temp)-1){
                                                $model4 .= $temp[$i];
                                            }else{
                                                $model4 .= $temp[$i].', ';
                                            }
                                        }*/
										if(!empty($model4)){
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">GROBPHASE: '.$model4.'</p></div>';
										}
                                    //}
                                   
                                }
                                if(isset($fil)){
                                   /* if($unterphase == $unterphase_full){
                                    }else{
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
                                        } */
										if(!empty($unterphase)){
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">UNTERPHASE: '.$unterphase.'</p></div>';
										}
                                    //}
                                   
                                }
                                
                                if(isset($fil)){
                                    /*if($fil_gesetze == null){
                                    }else{
                                        $temp = null;
                                        $temp = explode(",",$fil_gesetze);
                                        $fil_gesetze = null;
                                        for($i=0;$i<count($temp);$i++){
                                           // $temp[$i]= '['.$gesetz2[$temp[$i]]["id"].'] '.$gesetz2[$temp[$i]]["gesetz"];
                                            if($i==count($temp)-1){
                                                $fil_gesetze .= $temp[$i];
                                            }else{
                                                $fil_gesetze .= $temp[$i].', ';
                                            }
                                        }*/
										if(!empty($fil_gesetze)){
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">GESETZ: '.$fil_gesetze.'</p></div>';
										}
                                    //}
                                   
                                }/*
                                if(isset($fil)){
                                    if($name == $fkt_full){
                                    }else{
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">FUNKTION: </p></div>';
                                    }
                                   
                                }*/
                                if(isset($fil)){
                                    if($privmb == "'gesetzFunktion','keine Abhängig','funktionGesetz'"){
                                    }else{
                                        $privmb = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $privmb);
                                        $privmb = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $privmb);
                                        $privmb = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $privmb);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PRIVAT MIT BERATUNG: '.$privmb.'</p></div>';
                                    }
                                   
                                }
                                if(isset($fil)){
                                    if($privob == "'gesetzFunktion','keine Abhängig','funktionGesetz'"){
                                    }else{
                                        $privob = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $privob);
                                        $privob = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $privob);
                                        $privob = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $privob);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PRIVAT OHNE BERATUNG: '.$privob.'</p></div>';
                                    }
                                   
                                }
                                if(isset($fil)){
                                    if($profmb == "'gesetzFunktion','keine Abhängig','funktionGesetz'"){
                                    }else{
                                        $profmb = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $profmb);
                                        $profmb = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $profmb);
                                        $profmb = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $profmb);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PROFESSIONELL OHNE BERATUNG: '.$profmb.'</p></div>';
                                    }
                                   
                                }
                                if(isset($fil)){
                                    if($profob == "'gesetzFunktion','keine Abhängig','funktionGesetz'"){
                                    }else{
                                        $profob = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $profob);
                                        $profob = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $profob);
                                        $profob = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $profob);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">PROFESSIONELL MIT BERATUNG: '.$profob.'</p></div>';
                                    }
                                   
                                }
                                if(isset($fil)){
                                    if($rausfg == "'gesetzFunktion','keine Abhängig','funktionGesetz'"){
                                    }else{
                                        $rausfg = str_replace("'gesetzFunktion'", " Gesetz -> Funktion", $rausfg);
                                        $rausfg = str_replace("'keine Abhängig'", " Keine Abh&auml;ngigkeit", $rausfg);
                                        $rausfg = str_replace("'funktionGesetz'", " Funktion -> Gesetz", $rausfg);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">REINES AUSF&Uuml;HRUNGSGESCHÄFT: '.$rausfg.'</p></div>';
                                    }
                                   
                                }
                                if(isset($fil)){
                                    if($hsrz == "'gelb','gruen','gelbHoch'"){
                                    }else{
                                        $hsrz = str_replace("'gelb'", " eingeschr&auml;nkt", $hsrz);
                                        $hsrz = str_replace("'gruen'", " offen", $hsrz);
                                        $hsrz = str_replace("'gelbHoch'", " zuk&uuml;nft. eingeschr&auml;nkter", $hsrz);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">HANDLUNGSSPIELRAUM ZUK&Uuml;NFTIG: '.$hsrz.'</p></div>';
                                    }
                                   
                                }
                                if(isset($fil)){
                                    if($hsra == "'gruen','gelb'"){
                                    }else{
                                        $hsra = str_replace("'gelb'", " eingeschr&auml;nkt", $hsra);
                                        $hsra = str_replace("'gruen'", " offen", $hsra);
                                        $hsra = str_replace("'gelbHoch'", " zuk&uuml;nft. eingeschr&auml;nkter", $hsra);
                                        echo '<div class="filterlist_inner"><p style="color: #0075B8;">HANDLUNGSSPIELRAUM AKTUELL: '.$hsra.'</p></div>';
                                    }
                                   
                                }
								}
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
            $uphaseName = $unterphase2[$uphaseNr]["name"];
            
            $sprungstelle = $sprungstellenArr[$i];
            //echo $sprungstelle;
            //$sprungstelle = $model3[$i]["sprungstelle"];
            
            $funktionsfolge = $funktionsfolgenArr[$i];
            //$funktionsfolge = $model3[$i]["funktionsfolge"];
            
            $kanalwechsel = $model3[$i]["kanalwechsel"];
            
            $fktGesetze ="";
			for($k=0;$k<count($gesetze[$i]);$k++){
			
            $fktGesetze .=($k+1).'. '.$gesetze[$i][$k]["gesetz"].'<br/>'; //TESTING
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
                        <form id="detailForm" name="detailForm" method="GET" action="/Finanzberatung/index.php?r=site/details">
                            <input type="hidden" name="fktNr" id="fktNr" value="'.$fktNr.'">
                        </form>
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
                                $spaInhalt = "<img title='Funktion bedingt durch Gesetz' src='/Finanzberatung/css/images/pfeile/gesetzFunktion.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "funktionGesetz"){
                                $spaInhalt = "<img title='Gesetz bedingt durch Funktion'src='/Finanzberatung/css/images/pfeile/funktionGesetz.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "keine Abhängig"){
                               if($spaName == "Privat mit Beratung" || $spaName == "Privat ohne Beratung" || $spaName == "Professionell mit Beratung" || $spaName == "Professionell ohne Beratung" || $spaName == "Reines Ausfuehrungsgeschaeft")
                                $spaInhalt = "<img title='Keine Regularien' src='/Finanzberatung/css/images/pfeile/null.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "gelb"){
                                $spaInhalt = "<img title='Geringer Handlungsspielraum' src='/Finanzberatung/css/images/pfeile/gelb.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }else if($spaInhalt == "gruen"){
                                $spaInhalt = "<img title='Normaler Handlungsspielraum' src='/Finanzberatung/css/images/pfeile/gruen.png' style='padding-top: 70px;'>";
                                $style = $style1;
                            }
                            else if($spaInhalt == "gelbHoch"){
                                $spaInhalt = "<img title='Handlungsspielraum zukünftig weiter eingeschränkt' src='/Finanzberatung/css/images/pfeile/gelbHoch.png' style='padding-top: 70px;'>";
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

<!-- Scripte ------------------------------------------------------------------>

<!-- DETAIL-BUTTON ------------------------------------------------------------>   
<?php if(isset($model3) && $model3[0]["id"]!="leer"){?>
<script type="text/javascript"> 
  $(document).ready(function() {               
        $('.detail_button').click( function(ev) {
          
          var fktNr = this.id;
          
          ev.preventDefault();
          window.open('http://localhost/Finanzberatung/index.php?r=site/details&fktNr='+fktNr, 'Continue to Application');
          
          return false;
        });
  });
</script>

<script type="text/javascript">
    $('.gesetz_button').click(
            
        
            function popUp(){
                
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
                
                return false;
     });
     
     $('.spruenge_button').click(
            
        
            function popUp2(){
                
                var funktionsName = this.attributes["name"].value;
                var spruenge = this.attributes["data-sprungstelle"].value;
                var popupID = this.id;
                
                //alert($(window).width());
                //alert(link);
                //var ausgabe;
                //var spruengeArr = spruenge.split(",,");
                /*    
                for(var i=0; i<spruengeArr.length; i++){
                  if(i==0){
                        var fktNr = spruengeArr[i];
                        var fktName = spruengeArr[i+1];
                        //ausgabe = '<a class="links" href="http://localhost/Finanzberatung/index.php?r=site/details&fktNr="'+fktNr+'">['+fktNr+'] '+fktName+'</a></br></br>';
                        ausgabe += '['+fktNr+'] '+fktName+'</br></br>';
                  }else{
                    if(i%2 == 0){
                        var fktNr = spruengeArr[i];
                        var fktName = spruengeArr[i+1];
                        //ausgabe += '<a class="links" href="http://localhost/Finanzberatung/index.php?r=site/details&fktNr="'+fktNr+'">['+fktNr+'] '+fktName+'</a></br></br>';
                        ausgabe += '['+fktNr+'] '+fktName+'</br></br>';
                    }
                  }
                }*/
                
                var popup = document.createElement('div');
                popup.className = 'popupSpruenge';
                popup.id = 'popup_2' + popupID;
                var cancel = document.createElement('div');
                cancel.className = 'cancel';
                cancel.innerHTML = 'close';
                cancel.onclick = function (e) { popup.parentNode.removeChild(popup) };
                var gesetzTop = document.createElement('div');
                gesetzTop.className = 'spruengeTop';
                gesetzTop.innerHTML = funktionsName;
                var gesetzContent = document.createElement('div');
                gesetzContent.className = 'spruengeContent';
                gesetzContent.innerHTML = spruenge;
                
                popup.appendChild(cancel);
                popup.appendChild(gesetzTop);
                popup.appendChild(gesetzContent);                                    
                document.body.appendChild(popup);
                
                $('#popup_2' + popupID).draggable();
                
                return false;
     });
     
     $('.folge_button').click(
            
        
            function popUp3(){
                
                var fktName = this.attributes["name"].value;
                var spruenge = this.attributes["data-folge"].value;
                
                var popupID = this.id;
                
                var popup = document.createElement('div');
                popup.className = 'popupFolge';
                popup.id = 'popup_3' + popupID;
                var cancel = document.createElement('div');
                cancel.className = 'cancel';
                cancel.innerHTML = 'close';
                cancel.onclick = function (e) { popup.parentNode.removeChild(popup) };
                var gesetzTop = document.createElement('div');
                gesetzTop.className = 'folgeTop';
                gesetzTop.innerHTML = fktName;
                var gesetzContent = document.createElement('div');
                gesetzContent.className = 'folgeContent';
                gesetzContent.innerHTML = spruenge;
                popup.appendChild(cancel);
                popup.appendChild(gesetzTop);
                popup.appendChild(gesetzContent);                                  
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
          // Use ID-selectors to toggle a single element.
          // $('#' + target).toggle();
          // Use class-selectors to toggle groups of elements.
          $('.' + target).toggle();
          // $('.toggle.always').toggle();
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
                   bufferGrobphase = bufferGrobphase +document.neu_form.select_grobphase.options[i].value;
				   j++;
				}
                else if (document.neu_form.select_grobphase.options[i].selected && j!=0){
                   bufferGrobphase = bufferGrobphase +","+document.neu_form.select_grobphase.options[i].value;
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
			//alert("hihi");
			document.neu_form.submit();
                        
	}
</script>

</body>
</html>