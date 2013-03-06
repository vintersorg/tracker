<?php

/**
 * This is the model class for table "{{approve_states}}".
 *
 * The followings are the available columns in table '{{approve_states}}':
 * @property integer $id
 * @property string $caption
 * @property string $created_dt
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property ApproveTypes[] $tApproveTypes
 * @property Approves[] $approves
 * @property Users $createdBy
 */
class Approvestates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Approvestates the static model class
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
		return '{{approve_states}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caption, created_dt, created_by', 'required'),
			array('created_by', 'numerical', 'integerOnly'=>true),
			array('caption', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, caption, created_dt, created_by', 'safe', 'on'=>'search'),
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
			'tApproveTypes' => array(self::MANY_MANY, 'ApproveTypes', '{{approve_allow_states}}(state_id, type_id)'),
			'approves' => array(self::HAS_MANY, 'Approves', 'state_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'caption' => 'Caption',
			'created_dt' => 'Created Dt',
			'created_by' => 'Created By',
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
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}