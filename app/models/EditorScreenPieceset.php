<?php

/**
 * This is the model class for table "editor_screen_pieceset".
 *
 * The followings are the available columns in table 'editor_screen_pieceset':
 * @property integer $ID
 * @property integer $screenID
 * @property integer $piecesetID
 * @property integer $piecesetParent
 * @property integer $position
 * @property integer $templateID
 *
 * The followings are the available model relations:
 * @property EditorPieceset $pieceset
 * @property EditorPieceset $piecesetParent0
 * @property EditorScreen $screen
 * @property CobjectTemplate $template
 */
class EditorScreenPieceset extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EditorScreenPieceset the static model class
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
		return 'editor_screen_pieceset';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('screenID, piecesetID, templateID', 'required'),
			array('screenID, piecesetID, piecesetParent, position, templateID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, screenID, piecesetID, piecesetParent, position, templateID', 'safe', 'on'=>'search'),
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
			'pieceset' => array(self::BELONGS_TO, 'EditorPieceset', 'piecesetID'),
			'piecesetParent0' => array(self::BELONGS_TO, 'EditorPieceset', 'piecesetParent'),
			'screen' => array(self::BELONGS_TO, 'EditorScreen', 'screenID'),
			'template' => array(self::BELONGS_TO, 'CobjectTemplate', 'templateID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => Yii::t('default', 'ID'),
			'screenID' => Yii::t('default', 'Screen'),
			'piecesetID' => Yii::t('default', 'Pieceset'),
			'piecesetParent' => Yii::t('default', 'Pieceset Parent'),
			'position' => Yii::t('default', 'Position'),
			'templateID' => Yii::t('default', 'Template'),
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
		$criteria->compare('screenID',$this->screenID);
		$criteria->compare('piecesetID',$this->piecesetID);
		$criteria->compare('piecesetParent',$this->piecesetParent);
		$criteria->compare('position',$this->position);
		$criteria->compare('templateID',$this->templateID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}