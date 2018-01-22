<?php
Class Helper {

	public function run($getParams, $postParams){
		$r = false;
		if($getParams!==false && count($getParams)>0){
			$r = $getParams;
			if(method_exists($this, $getParams[0])){
				$method = $getParams[0];
				array_shift($getParams);

				$r = $this->$method($getParams, $postParams);
			}else{
				$r = 'Method does not exists';
			}
		} else {
			$r = 'Parameters are required';
		}
		return $r;
	}

}