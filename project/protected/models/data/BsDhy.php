<?php

/**
 * This is the model class for table "bs_dhy".
 *
 * The followings are the available columns in table 'bs_dhy':
 * @property integer $id
 * @property integer $d_time
 * @property string $d_bm
 * @property string $ydr
 * @property string $d_nr
 * @property string $d_hyr
 * @property string $d_cjr
 * @property integer $st_time
 * @property integer $sp_time
 * @property integer $hys_no
 * @property integer $ljx
 * @property integer $ht
 * @property integer $ykq
 */
class BsDhy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bs_dhy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('d_time, st_time, sp_time, hys_no, ljx, ht, ykq', 'numerical', 'integerOnly'=>true),
			array('d_bm, ydr, d_hyr', 'length', 'max'=>45),
			array('d_nr, d_cjr', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, d_time, d_bm, ydr, d_nr, d_hyr, d_cjr, st_time, sp_time, hys_no, ljx, ht, ykq', 'safe', 'on'=>'search'),
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
			'd_time' => 'D Time',
			'd_bm' => 'D Bm',
			'ydr' => 'Ydr',
			'd_nr' => 'D Nr',
			'd_hyr' => 'D Hyr',
			'd_cjr' => 'D Cjr',
			'st_time' => 'St Time',
			'sp_time' => 'Sp Time',
			'hys_no' => 'Hys No',
			'ljx' => 'Ljx',
			'ht' => 'Ht',
			'ykq' => 'Ykq',
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
		$criteria->compare('d_time',$this->d_time);
		$criteria->compare('d_bm',$this->d_bm,true);
		$criteria->compare('ydr',$this->ydr,true);
		$criteria->compare('d_nr',$this->d_nr,true);
		$criteria->compare('d_hyr',$this->d_hyr,true);
		$criteria->compare('d_cjr',$this->d_cjr,true);
		$criteria->compare('st_time',$this->st_time);
		$criteria->compare('sp_time',$this->sp_time);
		$criteria->compare('hys_no',$this->hys_no);
		$criteria->compare('ljx',$this->ljx);
		$criteria->compare('ht',$this->ht);
		$criteria->compare('ykq',$this->ykq);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BsDhy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
