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
?>

<!doctype html>
<html lang="en">
<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" href="../../../../favicon.ico">

   <title>Vivify Blog</title>

   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

   <!-- Custom styles for this template -->
   <link href="styles/blog.css" rel="stylesheet">
   <link href="styles/styles.css" rel="stylesheet">
</head>
<?php include 'php/header.php'?>
<body>
<main role="main" class="container">

   <div class="row">
   <?php
               if (isset($_GET['post_id'])) {

                   $sql = "SELECT id, title, body, author, created_at FROM posts WHERE posts.id = {$_GET['post_id']}";
                   $statement = $connection->prepare($sql);

                   $statement->execute();

                   $statement->setFetchMode(PDO::FETCH_ASSOC);

                   $singlePost = $statement->fetch();
               }



   ?>
<div class="blog-post">
    <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($singlePost['id']) ?>"><?php echo($singlePost['title']) ?></a></h2>
    <p class="blog-post-meta"><?php echo($singlePost['created_at']) ?> by <?php echo($singlePost['author']) ?></p>
    <p><?php echo($singlePost['body']) ?></p>
    <div class="comments">
        <h3>Comments</h3>
        <?php
        $sqlComments =
            "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";
            "SELECT * FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = {$_GET['post_id']}";

            $statement = $connection->prepare($sqlComments);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $comments = $statement->fetchAll();
            foreach ($comments as $comment) {
        ?>

        <ul class="comment-list">
        <li class="single-comment">
            <div>posted by: <?php echo $comment['author'] ?></div>
            <div> <?php echo $comment['text'] ?> </div>
        </li>
        <hr>
        <?php } ?>
        </ul>
        <button type="button" class="btn btn-default" id="comments-button" onclick = "hideComments()">Hide comments</button>
    </div>
</div>
       <?php include 'php/sidebar.php'?>

   </div><!-- /.row -->

</main><!-- /.container -->
  <?php include "php/footer.php" ?>
</body>
<script src="script.js"></script>
</html>