<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // just guest can perform 'activate', 'login' and 'passRequest' actions
				'actions'=>array('index'),
				
				'users'=>array('*'),
			), 
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
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
	
	public function actionFilter()
	{
		$funktion = new Funktion;
		$filter = new NeuForm;
		$spaltennamen2 = Funktion::model()->getTableSchema()->getColumnNames();
		$spaltennamen2[45] = "b_name";
		$spaltennamen2[46] = "auslegung";
                $spaltennamen = Funktion::model()->attributeLabelsIndexAreNumbers();
                $unterphase2 = Unterphase::model()->findAllBySql("SELECT * FROM unterphase");
                $gesetz2 = Gesetz::model()->findAllBySql("SELECT * FROM gesetz");

                //Unterscheidung zwischen Demo-User u. vollwertiger User
		if(Yii::app()->user->level>5){
			$funktionGes = Funktion::model()->findAllBySql("SELECT * FROM funktion");
		}
		else{
                        //angezeigte Tabelle
			$funktionGes = Funktion2::model()->findAllBySql("SELECT * FROM funktion");
                        //um Sprünge-ID zu bekommen
                        //$funktionAlle = Funktion::model()->findAllBySql("SELECT * FROM funktion");
		}
                    
                //Funktion für Buttons (Popup)
                $anzFunktionen = count($funktionGes);
                
                for($i=0;$i<$anzFunktionen;$i++){
                        $sprungstellen = $funktionGes[$i]["sprungstelle"];
                        $funktionsfolgen = $funktionGes[$i]["funktionsfolge"];
                        $temp = null;
                        $ausgabeGesamt = null;
                        
                        //Wenn Sprungstellen vorhanden...
                        if($sprungstellen != null){
                            $fktNummern = explode(",", $sprungstellen);
                            $fktNrLength = count($fktNummern);
                        
                            for($j=0; $j<$fktNrLength; $j++){
                                $fktID = Funktion::model()->findAllbySql("SELECT id FROM funktion WHERE nummer = $fktNummern[$j]");
                                $fktNr = $funktionGes[$fktID[0]["id"]-1]["nummer"];
                                $fktName = $funktionGes[$fktID[0]["id"]-1]["name"];
                                $temp = '['.$fktNr.']  '.$fktName.',,';
                                
                                //letzten 2 Kommas entfernen
                                if($j == $fktNrLength-1){
                                    $length = strlen($temp);
                                    $temp = $temp.substr(0, $length-2);
                                }

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
                      
                      //Wenn Funktionsfolgen vorhanden sind...
                      if($funktionsfolgen != null){
                        $fktNummern = explode(",", $funktionsfolgen);
                        $fktNrLength = count($fktNummern);
                        
                        for($j=0; $j<$fktNrLength; $j++){
                                $fktID = Funktion::model()->findAllbySql("SELECT id FROM funktion WHERE nummer = $fktNummern[$j]");
                                $fktNr = $funktionGes[$fktID[0]["id"]-1]["nummer"];
                                $fktName = $funktionGes[$fktID[0]["id"]-1]["name"];
                                $temp = '['.$fktNr.']  '.$fktName.',,';
                                
                                //letzten 2 Kommas entfernen
                                if($j == $fktNrLength-1){
                                    $length = strlen($temp);
                                    $temp = $temp.substr(0, $length-2);
                                }

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
		if(Yii::app()->user->level>5){
			$modelFunktion["name"] = Funktion::model()->getNames();
			$modelFunktion["profmb"] = Funktion::model()->getOptionsProfMitBeratung();
			$modelFunktion["hsr_aktuell"] = Funktion::model()->getOptionsHSRAktuell();
			$modelFunktion["hsr_zukuenftig"] = Funktion::model()->getOptionsHSRZukuenftig();
		}
		else{
			$modelFunktion["name"] = Funktion2::model()->getNames();
			$modelFunktion["profmb"] = Funktion2::model()->getOptionsProfMitBeratung();
			$modelFunktion["hsr_aktuell"] = Funktion2::model()->getOptionsHSRAktuell();
			$modelFunktion["hsr_zukuenftig"] = Funktion2::model()->getOptionsHSRZukuenftig();
		}
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
		$grobphase = Grobphase::model()->findAllBySql("SELECT * FROM grobphase");
		
		
		
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
			if(Yii::app()->user->level>5){
				$sql ="SELECT * FROM funktion WHERE ";
			}
			else{
				$sql ="SELECT * FROM funktion2 WHERE ";
			}
			if($fil[0] == ""){
				if(Yii::app()->user->level>5){
					$sql ="SELECT * FROM funktion";
				}
				else{
					$sql ="SELECT * FROM funktion2";
				}
			}
			if(!empty($fil_gesetze)){
			$fil[$index] = "gesetz.id IN ($fil_gesetze)";
			$index++;
			if(Yii::app()->user->level>5){
				$sql ="SELECT * FROM funktion INNER JOIN nm_funktion_gesetz ON funktion.id = nm_funktion_gesetz.f_id INNER JOIN gesetz ON nm_funktion_gesetz.g_id = gesetz.id WHERE ";
			}
			else{
				$sql ="SELECT * FROM funktion2 INNER JOIN nm_funktion_gesetz ON funktion2.id = nm_funktion_gesetz.f_id INNER JOIN gesetz ON nm_funktion_gesetz.g_id = gesetz.id WHERE ";
			}
			}
			//Zusammensetzen der SQL-Abfrage
			for($i=0;$i<count($fil);$i++){
				$sql .=$fil[$i]." AND ";
				}
				
				//Wegnehmen des letzten "AND "
				$sql = substr($sql, 0, -4);
				if(Yii::app()->user->level>5){
					$funktion = Funktion::model()->findAllBySql("$sql");
				}
				else{
					$funktion = Funktion2::model()->findAllBySql("$sql");
				}
				//Zuweisung von "leer", wenn keine Funktion die Kriterien erf�llt, wird in neu.php abgefragt.
				if(empty($funktion[0]["id"])){
					$funktion[0]["id"]="leer";
					}
					
		}
		else{
			$sql = "alle";
			$fil_grobphase = "";
			$fil_unterphase = "";
			$fil_name = "";
			$fil_profmb = "";
			$fil_privmb = "";
			$fil_profob = "";
			$fil_privob = "";
			$fil_rausfg = "";
			$fil_hsra = "";
			$fil_hsrz = "";
			$fil_gesetze = "";
			if(Yii::app()->user->level>5){
				$funktion = Funktion::model()->findAllBySql("SELECT * FROM funktion");
			}
			else{
				$funktion = Funktion2::model()->findAllBySql("SELECT * FROM funktion2");
			}
		}
			
				if($funktion[0]["id"]!="leer"){
				$gesetze = array();
				for($i=0;$i<count($funktion);$i++){
					$gesetze[$i]=$funktion[$i]->gesetze;
					}
				$business_rules = array();
				for($i=0;$i<count($funktion);$i++){
					$business_rules[$i]=$funktion[$i]->business_rules;
					$br_buffer ="";
					for($j=0;$j<count($business_rules[$i]);$j++){
						$br_buffer  .= ($j+1).". ".$business_rules[$i][$j]["name"].'<br/>';
						}
					$funktion[$i]["b_name"]= $br_buffer;
					}
				}
				
				if(!empty($gesetze)){
					for($i=0;$i<count($gesetze);$i++){
						$auslegungGesetzBuffer="Auslegungen für Gesetze:<br/> ";
						for($j=0;$j<count($gesetze[$i]);$j++){
							$auslegungGesetze=$gesetz2[$gesetze[$i][$j]["id"]-1]->auslegungen;
							for($k=0;$k<count($auslegungGesetze);$k++){
								$auslegungGesetzBuffer .= "Gesetz <b>".($j+1).". ". $gesetze[$i][$j]["gesetz"]."</b>: ".$auslegungGesetze[$k]["name"].'<br/><br/>';
							}
						}
						$funktion[$i]["auslegung"] = $auslegungGesetzBuffer;
					}
				}
				$BRModel = BusinessRule::model()->findAllBySql("SELECT * FROM business_rule");
				if(!empty($business_rules)){
					for($i=0;$i<count($funktion);$i++){
						$auslegungBRBuffer="Auslegungen für Business Rules:<br/> ";
						for($j=0;$j<count($business_rules[$i]);$j++){
							$auslegungBR=$BRModel[$business_rules[$i][$j]["id"]-1]->auslegungen;
							for($k=0;$k<count($auslegungBR);$k++){
								$auslegungBRBuffer .= "Business Rule <b>".($j+1).". ". $business_rules[$i][$j]["name"]."</b>: ".$auslegungBR[$k]["name"].'<br/><br/>';
							}
						}
						$funktion[$i]["auslegung"] .= "<br/><br/>".$auslegungBRBuffer;
					}
				}
				
			if($funktion[0]["id"]!="leer"){
				$this->render('filter',array( 'gesetz2' => $gesetz2, 'funktionsfolgenArr' => $funktionsfolgenArr,'sprungstellenArr' => $sprungstellenArr, 'gesetze'=>$gesetze,'unterphase2'=>$unterphase2,'fil'=>$sql,'model'=>$funktion, 'model2' =>$model2, 'model3' =>$funktion, 'model4' => $fil_grobphase, 'name' => $fil_name, 'hsrz' => $fil_hsrz, 'hsra' => $fil_hsra, 'privob' => $fil_privob, 'profob' => $fil_profob, 'rausfg' => $fil_rausfg,'unterphase' => $fil_unterphase, 'privmb' => $fil_privmb, 'profmb' => $fil_profmb, 'fil_gesetze' => $fil_gesetze, 'model6' => $spaltennamen, 'model5' => $spaltennamen2, 'grobphase' => $grobphase,));
			}
			else{
				$this->render('filter',array('model'=>$funktion, 'model2' =>$model2, 'model6' => $spaltennamen, 'model5' => $spaltennamen2, 'leer' => 'leer',));
			}
		
	}
        
         //Action Detailseite
         public function actionDetails($fktNr){
            $fktNr = (int)($fktNr);
            //$funktionsdaten = Funktion::model()->getRowByNumber($fktNr);
			if(Yii::app()->user->level>5){
				$funktionsdaten = Funktion::model()->findBySql("SELECT * FROM funktion WHERE nummer = $fktNr");
				$funktion = Funktion::model()->findAllBySql("SELECT * FROM funktion");
			}
			else{
				$funktionsdaten = Funktion2::model()->findBySql("SELECT * FROM funktion2 WHERE nummer = $fktNr");
				$funktion = Funktion2::model()->findAllBySql("SELECT * FROM funktion2");
				}
			
            
            $grobphase = Grobphase::model()->findAllBySql("SELECT * FROM grobphase");
            $unterphase = Grobphase::model()->findAllBySql("SELECT * FROM unterphase");
            
            $business_rules = $funktionsdaten->business_rules;
            $gesetze = $funktionsdaten->gesetze;
			if(!empty($gesetze)){
				$bufferGesetze="";
				for($i=0;$i<count($gesetze);$i++){
					$bufferGesetze .= "'".$gesetze[$i]["id"]."',";
					}
				$bufferGesetze =substr($bufferGesetze, 0, -1);
				$gesetzModel = Gesetz::model()->findAllBySql("SELECT * FROM gesetz WHERE id IN($bufferGesetze)");
				for($i=0;$i<count($gesetzModel);$i++){
					$auslegungG[$i] = $gesetzModel[$i]->auslegungen;
				}
			}
			else{
				$auslegungG=null;
				}
			if(!empty($business_rules)){
				$bufferBR="";
				for($i=0;$i<count($business_rules);$i++){
					$bufferBR .= "'".$business_rules[$i]["id"]."',";
					}
				$bufferBR =substr($bufferBR, 0, -1);
				$BRModel = BusinessRule::model()->findAllBySql("SELECT * FROM business_rule WHERE id IN($bufferBR)");
				for($i=0;$i<count($BRModel);$i++){
					$auslegungBR[$i] = $BRModel[$i]->auslegungen;
				}
			}
			else{
				$auslegungBR=null;
				}

                                
                        //Funktion für Detail-Buttons vor/zurück usw.        
                        $prevFkt = 0;
                        $nextFkt = 0;
                        $prevPhase = 0;
                        $nextPhase = 0;
			
			$first = $funktion[0]["nummer"];
			$last = $funktion[count($funktion)-1]["nummer"];
			
			//prevFkt
			if($fktNr==$first){
				$prevFkt = $last;
			}
			else{
				$prevFkt = $fktNr - 1;
			}
			
			//nextFkt
			if($fktNr==$last){
				$nextFkt = $first;
			}
			else{
				$nextFkt = $fktNr + 1;
			}
			
			//prevPhase / nextPhase
			
			$aktFktImArray = 0;
			for($i=0;$i<count($funktion);$i++){
				if($funktion[$i]["nummer"]==($fktNr-1)){
					$aktFktImArray = $i+1;
				}
			}
			$grobphaseFkt = $funktion[$aktFktImArray]["grobphase_id"];
			$firstGrobphase = $funktion[0]["grobphase_id"];
			$maxGrobphase = $firstGrobphase;
			$firstOfPhase = array();
			$firstOfPhase[$funktion[0]["grobphase_id"]]=$funktion[0]["nummer"];
			
			$current = 0;
			
			for($i=0;$i<count($funktion);$i++){
				if($current < $funktion[$i]["grobphase_id"]){
					$current = $funktion[$i]["grobphase_id"];
					$firstOfPhase[$current] = $i+1;
				}
				if($funktion[$i]["grobphase_id"]>$maxGrobphase){
					$maxGrobphase = $funktion[$i]["grobphase_id"];
					
				}
			}
			if($firstGrobphase==$maxGrobphase){
				$firstOfPhase = array();
				
				$firstOfPhase[$firstGrobphase] = $funktion[0]["nummer"];
				
			}
			else{}
			$chosenFkt = 0;
			//prevPhase
			if($grobphaseFkt==$firstGrobphase){
				$prevPhase = $firstOfPhase[$maxGrobphase];
			}
			else{
				$prevPhase = $firstOfPhase[$grobphaseFkt-1];
			}
				
			//nextPhase
			if($grobphaseFkt==$maxGrobphase){
				$nextPhase = $firstOfPhase[$firstGrobphase];
			}
			else{
				$nextPhase = $firstOfPhase[$grobphaseFkt+1];
			}
			
			
			
			
            $this->render('details', array( 'auslegungenGesetz' => $auslegungG, 'auslegungenBR' => $auslegungBR, 'gesetze' => $gesetze, 'business_rules' => $business_rules, 'nextPhase'=>$nextPhase, 'prevPhase'=>$prevPhase, 'prevFkt'=>$prevFkt, 'nextFkt'=>$nextFkt, 'funktion'=>$funktion, 'funktionsdaten'=>$funktionsdaten, 'fktNr'=>$fktNr, 'grobphase'=>$grobphase, 'unterphase'=>$unterphase));
        }
}
