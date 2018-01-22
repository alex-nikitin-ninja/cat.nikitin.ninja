<?php
Class pingController extends Controller{

	public function index(){
		header('Access-Control-Allow-Origin: *');
		
		$r = array( 'time' => time() );
		
		self::apiResponse($r);
	}

}