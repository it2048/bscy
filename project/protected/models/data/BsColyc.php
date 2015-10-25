<?php

/**
 * This is the model class for table "bs_colyc".
 *
 * The followings are the available columns in table 'bs_colyc':
 * @property integer $id
 * @property integer $month
 * @property string $am
 * @property string $dm
 * @property string $ct_id
 * @property string $desc
 * @property string $ct_name
 */
class BsColyc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BsColyc the static model class
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
		return 'bs_colyc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('month', 'numerical', 'integerOnly'=>true),
			array('am, dm', 'length', 'max'=>45),
			array('ct_id', 'length', 'max'=>32),
			array('ct_name', 'length', 'max'=>64),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, month, am, dm, ct_id, desc, ct_name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'month' => 'Month',
			'am' => 'Am',
			'dm' => 'Dm',
			'ct_id' => 'Ct',
			'desc' => 'Desc',
			'ct_name' => 'Ct Name',
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
		$criteria->compare('month',$this->month);
		$criteria->compare('am',$this->am,true);
		$criteria->compare('dm',$this->dm,true);
		$criteria->compare('ct_id',$this->ct_id,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('ct_name',$this->ct_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}