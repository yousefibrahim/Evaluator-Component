<?php

require_once("DB.php");
$db = new DB("localhost", "SocialNetwork", "root", "");
if ($_SERVER['REQUEST_METHOD'] == "GET"){
	echo json_encode(($db->query("SELECT * FROM users ORDER BY score DESC")));	
	http_response_code(200);
}

else if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	echo "POST";
}
	else
{ 
	 http_response_code(405);
}




?>