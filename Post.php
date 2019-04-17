<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'user';

    // Post Properties
    public $userid;
    public $username;
    public $interests;
    public $score;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT c.name as username, p.userid, p.score, p.interests
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                  
                                ORDER BY
                                  p.interests DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
   // public function read_single() {
          // Create query
     //     $query = 'SELECT c.name as username, p.userid,p.score, p.title, p.interests
       //                             FROM ' . $this->table . ' p
         //                           LEFT JOIN
           //                           categories c ON p.category_id = c.id
             //                       WHERE
               //                       p.id = ?
                 //                   LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->userid = $row['userid'];
          $this->username = $row['username'];
          $this->interests = $row['interests'];
          $this->score = $row['score'];
         
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

   
   

    
   
    
  }