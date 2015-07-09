<?php

/**
 * This is the model class for table "authitem".
 *
 * The followings are the available columns in table 'authitem':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Authassignment[] $authassignments
 * @property Authitemchild[] $authitemchildren
 * @property Authitemchild[] $authitemchildren1
 */
class Authitem extends CActiveRecord {
    public $oldName; //保存主键

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Authitem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'authitem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type', 'required'),
            array('type', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 64),
            array('description, bizrule, data', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('name, type, description, bizrule, data', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'authassignments' => array(self::HAS_MANY, 'Authassignment', 'itemname'),
            'authitemchildren' => array(self::HAS_MANY, 'Authitemchild', 'parent'),
            'authitemchildren1' => array(self::HAS_MANY, 'Authitemchild', 'child'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'bizrule' => 'Bizrule',
            'data' => 'Data',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('bizrule', $this->bizrule, true);
        $criteria->compare('data', $this->data, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function afterDelete() {
        parent::afterDelete();
        Authassignment::model()->deleteAll("itemname='" . $this->name . "'");
        Authitemchild::model()->deleteAll("parent='" . $this->name . "'");
        Authitemchild::model()->deleteAll("child='" . $this->name . "'");
    }

    protected function afterSave() {
        parent::afterSave();
        $this->data = unserialize($this->data);
        if ($this->oldName != $this->name) {
            //更新关联的三张表
            $this->model()->updateByPk($this->oldName, array("name" => $this->name));
            $criteria = new CDbCriteria();
            $criteria->condition = "itemname='" . $this->oldName . "'";
            Authassignment::model()->updateAll(array('itemname' => $this->name), $criteria);
            $criteria->condition = "parent='" . $this->oldName . "'";
            Authitemchild::model()->updateAll(array('parent' => $this->name), $criteria);
            $criteria->condition = "child='" . $this->oldName . "'";
            Authitemchild::model()->updateAll(array('child' => $this->name), $criteria);
        }
    }

}