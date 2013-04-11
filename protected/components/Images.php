<?php
/*
 * Класс работы с изображениями
 * 
 * 
 * 
 * 
 * 
 */
class Images 
{
	public static $emptyImages = array(
		'posterview' => '/images/empty/posterview.png',
		'empty' => '/images/empty/empty.png',
		'postermini' => '/images/empty/postermini.png',
	);
	public static function setActive($src, $type)
	{
		if(empty($src) || empty($type)) return false;
		
		return true;
	}
	public static function src($src='', $type='', $width=0, $height=0)
	{
		if (!is_readable($_SERVER['DOCUMENT_ROOT'].$src)) {
			if(empty($type) || !isset(self::$emptyImages[$type]))
				return self::$emptyImages['empty'];
			return self::$emptyImages[$type];
		}
		return $src;
	}
}
