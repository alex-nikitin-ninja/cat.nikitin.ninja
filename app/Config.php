<?php
class Config extends Route {

	protected static $defaultConfFolder = '/app/config/';
	protected static $conf;

	function __construct() {
		// Loading all the ini files present in the config directory
		self::$defaultConfFolder = getcwd() . self::$defaultConfFolder;
		self::$conf = array();
		foreach( glob( self::$defaultConfFolder . "*.ini" ) as $file ){
			$entryName = str_replace( array( '.ini', self::$defaultConfFolder ), '', $file );
			self::$conf[$entryName] = parse_ini_file($file, true);
		}
	}

	function getConfIni($path){
		$item = self::$conf;
		foreach ($path as $k => $entry) {
			if(isset($item[$entry])){
				$item = $item[$entry];
			}else{
				$item = false;
			}
		}
		return $item;
	}

	function getDbCredentialsRead(){
		return self::$conf['main']['db'];
	}

	function getDbCredentialsWrite(){
		return self::$conf['main']['dbWrite'];
	}
	
}
