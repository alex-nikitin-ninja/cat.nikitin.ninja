<?php
Class v1Controller extends Controller{

	public function info(){
		$r = array(
			'version' => '1.0',
			'description' => 'Version 1.0',
			'intro' => 'Welcome to nikitin.ninja api back-end service (developed by Alex Nikitin https://alex.nikitin.ninja/)',
			'message' => 'It\'s fully OOP and docker friendly',
			'git_clone_ssh' => 'git@github.com:alex-nikitin-ninja/api.nikitin.ninja.git',
			'git_repo' => 'https://github.com/alex-nikitin-ninja/api.nikitin.ninja',
			'git_more' => 'https://github.com/alex-nikitin-ninja/',
		);
		
		self::apiResponse($r);
	}

	public function testWParams(){
		// Sample
		// passing get parameters
		// /api/v1/testWParams?t=tt
		$recvParams = self::localVar('get');
		// passing post parameters
		// $recvParams = self::recvParams();

		self::apiResponse($recvParams);
	}

	// Messages
	public function messages($params){
		$params = trim($params);
		if (strlen($params)>0) {
			$params = explode('/', $params);
		} else {
			$params = false;
		}
		$recvParams = self::recvParams();
		$messagesHelper = new messagesHelper();
		$r = $messagesHelper->run($params, $recvParams);
		self::apiResponse($r);
	}

}
