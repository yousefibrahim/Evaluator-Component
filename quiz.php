<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/quiz.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog quiz object
  $quiz = new quiz($db);

  // Blog quiz query
  $result = $quiz->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any quizes
  if($num > 0) {
    // quiz array
    $quizes_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $quiz_item = array(
        'QuizId' => $QuizId,
        'QuizTitle' => $QuizTitle,
        'QuizDescription' => $QuizDescription,
        'CompanyId' => $CompanyId 
      );

      // Push to "data"
      array_push($quizes_arr, $quiz_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($quizes_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Quizzes Found')
    );
  }
