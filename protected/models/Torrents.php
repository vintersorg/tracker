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
			array('created_by, approve_id', 'required'),
			array('created_by, approve_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_dt, created_by, approve_id, description', 'safe', 'on'=>'search'),
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
			'tTags' => array(self::MANY_MANY, 'Tags', '{{torrent_tags}}(torrent_id, tag_id)'),
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
			'approve_id' => 'Approve',
			'description'=> 'Описание',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getTorrentByTags($tags = array())
	{
		$link = new Torrenttags;
		$tors = $link->findAllByAttributes(array('tag_id' => $tags));
		return $tors;
	}
	public function loadModel($id)
	{
		$model=self::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}