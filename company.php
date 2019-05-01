<?php 
  class company {
    // DB stuff
    private $conn;
    private $table = 'company';

    // Post Properties
    public $name;
    public $email;
    public $companyID;
    public $numOfEmp;
    public $interest1;
    public $interest2;
    public $interest3;
    public $interest4;
    public $interest5;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function interests() {
      // Create query
      $query = 'SELECT DISTINCT p.name, p.email, p.companyID, p.numOfEmp, p.interest1, p.interest2, p.interest3,p.interest4,interest5 
                                FROM ' . $this->table . ' p
                                JOIN
                                users c ON c.interest_1=p.interest1
                                OR c.interest_2 = p.interest2  
                                OR c.interest_3 = p.interest3  
                                OR c.interest_4 = p.interest4
                                OR c.interest_5 = p.interest5
                                ORDER BY 
                                p.interest1 ASC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    

    

    public function quizzes() {
      // Create query
      $query = 'SELECT DISTINCT c.companyID, c.interest1,c.interest2,c.interest3,c.interest4,c.interest5
                                FROM ' . $this->table . ' c
                                JOIN quiz q ON q.CompanyId = c.companyID 
                               
                                JOIN
                                users p ON p.interest_1=c.interest1
                                OR p.interest_2 = c.interest2  
                                OR p.interest_3 = c.interest3  
                                OR p.interest_4 = c.interest4
                                OR p.interest_5 = c.interest5
                                ';
      
                                
      // Prepare statement
      $stmtt = $this->conn->prepare($query);

      // Execute query
      $stmtt->execute();

      return $stmtt;
    }


    
    
    
  }