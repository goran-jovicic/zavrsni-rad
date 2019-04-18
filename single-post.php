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
<div class="blog-post" style="margin-left: 1rem;">
    <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($singlePost['id']) ?>"><?php echo($singlePost['title']) ?></a></h2>
    <p class="blog-post-meta"><?php echo($singlePost['created_at']) ?> by <?php echo($singlePost['author']) ?></p>
    <p><?php echo($singlePost['body']) ?></p>
    <div class="comments">
    <form method="GET" action="delete-post.php" name="deletePostForm">
    <input class="btn btn-default" type="submit" value="Delete Post" id="delete-post-button" >
    <input type="hidden" value="<?php echo $singlePost['id']; ?>" name="id"/>
    </form>
    <br>
        <h3>Comments</h3>
        <?php
        $sqlComments =
            "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";
            "SELECT * FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = {$_GET['post_id']}";

            $statement = $connection->prepare($sqlComments);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $comments = $statement->fetchAll();
        ?>
        <?php
               $error = '';
               if ($_SERVER["REQUEST_METHOD"] === 'GET' && !empty($_GET['error'])) {
                   $error = 'All fields are required!';
               }
        ?>
    <form method="POST" action="create-comment.php"> 
        <input type="text" name="author" class="author" placeholder="Your name here" id="author">
        <?php if (!empty($error)) {?>
            <span class="alert alert-danger">
                <?php echo $error; ?>
            </span>
        <?php } ?>
        <textarea placeholder="Add comment" rows="5" cols="100" class="textarea" name="comment"></textarea>
        <input type="hidden" value="<?php echo $_GET['post_id']; ?>" name="id"/>
        <input class="btn btn-default" type="submit" value="Submit">
    </form>
    <ul>
        <?php
            foreach ($comments as $comment) {
        ?>
        <li class="single-comment" style="margin-left: 1rem">
            <div><p style="color:#b34848"><?php echo $comment['author'] ?></p></div>
            <div> <?php echo $comment['text'] ?> </div>
            <form method="GET" action="delete-comment.php" >
                <input class="btn btn-default" type="submit" value="Delete">
                <input type="hidden" value="<?php echo $comment['id']; ?>" name="id"/>
                <input type="hidden" value="<?php echo $comment['post_id']; ?>" name="post_id"/>
            </form>
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