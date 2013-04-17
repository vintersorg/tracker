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
	public $posterview;
	public $postermini;
	public $torrent;
	public $middlePath;
	
	public $path = array(
		'poster' => '/images/poster',
		'torrent' => '/torrents',
		'screen' => '/images/screen',
	);
	
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
			'year'			=> 'Год впуска',
			'country'		=> 'Страна',
			'actor'			=> 'Актеры',
			'producer'		=> 'Режисер',
			'category'		=> 'Категоия',
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
		$this->setAttribute('posterview',$this->getPosterPath().'active/view');
		$this->setAttribute('postermini',$this->getPosterPath().'active/mini');
		
		$middlePath = $this->idToPath();
		$this->setAttribute('middlePath', $middlePath);
		
		$posterPath = $this->getTorrentPath().$this->id.'.torrent';
		if(is_readable($_SERVER['DOCUMENT_ROOT'].$posterPath))
			$this->setAttribute('torrent', $posterPath);
		else
			$this->setAttribute('torrent', '');
	}
	public function beforeSave()
	{
		if($this->isNewRecord){
			$approve = Approves::model()->getApprove();
			$this->approve_id = $approve->id;
		}			
		return parent::beforeSave();
	}
	protected function afterSave()
	{
	    if($this->isNewRecord){
	    	$allFolders = array(
		    	'poster/active'	=> $this->getPosterPath().'/active',
		    	'screen'		=> $this->getScreenPath(),
		    	'torrent'		=> $this->getTorrentPath(),
		    );
			foreach ($allFolders as $key => $value) {
				$this->checkDirectory($value);
			}
		}
	}
	/*
	 *	получаем путь до файлов раздачи относительно id 
	 * 
	 */
	public function idToPath()
	{
		$path = '';
		
		if(empty($this->id)) return $path;
		
		$string = $this->id;
		while(strlen($string)){
			//поддиректории из 2х символов
			$step = substr($string, 0, 2);
			$string = substr_replace($string, '', 0, 2);
			if(strlen($step) == 1)
				$path .= '0'.$step;
			else
				$path .= $step;			
			if(strlen($string) >0 ) $path .= DIRECTORY_SEPARATOR;
		}
		$path = $path.DIRECTORY_SEPARATOR.$this->id.DIRECTORY_SEPARATOR;
		return $path;
	}
	public function getPosterPath()
	{		
		$dir = $this->path['poster'].DIRECTORY_SEPARATOR.$this->idToPath($this->id).DIRECTORY_SEPARATOR;
		//$this->checkDirectory($dir);
		return $dir;
	}
	public function getTorrentPath()
	{
		$dir = $this->path['torrent'].DIRECTORY_SEPARATOR.$this->idToPath($this->id).DIRECTORY_SEPARATOR;
		//$this->checkDirectory($dir);
		return $dir;
	}
	public function getScreenPath()
	{
		$dir = $this->path['screen'].DIRECTORY_SEPARATOR.$this->idToPath($this->id).DIRECTORY_SEPARATOR;
		//$this->checkDirectory($dir);
		return $dir;
	}
	public function checkDirectory($dir){
		if(!is_dir($_SERVER['DOCUMENT_ROOT'].$dir))
			try{
				mkdir($_SERVER['DOCUMENT_ROOT'].$dir, 0777, true);
			}catch(exception $e){
				throw new Exception("Не удалось создать директорию.");				
			}
		return true;
	}
	public function scopes()
    {
        return array(
            'top'=>array(
            	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>10,
            ),
             'favorites'=>array(
             	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>10,
            ),
             'recommended'=>array(
             	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>10,
            ),
            'recently'=>array(
            	'condition'=>'parent=0',
                'order'=>'id DESC',
                'limit'=>10,
            ),
        );
    }
	public function makePosterLink($filename, $type)
	{		
		$path = $_SERVER['DOCUMENT_ROOT'].$this->getPosterPath();
		//киляем старую ссылку
		if(is_readable($path.'active/'.$type)) unlink($path.'active/'.$type);		
		$target = $path.$filename; // Это уже существующий файл
		$link = $path.'active/'.$type; // Это файл, который вы хотите привязать к первому
				
		return link($target, $link);
	}
}