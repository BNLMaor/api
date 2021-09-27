<?php 
	// בס"ד בשם השם נעשה ונצילח אמן //
	class MBNL {
		public function moveTo($url,$time=false) {
			if($time == false){
				return header('Location: '.$url.'');
			}else{
				$time = $time * 1000;
				return "<script>window.setTimeout(function() {window.location = '{$url}';}, '$time');</script>";
			}
		}
		public function msg($text,$type = false){
			if ($type == true){
				return '<div class="alert alert-success"><i class="fa fa-check"></i> '.$text.'</div>';
			}else {
				return '<div class="alert alert-danger"><i class="fa fa-times"></i> '.$text.'</div>';
			}	
		}
		public function protect($string){
			$protection = htmlspecialchars(trim($string), ENT_QUOTES);
			return $protection;	
		}
		public function copyrights(){
			return '<a href="http://bnlstudio.com" target="_blank">BNLStudio</a>';
		}
		public function logo($size){
			return '<a href="http://bnlstudio.com" target="_blank"> <img src="https://i.imgur.com/3qNujM1.png" width="'.$size.'%"></a>';
		}
		public function enc($string,$key=5){
			$string = md5($string);
			$string = hash('ripemd160',$string);
			$string = hash('sha256', $string);
			$string = $string. '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$string = md5($string);
			$result = '';
			for($i=0, $k= strlen($string); $i<$k; $i++) {
				$char = substr($string, $i, 1);
				$keychar = substr($key, ($i % strlen($key))-1, 1);
				$char = chr(ord($char)+ord($keychar));
				$result .= $char;
			}
			$result = base64_encode($result);
			return md5($result);
		}
		
		public function randomHash($lenght = 7) {
			$random = substr(md5(rand()),0,$lenght);
			return $random;
		}
		
		public function isVaildURL($url){
			return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
		}
		
		public function getBaseUrl() {
			$currentPath = $_SERVER['PHP_SELF']; 
			$pathInfo = pathinfo($currentPath); 
			$hostName = $_SERVER['HTTP_HOST']; 
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			return $protocol.'://'.$hostName.$pathInfo['dirname']."/";
		}
		
		public function isValidUsername($str){
			return preg_match('/^[a-zA-Z0-9-_]+$/',$str);
		}
		
		public function isValidEmail($str) {
		return filter_var($str, FILTER_VALIDATE_EMAIL);
		}
		
		public function encryptIt( $q ) {
			$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
			$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
			return( $qEncoded );
		}

		public function decryptIt( $q ) {
			$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
			$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
			return( $qDecoded );
		}

	} 

?>