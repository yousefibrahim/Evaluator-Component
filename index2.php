<?php

require_once("DB.php");
$db = new DB("localhost", "SocialNetwork", "root", "");
if ($_SERVER['REQUEST_METHOD'] == "GET"){
	echo json_encode(($db->query("SELECT * FROM users ORDER BY interest DESC")));	
	http_response_code(200);
}




?>