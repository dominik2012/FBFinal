<?php

/**
 * This is the model class for table "gesetz".
 *
 * The followings are the available columns in table 'gesetz':
 * @property integer $id
 * @property string $gesetz
 * @property integer $aktuell
 */
class Gesetz extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gesetz the static model class
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
		return 'gesetz';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gesetz, aktuell', 'required'),
			array('aktuell', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gesetz, aktuell', 'safe', 'on'=>'search'),
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
			'auslegungen' => array(self::MANY_MANY, 'Auslegung', 'nm_auslegung_gesetz(g_id,a_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gesetz' => 'Gesetz',
			'aktuell' => 'Aktuell',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('gesetz',$this->gesetz,true);
		$criteria->compare('aktuell',$this->aktuell);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}