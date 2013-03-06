<?php

class TorrentChoisForm extends CFormModel
{
	public $torrentGroup;
		
	public function rules()
	{
		return array(
			// username and password are required
			array('torrentGroup', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'torrentGroup' => 'Найденые торренты',
		);
	}
	
}
