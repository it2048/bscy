<?php

/**
 * This is the model class for table "bs_bgyp".
 *
 * The followings are the available columns in table 'bs_bgyp':
 * @property integer $id
 * @property string $city
 * @property string $company
 * @property string $org
 * @property integer $sq_time
 * @property string $sqr
 * @property string $code
 * @property string $name
 * @property string $dw
 * @property string $dj
 * @property string $cnt
 * @property string $money
 * @property string $boss
 * @property string $desc
 * @property integer $status
 * @property string $ct_no
 */
class BsBgyp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bs_bgyp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sq_time, status', 'numerical', 'integerOnly'=>true),
			array('city', 'length', 'max'=>32),
			array('company, org, sqr, code, name, dw, dj, cnt, money, boss, desc, ct_no', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, city, company, org, sq_time, sqr, code, name, dw, dj, cnt, money, boss, desc, status, ct_no', 'safe', 'on'=>'search'),
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
			'city' => 'City',
			'company' => 'Company',
			'org' => 'Org',
			'sq_time' => 'Sq Time',
			'sqr' => 'Sqr',
			'code' => 'Code',
			'name' => 'Name',
			'dw' => 'Dw',
			'dj' => 'Dj',
			'cnt' => 'Cnt',
			'money' => 'Money',
			'boss' => 'Boss',
			'desc' => 'Desc',
			'status' => 'Status',
			'ct_no' => 'Ct No',
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
		$criteria->compare('city',$this->city,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('org',$this->org,true);
		$criteria->compare('sq_time',$this->sq_time);
		$criteria->compare('sqr',$this->sqr,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dw',$this->dw,true);
		$criteria->compare('dj',$this->dj,true);
		$criteria->compare('cnt',$this->cnt,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('boss',$this->boss,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('ct_no',$this->ct_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BsBgyp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
