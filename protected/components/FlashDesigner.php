<?php

class FlashDesigner extends CApplicationComponent{
	
	/**
	* Calls the {@link registerScripts()} method.
	*/
	public function init() {
		parent::init();	
	}
	
	public static function flashSummary()
	{
		$output = '';
		$messages = Yii::app()->user->getFlashes();  
		if ($messages) {
			$output .= '<div  class="info">';
			$output .= '<ul class="flashes">';
		    foreach($messages as $key => $message) {
		        $output .= '<li class="flash-' . $key . '">' . $message . '</li>';  
		    }  
			$output .= '</ul>';
			$output .= '</div>';
		}
		return $output;
	}
}
