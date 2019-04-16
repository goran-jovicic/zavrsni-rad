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
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <div class="sidebar-module">
            <h4>Latests Posts</h4>
<?php

    $sql = "SELECT * FROM posts ORDER BY created_at DESC;";
    $statement = $connection->prepare($sql);

    $statement->execute();

    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $posts = $statement->fetchAll();

?>

<?php foreach($posts as $post) {

?>
        <!-- <a class="list-unstyled red-listing" href="single-post.php?post_id=<?php echo($post['id']?>"><?php echo($post['title']) ?></a> -->
<?php } ?>
        </div>
    </div>
</aside>