<?php

class TorrentEditForm extends CFormModel
{
	
	public $country;
	public $producer;
	public $actors;
	public $description;
	public $torrent_id;

	public function rules()
	{
		return array(
			// username and password are required
			array('country, producer, actors, description', 'required'),
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
			'actors'		=> 'Актеры',
			'description'	=> 'Описание',
		);
	}
	
	public function searchTags()
	{
		$tag_ids = array();
		$array = array(
			$this->country => Tagcategories::getIDByAlias('country'),
			$this->producer => Tagcategories::getIDByAlias('producer'),
			$this->actors => Tagcategories::getIDByAlias('actor'),
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
				
				if(!$link->save() && !($link->getError('exists')))
					throw new CHttpException(500, "Unable to save torrent tags.");				
			}
		if(!empty($this->description)){				
			$record = Torrents::model()->findByPk($this->torrent_id);
			$record->description = $this->description;
			if(!$record->save())
				throw new CHttpException(500, "Unable to save torrent description");
		}
	}
	public function createTorrent()
	{
		$torsModel		= new Torrents;
		$tag_ids = $this->searchTags();				
		$torrents = $torsModel->getTorrentByTags($tag_ids);
		if(empty($torrents))
		{
			$torsModel->created_by = Yii::app()->user->id;
			$torsModel->approve_id = 1;
			if($torsModel->save())
				$this->redirect(array('edit','id'=>$torsModel->id));
		}
	}
}
