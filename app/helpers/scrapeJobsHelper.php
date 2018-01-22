<?php
Class scrapeJobsHelper extends Helper{
	// /home/ubuntu/shell/docker/run-scheduled-tasks.sh
	// curl -s -H "Content-Type: application/json" -X POST -d @results-scraping.json https://api.nikitin.ninja/v1/scrapeJobs/storeData
	public function storeData($getParams, $postParams){
		$scrapeJobsModel = new scrapeJobsModel();
		$listOfAds = $postParams;

		$newAds = 0;
		foreach ($listOfAds as $oneAd) {
			$adInfo = $scrapeJobsModel->getJobByUrl($oneAd['adDirectUrl'], ['ad_direct_url']);
			if(count($adInfo) === 0) {
				$row = [
					"ad_caption"     => $oneAd['adCaption'],
					"ad_location"    => $oneAd['adLocation'],
					"ad_map_id"      => $oneAd['adMapId'],
					"ad_direct_url"  => $oneAd['adDirectUrl'],
					"ad_time_mysql"  => $oneAd['adTime']['mysql'],
					"ad_time_raw"    => $oneAd['adTime']['raw'],
					"ad_time_parsed" => $oneAd['adTime']['mysql'],
					"raw_data"       => json_encode($oneAd),
				];
				$adId = $scrapeJobsModel->makeInsert('nikitin_ninja.tbl_scraped_jobs', $row);

				foreach ($oneAd['adImages'] as $oneImage) {
					$imgRow = [
						"job_id" => $adId,
						"big"    => $oneImage['big'],
						"sm"     => $oneImage['sm'],
					];
					$scrapeJobsModel->makeInsert('nikitin_ninja.tbl_scraped_jobs_images', $imgRow);
				}
				$newAds++;
			}
		}

		$r = array(
			"recvAds" => count($listOfAds),
			"newAds"  => $newAds,
		);
		return $r;
	}
}