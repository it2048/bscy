<?php

/**
 * This is the model class for table "arena".
 *
 * The followings are the available columns in table 'arena':
 * @property integer $id
 * @property string $sno
 * @property string $sname
 * @property integer $scate
 * @property string $simg
 * @property string $sdesc
 * @property string $ctname
 * @property integer $pid
 * @property integer $addtime
 * @property integer $publish
 */
class Arena extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Arena the static model class
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
		return 'arena';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sno, sname', 'required'),
			array('scate, pid, addtime, publish', 'numerical', 'integerOnly'=>true),
			array('sno', 'length', 'max'=>12),
			array('sname', 'length', 'max'=>64),
			array('simg, ctname', 'length', 'max'=>128),
			array('sdesc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sno, sname, scate, simg, sdesc, ctname, pid, addtime, publish', 'safe', 'on'=>'search'),
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
			'sno' => 'Sno',
			'sname' => 'Sname',
			'scate' => 'Scate',
			'simg' => 'Simg',
			'sdesc' => 'Sdesc',
			'ctname' => 'Ctname',
			'pid' => 'Pid',
			'addtime' => 'Addtime',
			'publish' => 'Publish',
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
		$criteria->compare('sno',$this->sno,true);
		$criteria->compare('sname',$this->sname,true);
		$criteria->compare('scate',$this->scate);
		$criteria->compare('simg',$this->simg,true);
		$criteria->compare('sdesc',$this->sdesc,true);
		$criteria->compare('ctname',$this->ctname,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('publish',$this->publish);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}