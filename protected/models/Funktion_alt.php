<?php

/**
 * This is the model class for table "funktion".
 *
 * The followings are the available columns in table 'funktion':
 * @property string $id
 * @property string $nummer
 * @property string $name
 * @property string $beschreibung
 * @property string $priv_mit_beratung
 * @property string $priv_ohne_beratung
 * @property string $prof_mit_beratung
 * @property string $prof_ohne_beratung
 * @property string $hinweis
 * @property string $weiterereg
 * @property string $hsr_aktuell
 * @property string $hsr_zukuenftig
 * @property string $r_ausf_geschaeft
 * @property string $spezialist_vs_generalist
 * @property string $frontoffice_generalist
 * @property string $frontoffice_experte
 * @property string $backoffice
 * @property string $produktlieferant
 * @property string $bank
 * @property string $kunde
 * @property string $verantwortlicher
 * @property string $ressourcen
 * @property string $funktionsfolge
 * @property string $sprungstelle
 * @property string $kanalwechsel
 * @property string $inputdaten
 * @property string $outputdaten
 * @property string $datenfluss
 * @property string $grobphase_id
 * @property string $unterphase_id
 */
class Funktion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Funktion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'funktion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nummer, name, beschreibung, priv_mit_beratung, priv_ohne_beratung, prof_mit_beratung, prof_ohne_beratung, hinweis, weiterereg, hsr_aktuell, hsr_zukuenftig, r_ausf_geschaeft, spezialist_vs_generalist, frontoffice_generalist, frontoffice_experte, backoffice, produktlieferant, bank, kunde, verantwortlicher, ressourcen, funktionsfolge, sprungstelle, kanalwechsel, inputdaten, outputdaten, datenfluss, grobphase_id, unterphase_id', 'required'),
			array('nummer, grobphase_id, unterphase_id', 'length', 'max'=>4),
			array('name', 'length', 'max'=>50),
			array('priv_mit_beratung, priv_ohne_beratung, prof_mit_beratung, prof_ohne_beratung, r_ausf_geschaeft, spezialist_vs_generalist, frontoffice_generalist, frontoffice_experte, backoffice, produktlieferant, bank, kunde', 'length', 'max'=>1),
			array('hsr_aktuell, hsr_zukuenftig', 'length', 'max'=>10),
			array('verantwortlicher, ressourcen, inputdaten, outputdaten, datenfluss', 'length', 'max'=>20),
			array('funktionsfolge', 'length', 'max'=>150),
                        array('sprungstelle', 'length', 'max'=>150),
			array('kanalwechsel', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nummer, name, beschreibung, priv_mit_beratung, priv_ohne_beratung, prof_mit_beratung, prof_ohne_beratung, hinweis, weiterereg, hsr_aktuell, hsr_zukuenftig, r_ausf_geschaeft, spezialist_vs_generalist, frontoffice_generalist, frontoffice_experte, backoffice, produktlieferant, bank, kunde, verantwortlicher, ressourcen, funktionsfolge, sprungstelle, kanalwechsel, inputdaten, outputdaten, datenfluss, grobphase_id, unterphase_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'unterphase' => array(self::BELONGS_TO, 'Unterphase', 'unterphase_id'),
			'grobphase' => array(self::BELONGS_TO, 'Grobphase', 'grobphase_id'),
			'business_rules' => array(self::MANY_MANY, 'BusinessRule', 'nm_funktion_business_rule(f_id,br_id)'),
                        'gesetze' => array(self::MANY_MANY, 'Gesetz', 'nm_funktion_gesetz(f_id,g_id)'),
                    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nummer' => 'Nummer',
			'name' => 'Name',
			'beschreibung' => 'Beschreibung',
			'priv_mit_beratung' => 'Privat Mit Beratung',
			'priv_ohne_beratung' => 'Privat Ohne Beratung',
			'prof_mit_beratung' => 'Professionell Mit Beratung',
			'prof_ohne_beratung' => 'Professionell Ohne Beratung',
			'hinweis' => 'Hinweis',
			'weiterereg' => 'Weitere Regulatorien',
			'hsr_aktuell' => 'HSR Aktuell',
			'hsr_zukuenftig' => 'HSR Zuk&uuml;nftig',
			'r_ausf_geschaeft' => 'Reines Ausf&uuml;rungsgesch&auml;ft',
			'spezialist_vs_generalist' => 'Spezialist Vs Generalist',
			'frontoffice_generalist' => 'Frontoffice Generalist',
			'frontoffice_experte' => 'Frontoffice Experte',
			'backoffice' => 'Backoffice',
			'produktlieferant' => 'Produktlieferant',
			'bank' => 'Bank',
			'kunde' => 'Kunde',
			'verantwortlicher' => 'Verantwortlicher',
			'ressourcen' => 'Ressourcen',
			'funktionsfolge' => 'Funktionsfolge',
            'sprungstelle' => 'Sprungstelle',
			'kanalwechsel' => 'Kanalwechsel',
			'inputdaten' => 'Inputdaten',
			'outputdaten' => 'Outputdaten',
			'datenfluss' => 'Datenfluss',
			'grobphase_id' => 'Grobphase',
			'unterphase_id' => 'Unterphase',
		);
	}
	public function getFieldNames()
	{
		return array(
			'id' => 'iD',
			'nummer' => 'nummer',
			'name' => 'name',
			'beschreibung' => 'beschreibung',
			'priv_mit_beratung' => 'priv_mit_beratung',
			'priv_ohne_beratung' => 'priv_ohne_beratung',
			'prof_mit_beratung' => 'prof_mit_beratung',
			'prof_ohne_beratung' => 'prof_ohne_beratung',
			'hinweis' => 'hinweis',
			'weiterereg' => 'weiterereg',
			'hsr_aktuell' => 'hsr_aktuell',
			'hsr_zukuenftig' => 'hsr_zukuenftig',
			'r_ausf_geschaeft' => 'r_ausf_geschaeft',
			'spezialist_vs_generalist' => 'spezialist_vs_generalist',
			'frontoffice_generalist' => 'frontoffice_generalist',
			'frontoffice_experte' => 'frontoffice_experte',
			'backoffice' => 'backoffice',
			'produktlieferant' => 'produktlieferant',
			'bank' => 'bank',
			'kunde' => 'kunde',
			'verantwortlicher' => 'verantwortlicher',
			'ressourcen' => 'ressourcen',
			'funktionsfolge' => 'funktionsfolge',
            'sprungstelle' => 'sprungstelle',
			'kanalwechsel' => 'kanalwechsel',
			'inputdaten' => 'inputdaten',
			'outputdaten' => 'outputdaten',
			'datenfluss' => 'datenfluss',
			'grobphase_id' => 'grobphase_id',
			'unterphase_id' => 'unterphase_id',
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
        
        public function attributeLabelsIndexAreNumbers()
{
return array(
0 => 'ID',
1 => 'Nummer',
2 => 'Name',
3 => 'Beschreibung',
4 => 'Privat mit Beratung',
5 => 'Professionell mit Beratung',
6 => 'Privat ohne Beratung',
7 => 'Professionell ohne Beratung',
8 => 'Hinweis',
9 => 'Weitere Regulatorien',
10 => 'Handlungsspielraum Aktuell',
11 => 'Handlungsspielraum Zuk&uuml;nftig',
12 => 'Reines Ausfuehrungsgesch&auml;ft',
13 => 'Spezialist Vs. Generalist',
14 => 'Frontoffice Generalist',
15 => 'Frontoffice Experte',
16 => 'Backoffice',
17 => 'Produktlieferant',
18 => 'Bank',
19 => 'Kunde',
20 => 'Verantwortlicher',
21 => 'Ressourcen',
22 => 'Funktionsfolge',
23 => 'Sprungstelle',
24 => 'Kanalwechsel',
25 => 'Inputdaten',
26 => 'Outputdaten',
27 => 'Datenfluss',
28 => 'Grobphase',
29 => 'Unterphase',
);
}
        
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nummer',$this->nummer,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('beschreibung',$this->beschreibung,true);
		$criteria->compare('priv_mit_beratung',$this->priv_mit_beratung,true);
		$criteria->compare('priv_ohne_beratung',$this->priv_ohne_beratung,true);
		$criteria->compare('prof_mit_beratung',$this->prof_mit_beratung,true);
		$criteria->compare('prof_ohne_beratung',$this->prof_ohne_beratung,true);
		$criteria->compare('hinweis',$this->hinweis,true);
		$criteria->compare('weiterereg',$this->weiterereg,true);
		$criteria->compare('hsr_aktuell',$this->hsr_aktuell,true);
		$criteria->compare('hsr_zukuenftig',$this->hsr_zukuenftig,true);
		$criteria->compare('r_ausf_geschaeft',$this->r_ausf_geschaeft,true);
		$criteria->compare('spezialist_vs_generalist',$this->spezialist_vs_generalist,true);
		$criteria->compare('frontoffice_generalist',$this->frontoffice_generalist,true);
		$criteria->compare('frontoffice_experte',$this->frontoffice_experte,true);
		$criteria->compare('backoffice',$this->backoffice,true);
		$criteria->compare('produktlieferant',$this->produktlieferant,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('kunde',$this->kunde,true);
		$criteria->compare('verantwortlicher',$this->verantwortlicher,true);
		$criteria->compare('ressourcen',$this->ressourcen,true);
		$criteria->compare('funktionsfolge',$this->funktionsfolge,true);
                $criteria->compare('sprungstelle',$this->sprungstelle,true);
		$criteria->compare('kanalwechsel',$this->kanalwechsel,true);
		$criteria->compare('inputdaten',$this->inputdaten,true);
		$criteria->compare('outputdaten',$this->outputdaten,true);
		$criteria->compare('datenfluss',$this->datenfluss,true);
		$criteria->compare('grobphase_id',$this->grobphase_id,true);
		$criteria->compare('unterphase_id',$this->unterphase_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getNames(){
		$val = Yii::app()->db->createCommand()->select('nummer,name')->from('funktion')->order('nummer ASC');
		$v = $val->queryAll();
		$values = array();
		for($i=0;$i<count($v);$i++){
			$values[$i]="[".$v[$i]["nummer"]."] ".$v[$i]["name"];
			}
		return $values;
	}
	public function getCount(){
		$val = Yii::app()->db->createCommand()->select('COUNT(id)')->from('funktion');
		$v = $val->queryRow();
		$value = $v['COUNT(id)'];
		return $value;
		}
	
	public function getOptionsProfMitBeratung(){
		$val = Yii::app()->db->createCommand()->selectDistinct('prof_mit_beratung')->from('funktion');
		$v = $val->queryAll();
		$values=array();
		for($i=0;$i<count($v);$i++){
			$values[$i]=$v[$i]['prof_mit_beratung'];
		}
		return $values;
		}
	public function getOptionsHSRAktuell(){
		$val = Yii::app()->db->createCommand()->selectDistinct('hsr_aktuell')->from('funktion');
		$v = $val->queryAll();
		$values=array();
		for($i=0;$i<count($v);$i++){
			$values[$i]= $v[$i]['hsr_aktuell'];
			}
		return $values;
		}
	public function getOptionsHSRZukuenftig(){
		$val = Yii::app()->db->createCommand()->selectDistinct('hsr_zukuenftig')->from('funktion');
		$v = $val->queryAll();
		$values=array();
		for($i=0;$i<count($v);$i++){
			$values[$i]= $v[$i]['hsr_zukuenftig'];
			}
		return $values;
		}
                
        public function getRowByNumber($fktNr){
                $val = Yii::app()->db->createCommand()->select('*')->from('funktion')->where('nummer = '.$fktNr);
                $v = $val->queryRow();
                return $v;
                }
}