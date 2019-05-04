<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate users object
  $users = new users($db);

  // users read query
  $result = $users->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any users
  if($num > 0) {
        // Cat array
        $users_arr = array();
        //$cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $users_item = array(
            'id' => $id,
            'name' => $name,
            'email' => html_entity_decode($email),
            'gender'=>$gender,
            'dob'=>$dob,
            'interest_1'=>$interest_1,
            'interest_2'=>$interest_2,
            'interest_3'=>$interest_3,
            'interest_4'=>$interest_4,
            'interest_5'=>$interest_5
          );

          // Push to "data"
          //array_push($cat_arr['data'], $cat_item);
          array_push($users_arr, $users_item);
        }

        // Turn to JSON & output
        echo json_encode($users_arr);

  } else {
        // No Users
        echo json_encode(
          array('message' => 'No Users Found')
        );
  }
