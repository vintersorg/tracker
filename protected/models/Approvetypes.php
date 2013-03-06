<?php

/**
 * This is the model class for table "{{approve_types}}".
 *
 * The followings are the available columns in table '{{approve_types}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property ApproveStates[] $tApproveStates
 * @property Users $user
 * @property UserRoles $role
 * @property Approves[] $approves
 */
class Approvetypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Approvetypes the static model class
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
		return '{{approve_types}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, role_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, role_id', 'safe', 'on'=>'search'),
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
			'tApproveStates' => array(self::MANY_MANY, 'ApproveStates', '{{approve_allow_states}}(type_id, state_id)'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'role' => array(self::BELONGS_TO, 'UserRoles', 'role_id'),
			'approves' => array(self::HAS_MANY, 'Approves', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'role_id' => 'Role',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}