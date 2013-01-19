<?php

/**
 * This is the model class for table "grobphase".
 *
 * The followings are the available columns in table 'grobphase':
 * @property string $grobphase_id
 * @property string $name
 */
class Grobphase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Grobphase the static model class
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
		return 'grobphase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grobphase_id, name', 'required'),
			array('grobphase_id', 'length', 'max'=>4),
			array('name', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('grobphase_id, name', 'safe', 'on'=>'search'),
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
			'funktionen' => array(self::HAS_MANY, 'Funktion', 'grobphase_id'),
			'unterphasen' => array(self::HAS_MANY, 'Unterphase', 'unterphase_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grobphase_id' => 'Grobphase',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('grobphase_id',$this->grobphase_id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getAttr(){
		$val = Yii::app()->db->createCommand()->select('*')->from('grobphase');
		
		$v = $val->queryAll();
		$values = array();
		for($i=0;$i<count($v);$i++){
		$values[$i] = $v[$i]["name"];
		}
		return $values;
	}
	public function getCount(){
		$val = Yii::app()->db->createCommand()->select('COUNT(grobphase_id)')->from('grobphase');
		$v = $val->queryRow();
		$value = $v['COUNT(grobphase_id)'];
		return $value;
		}
}