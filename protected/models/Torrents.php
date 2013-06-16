<?php

/**
 * This is the model class for table "{{torrents}}".
 *
 * The followings are the available columns in table '{{torrents}}':
 * @property integer $id
 * @property string $created_dt
 * @property integer $created_by
 * @property integer $approve_id
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property Approves $approve
 * @property TorrentGroups[] $torrentGroups
 * @property Tags[] $tTags
 */
class Torrents extends CActiveRecord
{
	
	public $none;
	public $nameOrigin;
	public $nameLocal;
	public $year;
	public $country;
	public $actor;
	public $producer;
	public $category;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Torrents the static model class
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
		return '{{torrents}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by',  'required'),
			array('created_by, approve_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_dt, created_by, approve_id, description, torrent_file', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'approve' => array(self::BELONGS_TO, 'Approves', 'approve_id'),
			'torrentGroups' => array(self::HAS_MANY, 'TorrentGroups', 'torrent_id'),
			'torrenttags' => array(self::HAS_MANY, 'Torrenttags', 'torrent_id'),
			'tag' =>  array(self::HAS_MANY, 'Tags', 'id'),
			'children'=>array(self::HAS_MANY, 'Torrents', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'			=> 'ID',
			'created_dt'	=> 'Created Dt',
			'created_by'	=> 'Created By',
			'approve_id'	=> 'Approve',
			'description'	=> 'Описание',
			'torrenttags'	=> 'Тэги',
			'nameLocal'		=> 'Локализованное название',
			'nameOrigin'	=> 'Оригинальное название',
			'year'			=> 'Год выпуска',
			'country'		=> 'Страна',
			'actor'			=> 'Актеры',
			'producer'		=> 'Режиссер',
			'category'		=> 'Категория',
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
		$criteria->compare('description',$this->description);
		$criteria->compare('nameLocal',$this->nameLocal);
		$criteria->compare('nameOrigin',$this->nameOrigin);
		$criteria->compare('year',$this->year);
		$criteria->compare('country',$this->country);
		$criteria->compare('actor',$this->actor);
		$criteria->compare('producer',$this->producer);
		$criteria->compare('category',$this->category);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTorrentByTags($tags = array())
	{
		//собираем модель с найденными раздачами, у которых есть все указанные тэги
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, COUNT(tt.tag_id) AS tagsCount';		
		$criteria->join = 'join {{torrent_tags}} as tt on tt.torrent_id=t.id';
		$criteria->addInCondition('tag_id', $tags);		
		$criteria->group='id';
		$criteria->having='count(tag_id)=:tagsCount';
		$criteria->params[':tagsCount'] = count($tags);
		$torrents = new CActiveDataProvider('Torrents', array('criteria' => $criteria));
		//$torrents = self::model()->findAll($criteria); 	
		
		return $torrents;
	}
	public function tagSearch($search)
	{
		$search = addcslashes($search, '%_'); // escape LIKE's special characters
		//переделать на sphinx
		$this->getDbCriteria()->mergeWith(array(
			'distinct'	=> true,
			'condition'	=> 'parent=0 AND (tag.caption ilike :search_all OR tag.caption ilike :search_before OR tag.caption ilike :search_after)', // no quotes around :search
        	'join'		=> 'join {{torrent_tags}} as tt on tt.torrent_id=t.id join {{tags}} as tag on tag.id=tt.tag_id',
        	'params'    => array(':search_all' => "%$search%",':search_before' => "%$search",':search_after' => "$search%"),  // Aha! Wildcards go here
            'order'		=> 'id DESC',
            'limit'		=> 100,	
	   ));   
	   
	   return $this;
	}
	public function loadModel($id)
	{
		$model=self::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/*
	 *	Кривореализованный поиск имени тега
	 * (кто сделае лучше - дам пряник) 
	 * 
	 */
	public function getTagNameByAlias($alias = '')
	{
		
		$category_id = Tagcategories::getIDByAlias($alias);
		
		$tagsModel = Torrenttags::model()->findAllByAttributes(array('torrent_id' => $this->id));		
		$list = CHtml::listData($tagsModel, 'tag_id', 'torrent_id');
		if(empty($list)) return '';
		
		$tag_ids = array_keys($list);
		$record = Tags::model()->findByAttributes(array('category_id' => $category_id, 'id'=> $tag_ids));
		
		return (empty($record->caption))?'':$record->caption;
		
	}
	/*
	 * После создания модели добавляем необходимые поля 
	 * 
	 */
	public function afterFind()
	{
		
		$group = array();
		//разбираем по кучкам
		foreach($this->torrenttags as $key => $value)
		{
			$group[$value->tag->category->alias][] =  $value->tag->caption;
		}
		//собираем строку
		foreach($group as $alias => $array_values)
		{
			$this->setAttribute($alias, implode(', ', $array_values));
		}
	
	}
	public function beforeSave()
	{
		if($this->isNewRecord){
			$approve = Approves::model()->getApprove();
			$this->approve_id = $approve->id;
		}			
		return parent::beforeSave();
	}
	
	public function scopes()
    {
        return array(
            'top'=>array(
            	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>3,
            ),
             'favorites'=>array(
             	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>3,
            ),
             'recommended'=>array(
             	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>7,
            ),
            'recently'=>array(
            	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>7,
            ),
            'video'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=22',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'tv'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=22',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'films'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=22',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'klip'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=22',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'serial'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=22',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'games'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=23',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'soft'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=28',
                'order'=>'id DESC',
                'limit'=>50,
            ),
            'music'=>array(
            	'condition'=>'parent=0',
            	'join' => 'join {{torrent_tags}} as tt on tt.torrent_id=t.id',
            	'condition' => 'tag_id=21',
                'order'=>'id DESC',
                'limit'=>50,
            ),
        );
    }
}