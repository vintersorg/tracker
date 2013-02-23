<?php

class TorrentEditForm extends CFormModel
{
	public $nameLocal;
	public $nameOrigin;
	public $year;
	public $isNew;
	/*
	public $genre;
	public $country;
	public $producer;
	*/

	public function rules()
	{
		return array(
			// username and password are required
			array('nameLocal, nameOrigin, year', 'required'),
			array('year', 'numerical', 'integerOnly'=>true, 'min'=>1800),
			array('isNew', 'boolean'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'nameLocal' => 'Название',
			'nameOrigin' => 'Оригинальное название',
			'year' => 'Год выпуска',
			'isNew'=>'Создать новую раздачу',
		);
	}
	
	public function searchTorrentGroup()
	{
		$tag_id = 1;
		$torrent = Torrenttags::model()->findAllByAttributes(array(), 
			'tag_id = :tag_id', 
			array(':tag_id' => $tag_id
		));
	}
	
	public function searchTags()
	{
		$tag_ids = array();
		$model = new Tags;
		$array = array(
			$this->nameLocal => 4,
			$this->nameOrigin => 3,
			$this->year => 5,
		);
		foreach($array as $value => $category_id)
		{
			$tag_ids[] = $model->makeTag($value, $category_id);			
		}
		return $tag_ids;
	}
	
}
