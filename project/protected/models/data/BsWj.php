<?php

/**
 * This is the model class for table "bs_wj".
 *
 * The followings are the available columns in table 'bs_wj':
 * @property integer $id
 * @property string $wx_type
 * @property string $wj_tk
 * @property string $wj_al
 * @property string $wj_zj
 */
class BsWj extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bs_wj';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wx_type, wj_tk', 'required'),
			array('wx_type', 'length', 'max'=>45),
			array('wj_tk, wj_al', 'length', 'max'=>90),
			array('wj_zj', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, wx_type, wj_tk, wj_al, wj_zj', 'safe', 'on'=>'search'),
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
			'wx_type' => 'Wx Type',
			'wj_tk' => 'Wj Tk',
			'wj_al' => 'Wj Al',
			'wj_zj' => 'Wj Zj',
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
		$criteria->compare('wx_type',$this->wx_type,true);
		$criteria->compare('wj_tk',$this->wj_tk,true);
		$criteria->compare('wj_al',$this->wj_al,true);
		$criteria->compare('wj_zj',$this->wj_zj,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BsWj the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
