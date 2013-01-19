<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionNeu()
	{
		$funktion = new Funktion;
		$filter = new NeuForm;
		$spaltennamen2 = Funktion::model()->getTableSchema()->getColumnNames();
		$spaltennamen2[45] = "b_name";
                $spaltennamen = Funktion::model()->attributeLabelsIndexAreNumbers();
                $grobphase = new Grobphase;
                $unterphase2 = Unterphase::model()->findAllBySql("SELECT * FROM unterphase");
                $gesetz2 = Gesetz::model()->findAllBySql("SELECT * FROM gesetz");
                //$gesetze = $gesetz->gesetze;
                
                $funktionGes = Funktion::model()->findAllBySql("SELECT * FROM funktion");
                $spruengeLength = count($funktionGes);
                $link = "http://localhost/Finanzberatung/index.php?r=site/details&fktNr=";
                
                for($i=0;$i<$spruengeLength;$i++){
                        $sprungstellen = $funktionGes[$i]["sprungstelle"];
                        $funktionsfolgen = $funktionGes[$i]["funktionsfolge"];
                        $temp = null;
                        $ausgabeGesamt = null;
                      if($sprungstellen != null){
                        $fktNummern = explode(",", $sprungstellen);
                        $fktNrLength = count($fktNummern);
                        
                        for($j=0; $j<$fktNrLength; $j++){
                            $fktNr = $funktionGes[$fktNummern[$j]]["nummer"];
                            $fktName = $funktionGes[$fktNummern[$j]]["name"];
                            
                            //$temp = '<a class="links" href="'.$link.$fktNr.'">['.$fktNr.'] '.$fktName.'</a></br></br>';
                            $temp = '['.$fktNr.']  '.$fktName.'</br>';

                            if($ausgabeGesamt == null){
                                $ausgabeGesamt = $temp;
                            }else{
                                $ausgabeGesamt .= $temp;
                            }
                        }
                        $sprungstellenArr[$i] = $ausgabeGesamt;
                      }else{
                        $sprungstellenArr[$i] = null;
                      }
                      
                      $temp = null;
                      $ausgabeGesamt = null;
                      if($funktionsfolgen != null){
                        $fktNummern = explode(",", $funktionsfolgen);
                        $fktNrLength = count($fktNummern);
                        
                        for($j=0; $j<$fktNrLength; $j++){
                            $fktNr = $funktionGes[$fktNummern[$j]]["nummer"];
                            $fktName = $funktionGes[$fktNummern[$j]]["name"];
                            
                            //$temp = '<a class="links" href="'.$link.$fktNr.'">['.$fktNr.'] '.$fktName.'</a></br></br>';
                            $temp = '['.$fktNr.']  '.$fktName.'</br>';

                            if($ausgabeGesamt == null){
                                $ausgabeGesamt = $temp;
                            }else{
                                $ausgabeGesamt .= $temp;
                            }
                        }
                        $funktionsfolgenArr[$i] = $ausgabeGesamt;
                      }else{
                        $funktionsfolgenArr[$i] = null;
                      }
                }
		
		//Aufruf der get-Methoden der jeweiligen Models
		$modelGrobphase = Grobphase::model()->getAttr();
		$modelUnterphase = Unterphase::model()->getAttr();
		$modelFunktion = array();
		$modelFunktion["name"] = Funktion::model()->getNames();
		$modelFunktion["profmb"] = Funktion::model()->getOptionsProfMitBeratung();
		$modelFunktion["hsr_aktuell"] = Funktion::model()->getOptionsHSRAktuell();
		$modelFunktion["hsr_zukuenftig"] = Funktion::model()->getOptionsHSRZukuenftig();
		$modelGesetz = Gesetz::model()->findAllBySql("SELECT * FROM gesetz");
		//Zuweisung dieser in $model2, $model2[0]["filter"] ist das Model f�r den Filter selbst... k�nnen wir wohl rausnehmen, $model2[1][...] sind die Options f�r die Filterung
		$model2[0]["filter"]=$filter;
		$model2[1]["grobphase"]=$modelGrobphase;
		$model2[1]["unterphase"]=$modelUnterphase;
		$model2[1]["name"]= $modelFunktion["name"];
		$model2[1]["profmb"]= $modelFunktion["profmb"];
		$model2[1]["privmb"] = $modelFunktion["profmb"];
		$model2[1]["profob"] = $modelFunktion["profmb"];
		$model2[1]["privob"] = $modelFunktion["profmb"];
		$model2[1]["rausfg"] = $modelFunktion["profmb"];
		$model2[1]["hsra"] =$modelFunktion["hsr_aktuell"];
		$model2[1]["hsrz"] = $modelFunktion["hsr_zukuenftig"];
		$model2[1]["gesetze"] = $modelGesetz;
		if(isset($_POST['form_grobphase']))
		{
			
			//Zuweisung der Formulareingaben
			$fil_grobphase = $_POST['form_grobphase'];
			$fil_unterphase = $_POST['form_unterphase'];
			$fil_name = $_POST['form_name'];
			$fil_profmb = $_POST['form_profmb'];
			$fil_privmb = $_POST['form_privmb'];
			$fil_profob = $_POST['form_profob'];
			$fil_privob = $_POST['form_privob'];
			$fil_rausfg = $_POST['form_rausfg'];
			$fil_hsra = $_POST['form_hsra'];
			$fil_hsrz = $_POST['form_hsrz'];
			$fil_gesetze = $_POST['form_gesetze'];
			
			//Pr�fung, ob Eingaben leer waren, falls leer werden in einem Buffer alle M�glichkeiten gespeichert
			/*
			if($fil_grobphase==""){
					$fil2= Grobphase::model()->getCount();
					for($i=0;$i<$fil2;$i++){
						$fil_grobphase .= $i.",";
					}
					$fil_grobphase=substr($fil_grobphase, 0, -1);
			}
			if($fil_unterphase==""){
				$fil2= Unterphase::model()->getCount();
				for($i=0;$i<$fil2;$i++){
					$fil_unterphase .= $i.",";
				}
				$fil_unterphase = substr($fil_unterphase, 0, -1);
			}
			if($fil_name==""){
				$fil2= Funktion::model()->getCount();
				for($i=0;$i<$fil2;$i++){
					$fil_name .= $i.",";
				}
				$fil_name = substr($fil_name, 0, -1);
			}
			if($fil_privmb==""){
				$fil2= Funktion::model()->getOptionsProfMitBeratung();
				for($i=0;$i<count($fil2);$i++){
					$fil_privmb .= "'".$fil2[$i]."',";
				}
				$fil_privmb = substr($fil_privmb, 0, -1);
			}
			if($fil_profmb==""){
				$fil2= Funktion::model()->getOptionsProfMitBeratung();
				for($i=0;$i<count($fil2);$i++){
					$fil_profmb .= "'".$fil2[$i]."',";
				}
				$fil_profmb = substr($fil_profmb, 0, -1);
			}
			if($fil_privob==""){
				$fil2= Funktion::model()->getOptionsProfMitBeratung();
				for($i=0;$i<count($fil2);$i++){
					$fil_privob .= "'".$fil2[$i]."',";
				}
				$fil_privob = substr($fil_privob, 0, -1);
			}
			if($fil_profob==""){
				$fil2= Funktion::model()->getOptionsProfMitBeratung();
				for($i=0;$i<count($fil2);$i++){
					$fil_profob .= "'".$fil2[$i]."',";
				}
				$fil_profob = substr($fil_profob, 0, -1);
			}
			if($fil_rausfg==""){
				$fil2= Funktion::model()->getOptionsProfMitBeratung();
				for($i=0;$i<count($fil2);$i++){
					$fil_rausfg .= "'".$fil2[$i]."',";
				}
				$fil_rausfg = substr($fil_rausfg, 0, -1);
			}
			if($fil_hsra==""){
				$fil2= Funktion::model()->getOptionsHSRAktuell();
				for($i=0;$i<count($fil2);$i++){
					$fil_hsra .= "'".$fil2[$i]."',";
				}
				$fil_hsra = substr($fil_hsra, 0, -1);
			}
			if($fil_hsrz==""){
				$fil2= Funktion::model()->getOptionsHSRZukuenftig();
				for($i=0;$i<count($fil2);$i++){
					$fil_hsrz .= "'".$fil2[$i]."',";
				}
				$fil_hsrz = substr($fil_hsrz, 0, -1);
			}
			*/
			//SQL-SubStrings f�r alle Filter: sucht alle Werte der Spalten, die im jeweiligen Buffer enthalten sind
			$index = 0;
			$fil[0]="";
			if(!empty($fil_grobphase)){
			$fil[$index] = "grobphase_id IN ($fil_grobphase)";
			$index++;
			}
			if(!empty($fil_unterphase)){
			$fil[$index] = "unterphase_id IN ($fil_unterphase)";
			$index++;
			}
			if(!empty($fil_name)){
			$fil[$index] = "nummer IN ($fil_name)";
			$index++;
			}
			if(!empty($fil_privmb)){
			$fil[$index] = "priv_mit_beratung IN ($fil_privmb)";
			$index++;
			}
			if(!empty($fil_profmb)){
			$fil[$index] = "prof_mit_beratung IN ($fil_profmb)";
			$index++;
			}
			if(!empty($fil_privob)){
			$fil[$index] = "priv_ohne_beratung IN ($fil_privob)";
			$index++;
			}
			if(!empty($fil_profob)){
			$fil[$index] = "prof_ohne_beratung IN ($fil_profob)";
			$index++;
			}
			if(!empty($fil_rausfg)){
			$fil[$index] = "r_ausf_geschaeft IN ($fil_rausfg)";
			$index++;
			}
			if(!empty($fil_hsra)){
			$fil[$index] = "hsr_aktuell IN ($fil_hsra)";
			$index++;
			}
			if(!empty($fil_hsrz)){
			$fil[$index] = "hsr_zukuenftig IN ($fil_hsrz)";
			$index++;
			}
			
			$sql ="SELECT * FROM funktion WHERE ";
			if($fil[0] == ""){
			$sql ="SELECT * FROM funktion";
			}
			if(!empty($fil_gesetze)){
			$fil[$index] = "gesetz.id IN ($fil_gesetze)";
			$index++;
			$sql ="SELECT * FROM funktion INNER JOIN nm_funktion_gesetz ON funktion.id = nm_funktion_gesetz.f_id INNER JOIN gesetz ON nm_funktion_gesetz.g_id = gesetz.id WHERE ";
			}
			//Zusammensetzen der SQL-Abfrage
			for($i=0;$i<count($fil);$i++){
				$sql .=$fil[$i]." AND ";
				}
				
				//Wegnehmen des letzten "AND "
				$sql = substr($sql, 0, -4);
				$funktion = Funktion::model()->findAllBySql("$sql");
				//Zuweisung von "leer", wenn keine Funktion die Kriterien erf�llt, wird in neu.php abgefragt.
				if(empty($funktion[0]["id"])){
					$funktion[0]["id"]="leer";
					}
				if($funktion[0]["id"]!="leer"){
				$gesetze = array();
				for($i=0;$i<count($funktion);$i++){
					$gesetze[$i]=$funktion[$i]->gesetze;
					}
				$business_rules = array();
				for($i=0;$i<count($funktion);$i++){
					$business_rules=$funktion[$i]->business_rules;
					$br_buffer ="";
					for($j=0;$j<count($business_rules);$j++){
						$br_buffer  .= $business_rules[$j]["name"].'<br/>';
						}
					$funktion[$i]["b_name"]= $br_buffer;
					}
				}
				$grobphase = Grobphase::model()->findAllBySql("SELECT * FROM grobphase");
                        

                        //Array mit Funktionsfolgen 
                        /*
                        $arrFolge = 0;
                        $temp = 0;
                        $j=0;
                        
                        for($i=0; $i<count($funktionGes); $i++){
                            if($funktionGes[$i]["funktionsfolge"] == "x"){
                                if($temp == 1){
                                    $j++;
                                }
                                $k=0;
                                $temp = 0;
                                $arrFolge[$j]["folge"] = $i;
                                $k++;
                            }else if($funktionGes[$i]["funktionsfolge"] == "o"){
                                if($temp == 0){
                                    $j++;
                                }
                                $k=0;
                                $temp = 1;
                                $arrFolge[$j][$k] = $i;
                                $k++;
                            }else if($funktionGes[$i]["funktionsfolge"] == null){
                                //do nothing
                            }
                        } */
			if($funktion[0]["id"]!="leer"){
				$this->render('neu',array( 'gesetz2' => $gesetz2, 'funktionsfolgenArr' => $funktionsfolgenArr,'sprungstellenArr' => $sprungstellenArr, 'gesetze'=>$gesetze,'unterphase2'=>$unterphase2,'fil'=>$sql,'model'=>$funktion, 'model2' =>$model2, 'model3' =>$funktion, 'model4' => $fil_grobphase, 'name' => $fil_name, 'hsrz' => $fil_hsrz, 'hsra' => $fil_hsra, 'privob' => $fil_privob, 'profob' => $fil_profob, 'rausfg' => $fil_rausfg,'unterphase' => $fil_unterphase, 'privmb' => $fil_privmb, 'profmb' => $fil_profmb, 'fil_gesetze' => $fil_gesetze, 'model6' => $spaltennamen, 'model5' => $spaltennamen2, 'grobphase' => $grobphase,));
			}
			else{
				$this->render('neu',array('model'=>$funktion, 'model2' =>$model2, 'model6' => $spaltennamen, 'model5' => $spaltennamen2, 'leer' => 'leer',));
				}
		}
		else{
		$model = array($funktion,$filter,);
		$this->render('neu',array('model'=>$funktion, 'model2' =>$model2, 'model6' => $spaltennamen, 'model5' => $spaltennamen2));
		}
	}
        
         public function actionDetails($fktNr){
            $fktNr = (int)($fktNr);
            //$funktionsdaten = Funktion::model()->getRowByNumber($fktNr);
            $funktionsdaten = Funktion::model()->findBySql("SELECT * FROM funktion WHERE nummer = $fktNr");
            $funktion = Funktion::model()->findAllBySql("SELECT * FROM funktion");
            $grobphase = Grobphase::model()->findAllBySql("SELECT * FROM grobphase");
            $unterphase = Grobphase::model()->findAllBySql("SELECT * FROM unterphase");
            $business_rules = $funktionsdaten->business_rules;
            $gesetze = $funktionsdaten->gesetze;
            //$auslegung = $funktionsdaten->auslegung;
			//$business_rules= "asd";
            $j=0;
            $sprung[$j] = 0;
            $lastFct = 0;
            $temp = 1;
            $length = count($funktion);
            
            $nr = 0;
            $prevFkt = 0;
            $nextFkt = 0;
            $prevPhase = 0;
            $nextPhase = 0;
        
            for($i=0;$i<$length;$i++){
            
                if($temp == $funktion[$i]['grobphase_id']){
                
                }else{
                    $sprung[$j] = $funktion[$i]['nummer'];
                    $j++;
                }
            
                $lastFct = $funktion[$i]['nummer'];
            
                $temp = $funktion[$i]['grobphase_id'];
            
            }
            $arrLength = count($sprung);
            
            //prevFct
            if($fktNr == $sprung[0]){
                $prevFkt = $lastFct;
            }else {
                $prevFkt = $fktNr-1;
            }
            
            //nextFct
            if($fktNr == $lastFct) {
                $nextFkt = 1;
            }else {
                $nextFkt = $fktNr+1;
            }
            
            //prevPhase
            for($i=0;$i<=$arrLength-1;$i++) {
              
                if($fktNr == $sprung[0] || $fktNr < $sprung[1]) {
                    $nr = $arrLength-1;
                    break;
                }else if($fktNr == $sprung[$i]) {
                    $nr = $i-1;
                    break;
                }else if($fktNr > $sprung[$arrLength-1]){
                    $nr = $arrLength-2;
                    break;
                }else if($fktNr < $sprung[$i]){
                    $nr = $i-2;
                    break;
                }
            }
            $prevPhase = $sprung[$nr];
            
            //nextPhase
            for($i=1;$i<=$arrLength;$i++) {
                if($fktNr < $sprung[1]) {
                    $nr = 1;
                    break;
                }else if($fktNr < $sprung[$arrLength-1] && $fktNr > $sprung[$arrLength-2]){
                    $nr = $arrLength-1;
                    break;
                }else  if($fktNr == $sprung[$arrLength-1] || $fktNr > $sprung[$arrLength-1]) {
                    $nr = 0;
                    break;    
                }else  if($fktNr == $sprung[$i]) {
                    $nr = $i+1;
                    break;
                }else  if($fktNr < $sprung[$i]) {
                    $nr = $i;
                    break;
                }
            }
            $nextPhase = $sprung[$nr];
            
            $this->render('details', array( 'gesetze' => $gesetze, 'business_rules' => $business_rules, 'sprung'=>$sprung, 'nextPhase'=>$nextPhase, 'prevPhase'=>$prevPhase, 'prevFkt'=>$prevFkt, 'nextFkt'=>$nextFkt, 'funktion'=>$funktion, 'funktionsdaten'=>$funktionsdaten, 'fktNr'=>$fktNr, 'grobphase'=>$grobphase, 'unterphase'=>$unterphase));
        }
}
