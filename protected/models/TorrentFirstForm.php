<?php

class TorrentFirstForm extends CFormModel
{
	public $nameLocal;
	public $nameOrigin;
	public $year;
	public $isNew;

	public function rules()
	{
		return array(
			// username and password are required
			array('nameLocal, nameOrigin, year', 'required'),
			array('year', 'numerical', 'integerOnly'=>true, 'min'=>1895),
			array('isNew', 'boolean'),
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
			'isNew'=>'Создать новую раздачу',
		);
	}
	
	public function searchTags()
	{
		$tag_ids = array();
		$array = array(
			$this->nameLocal => Tagcategories::getIDByAlias('nameLocal'),
			$this->nameOrigin => Tagcategories::getIDByAlias('nameOrigin'),
			$this->year => Tagcategories::getIDByAlias('year'),
		);
		foreach($array as $value => $category_id)
		{
			//через $model->isNewRecord=true и $model->id=false пытается создать запись c id=0. почему?
			$model = new Tags;
			$tag_ids[] = $model->makeTag($value, $category_id);
		}
		return $tag_ids;
	}
	
}
