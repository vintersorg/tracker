<?php

class TorrentFirstForm extends CFormModel
{
	public $nameRu;
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
			array('nameRu, nameOrigin, year', 'required'),
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
			'nameRu' => 'Название',
			'nameOrigin' => 'Оригинальное название',
			'year' => 'Год выпуска',
			'isNew'=>'Создать новую раздачу',
		);
	}

}