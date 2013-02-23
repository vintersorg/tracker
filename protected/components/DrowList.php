<?php
class DrowList extends CApplicationComponent 
{
	/**
	* Calls the {@link registerScripts()} method.
	*/
	public function init() {
		parent::init();	
	}
	
	public static function torrents($model)
	{
		$torrets = CHtml::listData($model, 'id', 'created_dt');
		
		$output = '';
		//print_r($torrets);
		$output .= '<div  class="info">';
		$output .= '<ul class="flashes">';
	    foreach($torrets as $key => $value) {
	        $output .= '<li class="flash-' . $key . '">' . $value . '</li>';  
	    }  
		$output .= '</ul>';
		$output .= '</div>';
	
		return $output;
	}
}
