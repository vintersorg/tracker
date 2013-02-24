<?php

class TorrentEditForm extends CFormModel
{
	
	public $country;
	public $producer;
	public $actor;
	public $description;
	public $torrent_id;
	

	public function rules()
	{
		return array(
			// username and password are required
			array('country, producer, actor, description', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'country'		=> 'Страна',
			'producer'		=> 'Режисер',
			'actor'			=> 'Актеры',
			'description'	=> 'Описание',
		);
	}
	
	public function searchTags()
	{
		$tag_ids = array();
		$array = array(
			$this->country => Tagcategories::getIDByAlias('country'),
			$this->producer => Tagcategories::getIDByAlias('producer'),
			$this->actor => Tagcategories::getIDByAlias('actor'),
		);
		foreach($array as $value => $category_id)
		{
			//через $model->isNewRecord=true и $model->id=false пытается создать запись c id=0. почему?
			$model = new Tags;
			$tag_ids[] = $model->makeTag($value, $category_id);
		}
		return $tag_ids;
	}
	public function saveTorrent()
	{
		
		$tag_ids = $this->searchTags();
		if(!empty($tag_ids))
			foreach($tag_ids as $tag_id)
			{
				$link = new Torrenttags;
				$link->torrent_id = $this->torrent_id;
				$link->tag_id = $tag_id;
				$link->created_by = Yii::app()->user->id;
				
				if(!$link->save() && !($link->getError('tag_id')))
					throw new CHttpException(500, "Unable to save torrent tags.");				
			}
		if(!empty($this->description)){				
			$record = Torrents::model()->findByPk($this->torrent_id);
			$record->description = $this->description;
			if(!$record->save())
				throw new CHttpException(500, "Unable to save torrent description");
		}
	}
	public function getAdditionalFields()
	{
		$torrents = Torrents::model()->findByPk($this->torrent_id);
		if(!isset($torrents)) return;
		$this->setAttribute('country', $torrents->getTagNameByAlias('country'));
		$this->setAttribute('producer', $torrents->getTagNameByAlias('producer'));
		$this->setAttribute('actor', $torrents->getTagNameByAlias('actor'));
	}
	public function setAttribute($name,$value)
	{
	    if(property_exists($this,$name))
	        $this->$name=$value;
	    elseif(isset($this->getMetaData()->columns[$name]))
	        $this->_attributes[$name]=$value;
	    else
	        return false;
	    return true;
	}
}
