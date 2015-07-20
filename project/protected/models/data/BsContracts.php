<?php

/**
 * This is the model class for table "bs_contracts".
 *
 * The followings are the available columns in table 'bs_contracts':
 * @property integer $id
 * @property integer $dr_time
 * @property integer $yj_time
 * @property integer $ct_time
 * @property string $bm_id
 * @property string $desc
 * @property integer $stage
 */
class BsContracts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bs_contracts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dr_time, bm_id, desc, stage', 'required'),
			array('dr_time, yj_time, ct_time, stage', 'numerical', 'integerOnly'=>true),
			array('bm_id', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dr_time, yj_time, ct_time, bm_id, desc, stage', 'safe', 'on'=>'search'),
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
			'dr_time' => 'Dr Time',
			'yj_time' => 'Yj Time',
			'ct_time' => 'Ct Time',
			'bm_id' => 'Bm',
			'desc' => 'Desc',
			'stage' => 'Stage',
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
		$criteria->compare('dr_time',$this->dr_time);
		$criteria->compare('yj_time',$this->yj_time);
		$criteria->compare('ct_time',$this->ct_time);
		$criteria->compare('bm_id',$this->bm_id,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('stage',$this->stage);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BsContracts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
