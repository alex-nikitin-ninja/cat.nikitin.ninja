<?php
Class carsHelper extends Helper{
	
	// should not be used much - maybe needs to be removed

	public function index($getParams, $postParams){
		// $alertsModel = new messagesModel();
		$r = array(
			"pageTitle" => 'Cars Index Page',
			"get" => $getParams,
			"post" => $postParams,
			// $alertsModel->now(),
			// $alertsModel->isConnected(),
		);
		return ['cars/index', $r];
	}
	
	public function list($getParams, $postParams){
		$r = [
			// "type" => 'json',
			"pageTitle" => 'Cars Listings',
			"get" => $getParams,
			"post" => $postParams,
		];
		
		return ['cars/list', $r];
	}

}