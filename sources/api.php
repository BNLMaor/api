<?php
	header('Content-type: text/javascript');

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include("../includes/config.php");
	include("../includes/functions.php");
	
	$BNL = new MBNL();
	if(isset($_GET['type'])){
		$type = $_GET['type'];
		if ($type == "AddUser") {
			$data = array();
			if(!isset($_GET['name']) OR empty($_GET['phone']) OR empty($_GET['id_number'])) {$data['status'] = "False"; $data['message'] = "One or more input fields are missing.";}
			elseif(!is_numeric($_GET['phone'])) {$data['status'] = "False"; $data['message'] = "Phone number must to contain numbers only.";}
			elseif(!is_numeric($_GET['id_number'])) {$data['status'] = "False"; $data['message'] = "ID number must to contain numbers only.";}
			else {
				if(userExists($_GET['id_number'])){$data['status'] = "False"; $data['message'] = "The user already exists.";}
				else {
					if(isset($_GET['status'])){
						$status = $_GET['status'];
					} else {$status = "0";}
					$insert = $db->insert("users",array(":name" => $_GET['name'],":phone" => $_GET['phone'],":id_number" => $_GET['id_number'],":status" => $status,":timestamp" => time()));
					if($insert){
						$data['status'] = "True";
					}
				}
			}
			echo json_encode($data,JSON_PRETTY_PRINT);	
		} elseif ($type == "EditUser") {
			$data = array();
			if(isset($_GET['where_phone'])){
				$search_query = "phone";
				$search_get = $_GET['where_phone'];
			} elseif(isset($_GET['where_id'])){
				$search_query = "id_number";
				$search_get = $_GET['where_id'];
			}
			$checkExistence = userExistsByParameter($search_query,$search_get);
			if($checkExistence){
				if(isset($_GET['name'])) {$name = $_GET['name'];} else {$name = $checkExistence['name'];}
				if(isset($_GET['id_number'])) {$id_number = $_GET['id_number'];} else {$id_number = $checkExistence['id_number'];}
				if(isset($_GET['phone'])) {$phone = $_GET['phone'];} else {$phone = $checkExistence['phone'];}
				if(isset($_GET['status'])) {$status = $_GET['status'];} else {$status = $checkExistence['status'];}
				
				$update = $db->update("users","",array("id"=>$checkExistence['id']),array(":name" => $name, ":id_number" => $id_number, ":phone" => $phone, ":status" => $status));
				if ($update) {
					$data['status'] = "True";
				} else {$data['status'] = "False";$data['message'] = "Seems like something went wrong";}
			} else {
				$data['status'] = "False";
				$data['message'] = "User dosent exists";
			}
			
			
			echo json_encode($data,JSON_PRETTY_PRINT);	
		} elseif($type == "CheckUser"){
			$data = array();
			if(isset($_GET['where_phone'])){
				$search_query = "phone";
				$search_get = $_GET['where_phone'];
			} elseif(isset($_GET['where_id'])){
				$search_query = "id_number";
				$search_get = $_GET['where_id'];
			}
			$checkExistence = userExistsByParameter($search_query,$search_get);
			if($checkExistence){
				$data['status'] = "True";
				$data['active'] = ($checkExistence['status'] == '1') ? "True" : "False";
				
			} else {
				$data['status'] = "False";
				$data['message'] = "User dosent exists";
			}
						
			
			echo json_encode($data,JSON_PRETTY_PRINT);	
		}
		
	} 