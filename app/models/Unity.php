<?php

/**
 * This is the model class for table "unity".
 *
 * The followings are the available columns in table 'unity':
 * @property integer $ID
 * @property string $name
 * @property integer $organizationID
 * @property integer $fatherID
 * @property integer $locationID
 * @property string $fcode
 * @property integer $autochild
 * @property integer $actDate
 * @property integer $desDate
 * @property integer $capacity
 *
 * The followings are the available model relations:
 * @property Actor[] $actors
 * @property Location $location
 * @property Organization $organization
 */
class Unity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Unity the static model class
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
		return 'unity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, organizationID, locationID', 'required'),
			array('organizationID, fatherID, locationID, autochild, actDate, desDate, capacity', 'numerical', 'integerOnly'=>true),
			array('name, fcode', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, name, organizationID, fatherID, locationID, fcode, autochild, actDate, desDate, capacity', 'safe', 'on'=>'search'),
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
			'actors' => array(self::HAS_MANY, 'Actor', 'unityID'),
			'location' => array(self::BELONGS_TO, 'Location', 'locationID'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'organizationID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => Yii::t('default', 'ID'),
			'name' => Yii::t('default', 'Name'),
			'organizationID' => Yii::t('default', 'Organization'),
			'fatherID' => Yii::t('default', 'Father'),
			'locationID' => Yii::t('default', 'Location'),
			'fcode' => Yii::t('default', 'Fcode'),
			'autochild' => Yii::t('default', 'Autochild'),
			'actDate' => Yii::t('default', 'Act Date'),
			'desDate' => Yii::t('default', 'Des Date'),
			'capacity' => Yii::t('default', 'Capacity'),
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('organizationID',$this->organizationID);
		$criteria->compare('fatherID',$this->fatherID);
		$criteria->compare('locationID',$this->locationID);
		$criteria->compare('fcode',$this->fcode,true);
		$criteria->compare('autochild',$this->autochild);
		$criteria->compare('actDate',$this->actDate);
		$criteria->compare('desDate',$this->desDate);
		$criteria->compare('capacity',$this->capacity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}