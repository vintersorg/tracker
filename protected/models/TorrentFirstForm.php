<?php

class TorrentFirstForm extends CFormModel
{
	public $nameLocal;
	public $nameOrigin;
	public $year;
	public $category;
	
	public function rules()
	{
		return array(
			// username and password are required
			array('category, nameLocal, nameOrigin, year', 'required'),
			array('year', 'numerical', 'integerOnly'=>true, 'min'=>1895)
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'nameLocal' => 'Локализованное название',
			'nameOrigin' => 'Оригинальное название',
			'year' => 'Год выпуска',
			'category'=>'Категория',
		);
	}
	
	public function searchTags()
	{
		$tag_ids = array();
		$array = array(
			$this->nameLocal => Tagcategories::getIDByAlias('nameLocal'),
			$this->nameOrigin => Tagcategories::getIDByAlias('nameOrigin'),
			$this->year => Tagcategories::getIDByAlias('year'),
			$this->category => Tagcategories::getIDByAlias('category'),
		);
		
		foreach($array as $value => $category_id)
		{
			$model = new Tags;
			$tag_ids[] = $model->makeTag($value, $category_id);
		}
		return $tag_ids;
	}
	public function createTorrent()
	{
		//ищем ИД тэгов, если нет
		$tag_ids	= $this->searchTags();			
		$torrents = Torrents::model()->getTorrentByTags($tag_ids);
		
		if(empty($torrents))
		{
			$torsModel	= new Torrents;
			$torsModel->created_by = Yii::app()->user->id;
			$torsModel->approve_id = 1;
			if($torsModel->save())
			{
				foreach($tag_ids as $tag_id)
				{
					$link = new Torrenttags;
					$link->torrent_id = $torsModel->id;
					$link->tag_id = $tag_id;
					$link->created_by = Yii::app()->user->id;
					if(!$link->save() && !($link->getError('exists')))
						throw new CHttpException(500, "Unable to save torrent tags.");
									
				}
				return array('created'=>true, 'torrent_id'=>$torsModel->id);
			}
			else
			{
				throw new CHttpException(500, "Unable to save torrent.");
			}
		}else
		{
			return array('created'=>false, 'torrents'=>$torrents);
		}
	}
	
}
