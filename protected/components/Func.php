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
	public static function pre($array=array())
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}
