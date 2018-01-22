<?php
Class Controller extends Route {

	/**
	 * The function renders just regular html error
	 * @param  int $code error code
	 */
	public function error($code){
		$error = new errorHelper();
		$errorDescription = $error->getDescription($code);

		http_response_code($code);
		
		$r = array(
			'errorCode' => $code,
			'errorDescription' => $errorDescription,
		);

		self::renderTemplate($r, 'Error', $code);
	}

	public function redirect($newUrl, $permanent = true){
		if( !$permanent ){
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
		}
		header('Location: ' . $newUrl, true, $permanent ? 301 : 302);
		exit();
	}

	/**
	 * Makes correct api response 
	 * @param  mixed $data         response data
	 * @param  string  $status     status
	 * @param  string  $statusCode status code
	 */
	public function apiResponse($data = false, $status = 'OK', $statusCode = '200'){
		// ob_start("ob_gzhandler");
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');

		$r = array(
			'status' => $status,
			'code' => $statusCode,
			'time' => time(),
			'data' => $data
		);

		echo json_encode($r);
	}

	/**
	 * Makes html template 
	 * @param  mixed $data         response data
	 * @param  string  $status     status
	 * @param  string  $statusCode status code
	 */
	public function renderTemplate($data = false, $status = 'OK', $statusCode = '200', $templateName = false){
		// ob_start("ob_gzhandler");
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');

		$r = array(
			'status' => $status,
			'code' => $statusCode,
			'time' => time(),
			'data' => $data,
			'templateName' => $templateName === false ? 'Template is not defined' : $templateName
		);

		echo json_encode($r);
	}

}