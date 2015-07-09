<?php

/**
 * This is the model class for table "bs_money".
 *
 * The followings are the available columns in table 'bs_money':
 * @property integer $id
 * @property integer $type
 * @property integer $month
 * @property string $cb_id
 * @property string $yg_id
 * @property string $yg_name
 * @property string $desc
 */
class BsMoney extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BsMoney the static model class
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
		return 'bs_money';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, month, cb_id, yg_id, yg_name, desc', 'required'),
			array('type, month', 'numerical', 'integerOnly'=>true),
			array('cb_id, yg_id', 'length', 'max'=>16),
			array('yg_name', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, month, cb_id, yg_id, yg_name, desc', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'month' => 'Month',
			'cb_id' => 'Cb',
			'yg_id' => 'Yg',
			'yg_name' => 'Yg Name',
			'desc' => 'Desc',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('month',$this->month);
		$criteria->compare('cb_id',$this->cb_id,true);
		$criteria->compare('yg_id',$this->yg_id,true);
		$criteria->compare('yg_name',$this->yg_name,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}