<?php
Class messagesHelper extends Helper{

	public function index($getParams, $postParams){
		$alertsModel = new messagesModel();
		$r = array(
			$getParams,
			$postParams,
			$alertsModel->now(),
			$alertsModel->isConnected(),
		);
		return $r;
	}
}