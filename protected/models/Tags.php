<?php

/**
 * This is the model class for table "{{tags}}".
 *
 * The followings are the available columns in table '{{tags}}':
 * @property integer $id
 * @property string $created_dt
 * @property integer $created_by
 * @property integer $approve_id
 * @property string $caption
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property Approves $approve
 * @property Torrents[] $tTorrents
 */
class Tags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tags the static model class
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
		return '{{tags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('approve_id, created_by, caption, category_id', 'required'),
			//array('created_by, approve_id', 'numerical', 'integerOnly'=>true),
			array('caption', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_dt, created_by, approve_id, caption', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'approve' => array(self::BELONGS_TO, 'Approves', 'approve_id'),
			'category' => array(self::BELONGS_TO, 'Tagcategories', 'category_id'),
			'tTorrents' => array(self::MANY_MANY, 'Torrents', '{{torrent_tags}}(id, torrent_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Тэг',
			'created_dt' => 'Дата создания',
			'created_by' => 'Автор',
			'approve_id' => 'Approve',
			'caption' => 'Название',
			'category_id' => 'Карегория',
			'category' => 'Карегория',
			'author' => 'Автор',
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
		$criteria->compare('approve_id',$this->approve_id);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('category_id',$this->category_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTagByCategory($cat)
	{
		$tags = $this->findAllByAttributes(array(), 'category_id = :category_id', array(':category_id' => $cat));
		return $tags;
	}
	public function getCat($catName='')
	{
		return $this->getTagByCategory(Tagcategories::getIDByAlias($catName));
	}
	public function makeTag($value='', $category_id = 1)
	{
		$tag = $this->findByAttributes(array(), 
			'lower(caption) = lower(:caption)', 
			array(':caption' => $value
		));
		
		if(!isset($tag->id)){
			
			$this->caption		= $value;
			$this->created_by	= Yii::app()->user->id;
			$this->category_id	= $category_id;
			$this->approve_id 	= 1;
			
			if($this->validate() && $this->save())			
				return $this->id;			
			else
				throw new CHttpException(500, "Unable to save tags data");
			
		}else{
			return $tag->id;
		}
	}
	public function getTagsByAlias($alias='')
	{
		return CHtml::listData($this->getTagByCategory(Tagcategories::getIDByAlias($alias)), 'id', 'caption');
	}
}