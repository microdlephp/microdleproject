<?php 
//Case empty response
if(empty($this->response)) {
	//Build an empty response with expected format
	$this->response = [];
}

//Case string
elseif(is_string($this->response) && $this->response[0] != '<') {
	//Convert to associative array
	$this->response = json_decode($this->response, true);
}

//Output XML
echo self::arrayToXml($this->response);
?>