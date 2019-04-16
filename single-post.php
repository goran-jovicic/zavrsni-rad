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
?>

<!DOCTYPE html>
<html>
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
<body>

<?php include('php/header.php'); ?>
    <main role="main" class="container">

        <?php
            if (isset($_GET['post_id'])) {

                $sql = "SELECT * FROM posts WHERE posts.id = {$_GET['post_id']}";
                $statement = $connection->prepare($sql);

                $statement->execute();

                $statement->setFetchMode(PDO::FETCH_ASSOC);

                $singlePost = $statement->fetch();

        ?>

<!-- <div class="blog-post">
        <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h2>
        <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <?php echo($post['author']) ?></p>
        <p><?php echo($post['body']) ?></p>
    </div> -->
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <header>
                <h2 class="blog-post-title"><?php echo $singlePost['title'] ?></h2>
                <p class="blog-post-meta"><?php echo($singlePost['created_at']) ?> by <?php echo($singlePost['author']) ?></p>
            </header>
            <p><?php echo($singlePost['body']) ?></p>
        </div>
        <!-- <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav> -->
    </div>
<?php include('php/sidebar.php');?>

<?php
    } else {
    echo('post_id nije prosledjen kroz $_GET');
    }
?>
    </div>
</main>

<?php include('php/footer.php'); ?>

</body>
</html>
