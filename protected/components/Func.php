<?php
class Func {
	
	public static function arrayValToKey($input_array=array())
	{
		$output_array = array();
		foreach($input_array as $key => $value)
		{
			$output_array[$value] = $value;
		}
		return $output_array;
	}
	public static function arrayToButton($input_array=array(), $field='')
	{
		$output_array = array();
		$counter = 0;
		foreach($input_array as $key => $value)
		{
			$output_array[$counter]['label'] = $value;
			$output_array[$counter]['htmlOptions']['data-field'] = $field;
			$output_array[$counter]['htmlOptions']['data-value'] = $value;			
			
			$counter++;
		}
		return $output_array;
	}
	/*
	 * Собирает путь до картинки (файла?)
	 * params:
	 * (char)type = тип
	 * (char)size = размер
	 * (int)id = id раздачи
	 * (boolean)empty = true - выдать файл заглушку
	 * return
	 * 	(char)filePath
	 */
	public static function getFilePath($type, $id, $size='original')
	{		
		$filePath	= '';		
		$filePath	.=	$_SERVER['DOCUMENT_ROOT'];
		$filePath	.=	Yii::app()->params['filePath'][$type];
		$filePath	.=	self::getMiddlePath($id);		
		$filePath	.=	Yii::app()->params['filePath'][$size];
		//если папки нет, создаем
		if(!file_exists($filePath)) mkdir($filePath, 0777, true);
		
		return $filePath;
	}
		/*
	 * получаем путь до файлов раздачи относительно id 
	 * params:
	 * (int)id = id раздачи
	 * return
	 * 	(stream)image not null
	 */
	public static function getMiddlePath($id)
	{
		$path = '';
		
		if(empty($id)) return $path;
		
		$string = $id;
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
		$path = $path.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
		return $path;
	}
	public static function getfileName($pathList=array())
	{
		$nameList = array();
		
		foreach ($pathList as $key => $value) {
			$info = pathinfo($value);
			$nameList[] = $info['filename'].'.'.$info['extension'];
		}
		return $nameList;
	}
	/*
	 * Кладем папку на винт
	 * params:
	 * (char)filePath = путь до файла
	 * return
	 * 	(json array)about file
	 */
	public static function putFile($filePath, $type)
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");			
		$uploader = new qqFileUploader(Yii::app()->params['fileAllowedExtensions'][$type], Yii::app()->params['fileSizeLimit'][$type]);
		//true - перезапись файла. иначе будет менять имя. нам вроде без разницы, но и файлы плодить не нужно
		return $uploader->handleUpload($filePath);
	}
	/*
	 * Выдает картинку потоком
	 * params:
	 * (char)type = тип
	 * (char)size = размер
	 * (int)id = id раздачи
	 * return
	 * 	(stream)image not null
	 */
	public static function getImage($type, $size, $id, $filename)
	{			
		$filePath = self::getFilePath($type, $id, $size);
		//VarDumper::dump($filePath.$filename);exit;
		//смотрим файл
		if(is_readable($filePath.$filename)){
				Yii::app()->phpThumb->create($filePath.$filename)->show();
		}elseif($size != 'original'){
			$filePathOrigin	= self::getFilePath($type, $id);
			list($width, $height) = Yii::app()->params['imageSize'][$type][$size];				
			Yii::app()->phpThumb->create($filePathOrigin.$filename)
				->adaptiveResize($width,$height)->save($filePath.$filename)->show();			
		}		
	}
}
