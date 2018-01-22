<?php
Class scrapeCarsModel extends Model {
	// CREATE TABLE nikitin_ninja.tbl_scraped_cars (
	//     id BIGINT AUTO_INCREMENT,
	//     ad_caption VARCHAR(256),
	//     ad_direct_url VARCHAR(512),
	//     ad_time_mysql DATETIME,
	//     ad_time_raw VARCHAR(64),
	//     ad_time_parsed DATETIME,
	//     car_price_parsed DECIMAL(10, 2),
	//     car_price_raw VARCHAR(63),
	//     car_year VARCHAR(16),
	//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	//     deleted_at DATETIME,
	//     PRIMARY KEY (id)
	// );

	// CREATE TABLE nikitin_ninja.tbl_scraped_cars_images (
	//     id BIGINT AUTO_INCREMENT,
	//     car_id BIGINT,
	//     big VARCHAR(512),
	//     sm VARCHAR(512),
	//     PRIMARY KEY (id)
	// );

	public function now(){
		$sql = "SELECT NOW() AS now;";

		$params = array();
		$r = self::query($sql, $params);
		return $r;
	}

	public function getCarByUrl($url, $columns = ['*']){
		$columns = implode(", ", $columns);

		$sql =
			"SELECT
				{$columns}
			FROM
				nikitin_ninja.tbl_scraped_cars t
			WHERE
				ad_direct_url LIKE ':adDirectUrl'";

		$params = array(
			"adDirectUrl" => $url,
		);
		$r = self::query($sql, $params);
		return $r;
	}

}