<?php

/**
 * This is the model class for table "{{torrent_tags}}".
 *
 * The followings are the available columns in table '{{torrent_tags}}':
 * @property integer $torrent_id
 * @property integer $tag_id
 * @property string $created_dt
 * @property integer $created_by
 */
class Torrenttags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Torrenttags the static model class
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
		return '{{torrent_tags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('torrent_id, tag_id, created_by', 'required'),
			array('torrent_id, tag_id, created_by', 'numerical', 'integerOnly'=>true),
			array('tag_id', 'uniqueTorrentAndTag'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('torrent_id, tag_id, created_dt, created_by', 'safe', 'on'=>'search'),
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
			'torrent' => array(self::BELONGS_TO, 'Torrents', 'torrent_id'),
			'tag' => array(self::BELONGS_TO, 'Tags', 'tag_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'torrent_id' => 'Torrent',
			'tag_id' => 'Tag',
			'created_dt' => 'Created Dt',
			'created_by' => 'Created By',
			'author' => 'Автор',
			'torrent' => 'Торрент',
			'tag' => 'Тэг',
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

		$criteria->compare('torrent_id',$this->torrent_id);
		$criteria->compare('tag_id',$this->tag_id);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('torrent',$this->torrent->id);
		$criteria->compare('tag',$this->tag->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function uniqueTorrentAndTag($attribute,$params=array())
	{
	    if(!$this->hasErrors())
	    {
	        $params['criteria']=array(
	            'condition'=>'torrent_id=:torrent_id',
	            'params'=>array(':torrent_id'=>$this->torrent_id),
	        );
	        $validator=CValidator::createValidator('unique',$this,$attribute,$params);
	        $validator->validate($this,array($attribute));
	    }
	}
}