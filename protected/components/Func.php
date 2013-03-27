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
}
