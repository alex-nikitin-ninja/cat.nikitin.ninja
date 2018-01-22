<?php
Class carsController extends Controller{

	public function index($params){

		$params = trim($params);
		if (strlen($params)>0) {
			$params = explode('/', $params);
		} else {
			$params = ['index'];
		}

		$recvParams = self::recvParams();
		$carsHelper = new carsHelper();
		$r = $carsHelper->run($params, $recvParams);

		if(is_string($r)) {
			self::apiResponse($r);
		} else {
			if(isset($r[1]['type']) && $r[1]['type']=='json' ){
				self::apiResponse($r[1]);
			} else {
				self::renderTemplate($r[0], $r[1]);
			}
		}

	}

	public function all($params){

		self::renderTemplate('cars/all', []);
	}

}
