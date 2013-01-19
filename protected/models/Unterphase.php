<?php

/**
 * This is the model class for table "unterphase".
 *
 * The followings are the available columns in table 'unterphase':
 * @property string $unterphase_id
 * @property integer $name
 * @property string $grobphase_id
 */
class Unterphase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Unterphase the static model class
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
		return 'unterphase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unterphase_id, name, grobphase_id', 'required'),
			array('name', 'numerical', 'integerOnly'=>true),
			array('unterphase_id, grobphase_id', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('unterphase_id, name, grobphase_id', 'safe', 'on'=>'search'),
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
			'grobphase' => array(self::BELONGS_TO, 'Grobphase', 'grobphase_id'),
			'funktionen' => array(self::HAS_MANY, 'Funktion', 'unterphase_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'unterphase_id' => 'Unterphase',
			'name' => 'Name',
			'grobphase_id' => 'Grobphase',
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

		$criteria->compare('unterphase_id',$this->unterphase_id,true);
		$criteria->compare('name',$this->name);
		$criteria->compare('grobphase_id',$this->grobphase_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getAttr(){
		$val = Yii::app()->db->createCommand()->select('*')->from('unterphase');
		
		$v = $val->queryAll();
		$values = array();
		for($i=0;$i<count($v);$i++){
		$values[$i] = $v[$i]["name"];
		}
		return $values;
	}
	public function getCount(){
		$val = Yii::app()->db->createCommand()->select('COUNT(unterphase_id)')->from('unterphase');
		$v = $val->queryRow();
		$value = $v['COUNT(unterphase_id)'];
		return $value;
		}
}