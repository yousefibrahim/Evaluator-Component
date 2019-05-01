<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/company.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog company object
  $company = new company($db);

  // Blog company query
  $result = $company->interests();
  // Get row count
  $num = $result->rowCount();

  // Check if any company
  if($num > 0) {
    // company array
    $companies_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $company_item = array(
        'companyID' => $companyID,
        'name' => $name,
        'email' => html_entity_decode($email),
        'numOfEmp' => $numOfEmp,
        'interest1' => $interest1,
        'interest2' => $interest2,
        'interest3' => $interest3,
        'interest4' => $interest4,
        'interest5' => $interest5
      );

      // Push to "data"
      array_push($companies_arr, $company_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($companies_arr);

  } else {
    // No companies
    echo json_encode(
      array('message' => 'No companies Found')
    );
  }
