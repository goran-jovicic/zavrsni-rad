<?php
   $servername = "127.0.0.1";
   $username = "root";
   $password = "vivify";
   $dbname = "blog";

   try {
       $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e)
   {
       echo $e->getMessage();
   }
//    $id = $_POST['id'];
if(!empty($_POST['author']) && !empty($_POST['comment'])){
   $title = $_POST['title'];
   $author = $_POST['author'];
   $body = $_POST['body'];
   $sqlInsert = "INSERT INTO posts (title, body, author, created_at) VALUES ('{$title}', '{$body}', '{$author}', '{$created_at}');";
   $statementInsert = $connection->prepare($sqlInsert);
   $statementInsert->execute();
   $statementInsert->setFetchMode(PDO::FETCH_ASSOC);
}
?>

