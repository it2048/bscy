<?php

/**
 * This is the model class for table "bs_admin".
 *
 * The followings are the available columns in table 'bs_admin':
 * @property string $username
 * @property string $tel
 * @property string $name
 * @property string $dep_name
 * @property integer $type
 * @property string $ct_name
 * @property string $dh_name
 * @property string $ct_boss
 * @property string $desc
 */
class BsAdmin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BsAdmin the static model class
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
		return 'bs_admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('username, ct_name', 'length', 'max'=>128),
			array('tel', 'length', 'max'=>64),
			array('name, dep_name', 'length', 'max'=>45),
			array('dh_name, ct_boss', 'length', 'max'=>16),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, tel, name, dep_name, type, ct_name, dh_name, ct_boss, desc', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'tel' => 'Tel',
			'name' => 'Name',
			'dep_name' => 'Dep Name',
			'type' => 'Type',
			'ct_name' => 'Ct Name',
			'dh_name' => 'Dh Name',
			'ct_boss' => 'Ct Boss',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dep_name',$this->dep_name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('ct_name',$this->ct_name,true);
		$criteria->compare('dh_name',$this->dh_name,true);
		$criteria->compare('ct_boss',$this->ct_boss,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}