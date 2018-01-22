<?php
Class MysqlDao extends Route{

	private $db;
	private $dbWrite;
	private static $lastError = '';

	public function __construct(){
		$dbConfig = self::$config->getDbCredentialsRead();
		$this->db = $this->connect($dbConfig);
		
		$dbConfig = self::$config->getDbCredentialsWrite();
		$this->dbWrite = $this->connect($dbConfig);
	}

	public function __destruct() {
		if($this->db !== false){
			$this->db->close();
		}
		if($this->dbWrite !== false){
			$this->dbWrite->close();
		}
	}

	private function connect($conf){
		// don't let it throw warnings and brake json format
		ob_start();
		$conn = new mysqli($conf['host'], $conf['user'], $conf['pass'], $conf['defaultDb']);
		$mysqliOutout = ob_get_contents();
		ob_end_clean();

		if(!$conn->connect_error){
			return $conn;
		}else{
			return false;
		}
	}

	public function isConnected(){
		return ($this->db !== false) && ($this->dbWrite !== false);
	}

	public function query($query, $params = array()){
		$row = false;
		$query = self::applyParamsToQuery(trim($query), $params);

		// read/write DB picker
			$dbConn = $this->db;
			$pattern = '/^(INSERT|UPDATE|DELETE)(.*)/';
			$isWriteDb = preg_match($pattern, strtoupper($query));
			if($isWriteDb) {
				$dbConn = $this->dbWrite;
			}

		if($dbConn === false){
			return false;
		}

		if ($result = $dbConn->query( $query )) {
			if(!$isWriteDb){
				for ($row = array(); $tmp = $result->fetch_array(MYSQLI_ASSOC);){ $row[] = $tmp; }
				$result->close();
			}else{
				return true;
			}
			self::$lastError = '';
			
		}else{
			self::$lastError = $dbConn->error;

			die( $dbConn->error );
		}
		return $row;
	}

	private function applyParamsToQuery($query, $params){
		foreach ($params as $name => $value) {
			$query = str_replace(':'.$name, self::sanitize($value), $query);
		}
		return $query;
	}

	public function makeInsert($table, $parameters){
		$res = false;

		$columns = implode(',',   array_keys( $parameters ) );
		$values  = "'" . implode("','", array_values( $parameters ) ) . "'";

		$sql  = " INSERT INTO " . $table;
		$sql .= " (".$columns.")";
		$sql .= " VALUES(".$values.");";

		if ($this->dbWrite->query($sql)){
			$res = $this->dbWrite->insert_id;
		}

		return $res;
	}
	
	public function makeInsertOnDuplicateUpdate($table, $parameters){
		$res = false;

		$columns = implode(',',   array_keys( $parameters ) );
		$values  = "'" . implode("','", array_values( $parameters ) ) . "'";

		$updLine = "";
		foreach ($parameters as $k => $v) {
			if(strlen($updLine)>0){ $updLine.=", "; }
			$updLine .= $k . "='" . $v . "'";
		}

		$sql  = " INSERT INTO " . $table;
		$sql .= " (".$columns.")";
		$sql .= " VALUES(".$values.") ";
		$sql .= " ON DUPLICATE KEY UPDATE " . $updLine;

		if ($this->dbWrite->query($sql)){
			$res = $this->dbWrite->insert_id;
		}

		return $res;
	}
	
	public function sanitize($params){
		$result = $params;
		if(is_string($result)){
			$result = $this->db->real_escape_string($result);
		}elseif(is_array($result)){
			$result = self::sanitize($result);
		}
		return $result;
	}


}