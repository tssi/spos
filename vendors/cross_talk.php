<?php
App::import('Vendor','cross_talk');

//same function as Inflector
class Cross_Talk{
	static function post($url, $data) {
		   $fields = '';
		   foreach($data as $key => $value) { 
			  $fields .= $key . '=' . $value . '&'; 
		   }
		   rtrim($fields, '&');
		 
		   $post = curl_init();
		 
		   curl_setopt($post, CURLOPT_URL, $url);
		   curl_setopt($post, CURLOPT_POST, count($data));
		   curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		   curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		 
		   $result = curl_exec($post);
		   curl_close($post);
		   
		   return $result;
		}
}
?>