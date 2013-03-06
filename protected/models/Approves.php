<?php

/**
 * This is the model class for table "{{approves}}".
 *
 * The followings are the available columns in table '{{approves}}':
 * @property integer $id
 * @property string $created_dt
 * @property integer $created_by
 * @property integer $state_id
 * @property integer $type_id
 *
 * The followings are the available model relations:
 * @property TagCategories[] $tagCategories
 * @property TorrentGroups[] $torrentGroups
 * @property Users $createdBy
 * @property ApproveStates $state
 * @property ApproveTypes $type
 * @property Tags[] $tags
 * @property Torrents[] $torrents
 */
class Approves extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Approves the static model class
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
		return '{{approves}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by', 'required'),
			array('created_by, state_id, type_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_dt, created_by, state_id, type_id', 'safe', 'on'=>'search'),
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
			'tagCategories' => array(self::HAS_MANY, 'TagCategories', 'approve_id'),
			'torrentGroups' => array(self::HAS_MANY, 'TorrentGroups', 'approve_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'state' => array(self::BELONGS_TO, 'ApproveStates', 'state_id'),
			'type' => array(self::BELONGS_TO, 'ApproveTypes', 'type_id'),
			'tags' => array(self::HAS_MANY, 'Tags', 'approve_id'),
			'torrents' => array(self::HAS_MANY, 'Torrents', 'approve_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_dt' => 'Created Dt',
			'created_by' => 'Created By',
			'state_id' => 'State',
			'type_id' => 'Type',
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
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getApprove($id='',$type_id='')
	{
		return $this->setApprove($id, '', $type_id);
	}
	public function setApprove($id='', $state_id='', $type_id='')
	{
		
		if(empty($id))
		{
			$model = new self;
			$model->state_id = 1;
			$model->type_id = (empty($type_id))?1:$type_id;
			$model->created_by = Yii::app()->user->id;
			$model->save();
				
			return $model;
		}
		$record = $this->findByPk($id);
		if(!empty($type_id) || !empty($state_id))
		{
			$record->type_id = (empty($type_id))?$record->type_id:$type_id;
			$record->state_id = (empty($state_id))?$record->state_id:$state_id;
			$record->save();
		}
		return $record;
	}
}