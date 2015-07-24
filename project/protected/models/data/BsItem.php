<?php

/**
 * This is the model class for table "bs_item".
 *
 * The followings are the available columns in table 'bs_item':
 * @property integer $id
 * @property integer $sp_id
 * @property string $sp_name
 * @property string $sp_dw
 * @property string $sp_mn
 */
class BsItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bs_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_id', 'numerical', 'integerOnly'=>true),
			array('sp_name', 'length', 'max'=>128),
			array('sp_dw', 'length', 'max'=>8),
			array('sp_mn', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sp_id, sp_name, sp_dw, sp_mn', 'safe', 'on'=>'search'),
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
			'sp_id' => 'Sp',
			'sp_name' => 'Sp Name',
			'sp_dw' => 'Sp Dw',
			'sp_mn' => 'Sp Mn',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('sp_id',$this->sp_id);
		$criteria->compare('sp_name',$this->sp_name,true);
		$criteria->compare('sp_dw',$this->sp_dw,true);
		$criteria->compare('sp_mn',$this->sp_mn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BsItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
