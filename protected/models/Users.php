<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property integer $role_id
 * @property string $created_dt
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $gender
 * @property string $birthday
 * @property string $description
 *
 * The followings are the available model relations:
 * @property UserRoles $role
 * @property ApproveTypes[] $approveTypes
 * @property Tags[] $tags
 * @property Torrents[] $torrents
 * @property TorrentGroups[] $torrentGroups
 * @property Approves[] $approves
 * @property ApproveStates[] $approveStates
 */
class Users extends CActiveRecord
{
	public $gendername;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email, role_id, username, identity, network', 'required'),
			array('username','unique', 'className' => 'Users'),
			array('email','uniqueIdentityAndEmail',),
			array('role_id, gender', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>1000),
			array('birthday, description', 'safe'),
			array('birthday', 'type', 'type' => 'date', 'message' => '{attribute}: это не дата!', 'dateFormat' => 'yyyy-MM-dd'),
			array('email', 'email', 'message' => '{attribute}: это не email!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, role_id, created_dt, username, password, email, gender, birthday, description', 'safe', 'on'=>'search'),
		);
	}
	
	public function uniqueIdentityAndEmail($attribute,$params=array())
	{
	    if(!$this->hasErrors())
	    {
	        $params['criteria']=array(
	            'condition'=>'identity=:identity AND email=:email',
	            'params'=>array(':identity'=>$this->identity, ':email'=>$this->email),
	        );
	        $validator=CValidator::createValidator('unique',$this,$attribute,$params);
	        $validator->validate($this,array($attribute));
	    }
	} 
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			'approveTypes' => array(self::HAS_MANY, 'ApproveTypes', 'user_id'),
			'tags' => array(self::HAS_MANY, 'Tags', 'created_by'),
			'torrents' => array(self::HAS_MANY, 'Torrents', 'created_by'),
			'torrentGroups' => array(self::HAS_MANY, 'TorrentGroups', 'created_by'),
			'approves' => array(self::HAS_MANY, 'Approves', 'created_by'),
			'approveStates' => array(self::HAS_MANY, 'ApproveStates', 'created_by'),
			//'gendername'=>array(self::BELONGS_TO, 'Genders', array(0 => '', 1 => 'Мужской', 2 => 'Женский',),'through'=>'posts'),	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Класс',
			'created_dt' => 'Дата создания',
			'username' => 'Отобржаемое имя',
			'password' => 'Пароль',
			'email' => 'Email',
			'gender' => 'Пол',
			'birthday' => 'Дата рождения',
			'description' => 'Немного о себе',
			'gendername' => 'Пол',
			'identity' => 'Identity',
			'network' => 'Network',
			'state' => 'State',
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
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('identity',$this->identity,true);
		$criteria->compare('network',$this->network,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeSave()
	{
		if($this->isNewRecord){
			$approve = Approves::model()->getApprove();
			$this->approve_id = $approve->id;
		}
		if(empty($this->birthday)) $this->birthday = null;
		 			
		return parent::beforeSave();
	}
	//получаем текстовое значение Пола
	public function AfterFind()
	{
		if(isset($this->gender))
	    	$this->gendername = Data::$genders[$this->gender];
	}
}