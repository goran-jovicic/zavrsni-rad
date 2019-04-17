<?php
   $servername = "127.0.0.1";
   $username = "root";
   $password = "vivify";
   $dbname = "blog";

   try {
       $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       // set the PDO error mode to exception
       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e)
   {
       echo $e->getMessage();
   }

   if(!empty($_POST['title']) && !empty($_POST['post'] && !empty($_POST['author']))) {
       $title = $_POST['title'];
       $post = $_POST['post'];
       $author = $_POST['author'];
       $date = date('Y-m-d');
       $sqlInsert = "INSERT INTO posts (title, body, author,created_at) VALUES ('{$title}', '{$post}', '{$author}','$date');";
       // var_dump($sqlInsert);
       $statementInsert = $connection->prepare($sqlInsert);
       $statementInsert->execute();
       $statementInsert->setFetchMode(PDO::FETCH_ASSOC);

       header("Location: http://localhost:8080/index.php");
   } else {
       header("Location: http://localhost:8080/create.php?&error=1");
   }
?>