<?php

/**
 * This is the model class for table "bs_emp".
 *
 * The followings are the available columns in table 'bs_emp':
 * @property string $em_id
 * @property string $name
 * @property string $hyp
 * @property string $bm_id
 * @property string $sf_id
 * @property string $zw_name
 * @property string $ct_name
 */
class BsEmp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bs_emp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('em_id, bm_id', 'length', 'max'=>16),
			array('name, hyp', 'length', 'max'=>45),
			array('sf_id', 'length', 'max'=>18),
			array('zw_name', 'length', 'max'=>64),
			array('ct_name', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('em_id, name, hyp, bm_id, sf_id, zw_name, ct_name', 'safe', 'on'=>'search'),
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
			'em_id' => 'Em',
			'name' => 'Name',
			'hyp' => 'Hyp',
			'bm_id' => 'Bm',
			'sf_id' => 'Sf',
			'zw_name' => 'Zw Name',
			'ct_name' => 'Ct Name',
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

		$criteria->compare('em_id',$this->em_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('hyp',$this->hyp,true);
		$criteria->compare('bm_id',$this->bm_id,true);
		$criteria->compare('sf_id',$this->sf_id,true);
		$criteria->compare('zw_name',$this->zw_name,true);
		$criteria->compare('ct_name',$this->ct_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BsEmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
