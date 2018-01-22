<?php
Class scrapeCarsHelper extends Helper{
	// /home/ubuntu/shell/docker/run-scheduled-tasks.sh
	// curl -s -H "Content-Type: application/json" -X POST -d @results-scraping.json https://api.nikitin.ninja/v1/scrapeCars/storeData
	public function storeData($getParams, $postParams){
		$scrapeCarsModel = new scrapeCarsModel();
		$listOfAds = $postParams;

		$newCars = 0;
		foreach ($listOfAds as $oneCar) {
			$carInfo = $scrapeCarsModel->getCarByUrl($oneCar['adDirectUrl'], ['ad_direct_url']);
			if(count($carInfo) === 0) {
				$row = [
					"ad_caption"       => $oneCar['adCaption'],
					"ad_direct_url"    => $oneCar['adDirectUrl'],
					"ad_time_mysql"    => $oneCar['adTime']['mysql'],
					"ad_time_raw"      => $oneCar['adTime']['raw'],
					"ad_time_parsed"   => $oneCar['adTime']['mysql'],
					"car_price_parsed" => $oneCar['carPrice']['parsed'],
					"car_price_raw"    => $oneCar['carPrice']['raw'],
					"car_year"         => $oneCar['carYear'],
					"raw_data"         => json_encode($oneCar),
				];
				$carId = $scrapeCarsModel->makeInsert('nikitin_ninja.tbl_scraped_cars', $row);

				foreach ($oneCar['carImages'] as $oneImage) {
					$imgRow = [
						"car_id" => $carId,
						"big"    => $oneImage['big'],
						"sm"     => $oneImage['sm'],
					];
					$scrapeCarsModel->makeInsert('nikitin_ninja.tbl_scraped_cars_images', $imgRow);
				}
				$newCars++;
			}
		}

		$r = array(
			"recvCars" => count($listOfAds),
			"newCars"  => $newCars,
		);
		return $r;
	}
}