<?php
Class messagesModel extends Model {

	public function now(){
		$sql = "SELECT NOW() AS now;";

		$params = array();
		$r = self::query($sql, $params);
		return $r;
	}

}