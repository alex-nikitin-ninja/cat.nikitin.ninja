<?php
Class scrapeJobsModel extends Model {
	// CREATE TABLE nikitin_ninja.tbl_scraped_jobs (
	//     id BIGINT AUTO_INCREMENT,
	//     ad_caption VARCHAR(256),
	//     ad_location VARCHAR(256),
	//     ad_map_id VARCHAR(256),
	//     ad_direct_url VARCHAR(512),
	//     ad_time_mysql DATETIME,
	//     ad_time_raw VARCHAR(64),
	//     ad_time_parsed DATETIME,
	//     raw_data MEDIUMTEXT,
	//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	//     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	//     deleted_at DATETIME,
	//     PRIMARY KEY (id)
	// );

	// CREATE TABLE nikitin_ninja.tbl_scraped_jobs_images (
	//     id BIGINT AUTO_INCREMENT,
	//     job_id BIGINT,
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

	public function getJobByUrl($url, $columns = ['*']){
		$columns = implode(", ", $columns);

		$sql =
			"SELECT
				{$columns}
			FROM
				nikitin_ninja.tbl_scraped_jobs t
			WHERE
				ad_direct_url LIKE ':adDirectUrl'";

		$params = array(
			"adDirectUrl" => $url,
		);
		$r = self::query($sql, $params);
		return $r;
	}

}