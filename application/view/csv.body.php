<?php 
//Case response not empty
if(!empty($this->response)) {
	//Case string
	if(is_string($this->response)) {
		//Convert to associative array
		$this->response = json_decode($this->response, true);
	}
	
	//Case array
	if(is_array($this->response)) {
		//Case not a row
		if(!is_array($this->response[array_key_first($this->response)])) {
			//Build an empty response with expected format
			$this->response = [$this->response];
		}

		//Output CSV
		echo self::arrayToCsv($this->response);
	}
}
?>