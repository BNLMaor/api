<?php

	function userExists($id_number){
		global $db;
		return $db->get("users",array("id_number"=>"?"),array("limit"=>1),array($id_number));
	}
	function userExistsByParameter($parameter,$query){
		global $db;
		return $db->get("users",array("{$parameter}"=>"?"),array("limit"=>1),array($query));
	}
	
?>