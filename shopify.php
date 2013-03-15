<?php
/**
 * @author ken fujimatsu
 * @copyright Copyright (c) 2013
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version 1.1
 **/
	class Shopify{
		
		private $data = array();
		
		public function __construct(){
			 $this->api_key = "YOUR_API_KEY";
			 $this->secret  = "YOUR_SECRET_KEY";
		}
		
		public function getToken($store_name, $code){
			
			//$store_name is shopify store name url
			//$code is the temporary token after the shopify app install request is granted.

			$data['client_id']=$this->api_key;
			$data['client_secret']=$this->secret;
			$data['code']=$code;			
			
			$ch = curl_init();
			$request_headers = array("Content-Type: application/json; charset=utf-8", 'Expect:');
			curl_setopt($ch, CURLOPT_URL, "https://".$store_name."/admin/oauth/access_token");		
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_USERAGENT, 'HAC');
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
			$return=json_decode(curl_exec($ch), true);
			curl_close($ch);
			return $return;
		}
	}
	
	$Shopify = new Shopify();
?>
