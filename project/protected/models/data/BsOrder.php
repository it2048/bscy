<?php

/**
 * This is the model class for table "bs_order".
 *
 * The followings are the available columns in table 'bs_order':
 * @property integer $id
 * @property string $emp_id
 * @property string $q_jl
 * @property string $qy_jl
 * @property string $wj_lx
 * @property string $wj_tk
 * @property string $wj_sj
 * @property string $wj_jl
 * @property string $fj
 * @property integer $tj_time
 * @property integer $sx_time
 * @property string $stage
 * @property string $admin
 * @property string $ct_no
 * @property integer $type
 * @property integer $ja_time
 * @property integer $wj_time
 * @property string $yg_name
 * @property string $yg_zw
 * @property string $yg_ct
 * @property string $tz_email
 * @property string $sfz
 */
class BsOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BsOrder the static model class
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
		return 'bs_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ct_no, type, sfz', 'required'),
			array('tj_time, sx_time, type, ja_time, wj_time', 'numerical', 'integerOnly'=>true),
			array('emp_id, q_jl, qy_jl, admin, ct_no', 'length', 'max'=>45),
			array('wj_lx, wj_tk, stage, yg_ct, tz_email', 'length', 'max'=>128),
			array('yg_name', 'length', 'max'=>36),
			array('yg_zw', 'length', 'max'=>64),
			array('sfz', 'length', 'max'=>24),
			array('wj_sj, wj_jl, fj', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, emp_id, q_jl, qy_jl, wj_lx, wj_tk, wj_sj, wj_jl, fj, tj_time, sx_time, stage, admin, ct_no, type, ja_time, wj_time, yg_name, yg_zw, yg_ct, tz_email, sfz', 'safe', 'on'=>'search'),
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
			'emp_id' => 'Emp',
			'q_jl' => 'Q Jl',
			'qy_jl' => 'Qy Jl',
			'wj_lx' => 'Wj Lx',
			'wj_tk' => 'Wj Tk',
			'wj_sj' => 'Wj Sj',
			'wj_jl' => 'Wj Jl',
			'fj' => 'Fj',
			'tj_time' => 'Tj Time',
			'sx_time' => 'Sx Time',
			'stage' => 'Stage',
			'admin' => 'Admin',
			'ct_no' => 'Ct No',
			'type' => 'Type',
			'ja_time' => 'Ja Time',
			'wj_time' => 'Wj Time',
			'yg_name' => 'Yg Name',
			'yg_zw' => 'Yg Zw',
			'yg_ct' => 'Yg Ct',
			'tz_email' => 'Tz Email',
			'sfz' => 'Sfz',
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
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('q_jl',$this->q_jl,true);
		$criteria->compare('qy_jl',$this->qy_jl,true);
		$criteria->compare('wj_lx',$this->wj_lx,true);
		$criteria->compare('wj_tk',$this->wj_tk,true);
		$criteria->compare('wj_sj',$this->wj_sj,true);
		$criteria->compare('wj_jl',$this->wj_jl,true);
		$criteria->compare('fj',$this->fj,true);
		$criteria->compare('tj_time',$this->tj_time);
		$criteria->compare('sx_time',$this->sx_time);
		$criteria->compare('stage',$this->stage,true);
		$criteria->compare('admin',$this->admin,true);
		$criteria->compare('ct_no',$this->ct_no,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('ja_time',$this->ja_time);
		$criteria->compare('wj_time',$this->wj_time);
		$criteria->compare('yg_name',$this->yg_name,true);
		$criteria->compare('yg_zw',$this->yg_zw,true);
		$criteria->compare('yg_ct',$this->yg_ct,true);
		$criteria->compare('tz_email',$this->tz_email,true);
		$criteria->compare('sfz',$this->sfz,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}